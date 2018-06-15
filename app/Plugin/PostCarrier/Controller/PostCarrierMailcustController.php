<?php
/*
 * This file is part of the PostCarrier
 *
 * Copyright(c) 2016 IPLOGIC CO.,LTD. All Rights Reserved.
 * http://www.iplogic.co.jp
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\PostCarrier\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception as HttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Doctrine\ORM\Query;
use Eccube\Exception\CsvImportException;
use Eccube\Service\CsvImportService;
use Eccube\Util\Str;
use Eccube\Entity\Master\CsvType;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Plugin\PostCarrier\Util\PostCarrierUtil;
use Symfony\Component\Validator\Constraints as Assert;

class PostCarrierMailcustController
{
    /**
     * 一覧表示
     */
    public function index(Application $app, Request $request, $page_no = null)
    {
        if (PostCarrierUtil::checkNotConfigured($app)) {
            return $app->redirect($app->url('plugin_PostCarrier_config'));
        }

        $form = $app['form.factory']->createBuilder('postcarrier_csv_import')->getForm();

        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }
        $page_no = $page_no === null ? 1 : $page_no;
        $offset = $page_count * ($page_no - 1);

        $dql = 'SELECT COUNT(g) FROM Plugin\PostCarrier\Entity\PostCarrierGroup g';
        $q = $app['orm.em']->createQuery($dql);
        $item_count = $q->getScalarResult()[0][1]; // XXX

        $dql = 'SELECT g, COUNT(c) AS cnt FROM Plugin\PostCarrier\Entity\PostCarrierGroup g LEFT JOIN Plugin\PostCarrier\Entity\PostCarrierGroupCustomer c WITH g.id = c.group_id GROUP BY g ORDER BY g.id';
        $q = $app['orm.em']->createQuery($dql)
            ->setMaxResults($page_count)
            ->setFirstResult($offset);
        $GroupList = $q->getResult(Query::HYDRATE_ARRAY);

        $pagination = $app['paginator']()->paginate(array(), $page_no, $page_count);
        $pagination->setItems($GroupList);
        $pagination->setTotalItemCount($item_count);

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/csv_subscriber.twig', array(
            'pagination' => $pagination,
            'page_no' => $page_no,
            'pageMaxis' => $pageMaxis,
            'page_count' => $page_count,
            'form' => $form->createView(),
            'headers' => array(),
            'errors' => array(),
        ));
    }

    public function csvImport(Application $app, Request $request)
    {
        set_time_limit(0);

        $form = $app['form.factory']->createBuilder('postcarrier_csv_import')->getForm();

        $headers = $this->getCsvHeader();

        if ('POST' === $request->getMethod()) {

            $form->handleRequest($request);

            if ($form->isValid()) {

                $formFile = $form['import_file']->getData();
                $formData = $form->getData();

                if (!empty($formFile)) {
                    $enc_filepath = $this->getImportData($app, $formFile);

                    $fp = fopen($enc_filepath, "r");
                    if ($fp === false) {
                        $app->addError('CSVのアップロードに失敗しました。', 'admin');
                        return $this->show($app, $request, $form);
                    }

                    // レコード数を得る
                    $rec_count = $this->lfCSVRecordCount($fp);

                    $this->em = $app['orm.em'];
                    $conn = $this->em->getConnection();
                    $conn->getConfiguration()->setSQLLogger(null);
                    $conn->beginTransaction();

                    $Group = null;
                    if ($formData['group_id']) {
                        $Group = $app['eccube.plugin.postcarrier.repository.postcarrier_group']->find($formData['group_id']);
                    } else {
                        $Group = new \Plugin\PostCarrier\Entity\PostCarrierGroup();
                    }
                    $Group->setGroupName($formData['group_name']);
                    $Group->setUpdateDate(new \DateTime());
                    $app['eccube.plugin.postcarrier.repository.postcarrier_group']->save($Group);

                    $insert_from = $app['config']['database']['driver'] == "pdo_mysql" ? 'FROM dual' : '';
                    $pre_insert = $conn
                        ->prepare("INSERT INTO plg_postcarrier_csv_customer(email,create_date,memo01,memo02,memo03,memo04,memo05,memo06,memo07,memo08,memo09,memo10,group_id,update_date) SELECT :email, :create_date, :memo01, :memo02, :memo03, :memo04, :memo05, :memo06, :memo07, :memo08, :memo09, :memo10, :group_id, CURRENT_TIMESTAMP $insert_from WHERE NOT EXISTS(SELECT 1 FROM plg_postcarrier_csv_customer WHERE group_id = :group_id AND email = :email)");
                    $pre_update = $conn
                        ->prepare("UPDATE plg_postcarrier_csv_customer SET email=:email, create_date=:create_date, memo01=:memo01, memo02=:memo02, memo03=:memo03, memo04=:memo04, memo05=:memo05, memo06=:memo06, memo07=:memo07, memo08=:memo08, memo09=:memo09, memo10=:memo10, status=2, update_date=CURRENT_TIMESTAMP WHERE group_id = :group_id AND email = :email");

                    $line = 0;      // 行数
                    $regist = 0;    // 登録数
                    $insert = 0;

                    $batchSize = 100;
                    $colmax = 12;
                    $err = false;
                    while(!feof($fp) && !$err) {
                        $arrCSV = fgetcsv($fp, 10000);

                        ++$line;

                        // ヘッダ行はスキップ
                        if($line <= 1) {
                            continue;
                        }

                        // 空行はスキップ
                        if (count($arrCSV) == 1 && $arrCSV[0] == '') {
                            continue;
                        }

                        // 項目数カウント
                        $max = count($arrCSV);

                        // 空行はスキップ
                        $cnt = count($arrCSV);
                        if ($cnt == 0) {
                            continue;
                        }

                        // 項目数が1未満の場合はスキップ
                        if ($max < 1) {
                            continue;
                        }

                        // 項目数チェック
                        if($max > $colmax) {
                            $msg = "${line}行目: 項目数が" . $cnt . "個検出されました。項目数は最大" . $colmax . "個になります。";
                            $app->addError($msg, 'admin');
                            $conn->rollback();
                            return $this->show($app, $request, $form);
                        } else {
                            $arrErr = $this->checkError($app, $arrCSV);
                            if ($arrErr) {
                                foreach ($arrErr as $msg) {
                                    $app->addError("${line}行目: $msg", 'admin');
                                }
                                $conn->rollback();
                                return $this->show($app, $request, $form);
                            }
                        }

                        if(!$err) {
                            $insert_flg = $this->lfRegist($Group->getId(), $arrCSV, $pre_insert, $pre_update);
                            if ($insert_flg) ++$insert;

                            ++$regist;
                        }

                        if ($regist % $batchSize === 0) {
                            //$conn->commit();
                            gc_collect_cycles();
                        }
                    }

                    $conn->commit();
                    gc_collect_cycles();

                    $update = $regist - $insert;
                    $msg = "処理総件数:${regist}件、新規登録:${insert}件、更新:${update}件 アップロードしました。";
                    $app->addSuccess($msg, 'admin');

                    $form = $app['form.factory']->createBuilder('postcarrier_csv_import')->getForm();
                } else {
                    if ($formData['group_id']) {
                        $Group = $app['eccube.plugin.postcarrier.repository.postcarrier_group']->find($formData['group_id']);
                        $Group->setGroupName($formData['group_name']);
                        $Group->setUpdateDate(new \DateTime());
                        $app['eccube.plugin.postcarrier.repository.postcarrier_group']->save($Group);

                        $msg = "グループ名を更新しました。";
                        $app->addSuccess($msg, 'admin');

                        $form = $app['form.factory']->createBuilder('postcarrier_csv_import')->getForm();
                    } else {
                        $msg = "CSVファイルを選択するか、グループの編集を選択してください。";
                        $app->addError($msg, 'admin');
                    }
                }
            }
        }

        return $this->show($app, $request, $form);
    }

    private function show($app, $request, $form) {
        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }
        $page_no = 1;
        $offset = $page_count * ($page_no - 1);

        $dql = 'SELECT COUNT(g) FROM Plugin\PostCarrier\Entity\PostCarrierGroup g';
        $q = $app['orm.em']->createQuery($dql);
        $item_count = $q->getScalarResult()[0][1];

        $dql = 'SELECT g, COUNT(c) AS cnt FROM Plugin\PostCarrier\Entity\PostCarrierGroup g LEFT JOIN Plugin\PostCarrier\Entity\PostCarrierGroupCustomer c WITH g.id = c.group_id GROUP BY g ORDER BY g.id';
        $q = $app['orm.em']->createQuery($dql)
            ->setMaxResults($page_count)
            ->setFirstResult($offset);
        $GroupList = $q->getResult(Query::HYDRATE_ARRAY);

        $pagination = $app['paginator']()->paginate(array(), $page_no, $page_count);
        $pagination->setItems($GroupList);
        $pagination->setTotalItemCount($item_count);

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/csv_subscriber.twig', array(
            'pagination' => $pagination,
            'page_no' => $page_no,
            'pageMaxis' => $pageMaxis,
            'page_count' => $page_count,
            'form' => $form->createView(),
            'headers' => array(),
            'errors' => array(),
        ));
    }

    /**
     * メルマガテンプレートを削除
     * @param Application $app
     * @param Request $request
     * @param unknown $id
     */
    public function delete(Application $app, Request $request, $id)
    {
        if ('POST' === $request->getMethod()) {
            if(is_null($id) || strlen($id) == 0) {
                $app->addError('admin.postcarrier.group.data.illegalaccess', 'admin');

                return $app->redirect($app->url('admin_postcarrier_mailcust'));
            }

            $group = $app['eccube.plugin.postcarrier.repository.postcarrier_group']->find($id);

            if(is_null($group)) {
                $app->addError('admin.postcarrier.group.data.notfound', 'admin');

                return $app->redirect($app->url('admin_postcarrier_mailcust'));
            }

            $app['eccube.plugin.postcarrier.repository.postcarrier_group']->delete($group);
        }

        return $app->redirect($app->url('admin_postcarrier_mailcust'));
    }


    /**
     * アップロードされたCSVファイルの行ごとの処理
     *
     * @param $formFile
     * @return CsvImportService
     */
    protected function getImportData($app, $formFile)
    {
        // アップロードされたCSVファイルを一時ディレクトリに保存
        $this->fileName = 'upload_' . Str::random() . '.' . $formFile->getClientOriginalExtension();
        $formFile->move($app['config']['csv_temp_realdir'], $this->fileName);

        return $this->sfEncodeFile($app['config']['csv_temp_realdir'] . '/' . $this->fileName);
    }

    public function csvExport(Application $app, Request $request, $id)
    {
        // タイムアウトを無効にする.
        set_time_limit(0);

        // sql loggerを無効にする.
        $em = $app['orm.em'];
        $em->getConfiguration()->setSQLLogger(null);

        $header = "メールアドレス,登録日,自由項目1,自由項目2,自由項目3,自由項目4,自由項目5,自由項目6,自由項目7,自由項目8,自由項目9,自由項目10";
        $sql = 'SELECT * FROM plg_postcarrier_csv_customer WHERE group_id = ?';
        $sqlval = array($id);

        $now = new \DateTime();
        $filename = 'csvgroup_' . $now->format('YmdHis') . '.csv';
        Header("Content-disposition: attachment; filename=${filename}");
        Header("Content-type: application/octet-stream; name=${filename}");
        Header("Cache-Control: ");
        Header("Pragma: ");

        echo mb_convert_encoding($header, 'SJIS-Win', 'UTF-8');
        echo "\r\n";

        $conn = $em->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sqlval);
        while ($data = $stmt->fetch()) {
            $row = array();
            $row[] = PostCarrierUtil::escapeCsvData($data['email']);
            $row[] = PostCarrierUtil::escapeCsvData($data['create_date']);
            $row[] = PostCarrierUtil::escapeCsvData($data['memo01']);
            $row[] = PostCarrierUtil::escapeCsvData($data['memo02']);
            $row[] = PostCarrierUtil::escapeCsvData($data['memo03']);
            $row[] = PostCarrierUtil::escapeCsvData($data['memo04']);
            $row[] = PostCarrierUtil::escapeCsvData($data['memo05']);
            $row[] = PostCarrierUtil::escapeCsvData($data['memo06']);
            $row[] = PostCarrierUtil::escapeCsvData($data['memo07']);
            $row[] = PostCarrierUtil::escapeCsvData($data['memo08']);
            $row[] = PostCarrierUtil::escapeCsvData($data['memo09']);
            $row[] = PostCarrierUtil::escapeCsvData($data['memo10']);

            echo mb_convert_encoding(implode(",", $row), 'SJIS-Win', 'UTF-8');
            echo "\r\n";
            ob_flush();
            flush();
        }

        exit;
    }

    /**
     * カテゴリCSVヘッダー定義
     */
    private function getCsvHeader()
    {
        return array(
            'email' => 'email',
        );
    }

    public function edit(Application $app, Request $request, $id)
    {
        $Group = $app['eccube.plugin.postcarrier.repository.postcarrier_group']->find($id);
        $form = $app['form.factory']->createBuilder('postcarrier_csv_import')->getForm();

        if (!$Group) {
            $app->addError('グループが存在しません。', 'admin');
            return $this->show($app, $request, $form);
        }

        $form->get('group_id')->setData($id);
        $form->get('group_name')->setData($Group->getGroupName());

        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }
        $page_no = 1;
        $offset = $page_count * ($page_no - 1);

        $dql = 'SELECT COUNT(g) FROM Plugin\PostCarrier\Entity\PostCarrierGroup g';
        $q = $app['orm.em']->createQuery($dql);
        $item_count = $q->getScalarResult()[0][1]; // XXX

        $dql = 'SELECT g, COUNT(c) AS cnt FROM Plugin\PostCarrier\Entity\PostCarrierGroup g LEFT JOIN Plugin\PostCarrier\Entity\PostCarrierGroupCustomer c WITH g.id = c.group_id GROUP BY g ORDER BY g.id';
        $q = $app['orm.em']->createQuery($dql)
            ->setMaxResults($page_count)
            ->setFirstResult($offset);
        $GroupList = $q->getResult(Query::HYDRATE_ARRAY);

        $pagination = $app['paginator']()->paginate(array(), $page_no, $page_count);
        $pagination->setItems($GroupList);
        $pagination->setTotalItemCount($item_count);

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/csv_subscriber.twig', array(
            'pagination' => $pagination,
            'page_no' => $page_no,
            'pageMaxis' => $pageMaxis,
            'page_count' => $page_count,
            'form' => $form->createView(),
            'headers' => array(),
            'errors' => array(),
        ));
    }

    private function sfEncodeFile($filepath) {
        $basename = basename($filepath);
        $out_dir = dirname($filepath);
        $outpath = $out_dir . '/enc_' . $basename;

        $file = file_get_contents($filepath);
        // アップロードされたファイルがUTF-8以外は文字コード変換を行う
        $encode = Str::characterEncoding(substr($file, 0, 6));
        if ($encode != 'UTF-8') {
            $file = mb_convert_encoding($file, 'UTF-8', $encode);
        }
        $file = Str::convertLineFeed($file);

        $tmp = fopen($outpath, 'w+');
        fwrite($tmp, $file);
        fclose($tmp);

        return $outpath;
    }

    private function lfCSVRecordCount($fp) {

        $count = 1;
        while(!feof($fp)) {
            $arrCSV = fgetcsv($fp, 10000);
            $count++;
        }
        // ファイルポインタを戻す
        if (rewind($fp)) {
            return $count-1;
        } else {
            //SC_Utils_Ex::sfDispError("");
        }
    }

    private function lfRegist($group_id, $arrCSV, $pre_insert, $pre_update) {
        $pre_insert->bindValue('group_id', $group_id);
        $pre_insert->bindValue('email', $arrCSV[0]);
        $pre_insert->bindValue('create_date', $arrCSV[1]);
        $pre_insert->bindValue('memo01', $arrCSV[2]);
        $pre_insert->bindValue('memo02', $arrCSV[3]);
        $pre_insert->bindValue('memo03', $arrCSV[4]);
        $pre_insert->bindValue('memo04', $arrCSV[5]);
        $pre_insert->bindValue('memo05', $arrCSV[6]);
        $pre_insert->bindValue('memo06', $arrCSV[7]);
        $pre_insert->bindValue('memo07', $arrCSV[8]);
        $pre_insert->bindValue('memo08', $arrCSV[9]);
        $pre_insert->bindValue('memo09', $arrCSV[10]);
        $pre_insert->bindValue('memo10', $arrCSV[11]);
        $pre_insert->execute();

        $insert_flg = true;
        if ($pre_insert->rowCount() == 0) {
            $pre_update->bindValue('group_id', $group_id);
            $pre_update->bindValue('email', $arrCSV[0]);
            $pre_update->bindValue('create_date', $arrCSV[1]);
            $pre_update->bindValue('memo01', $arrCSV[2]);
            $pre_update->bindValue('memo02', $arrCSV[3]);
            $pre_update->bindValue('memo03', $arrCSV[4]);
            $pre_update->bindValue('memo04', $arrCSV[5]);
            $pre_update->bindValue('memo05', $arrCSV[6]);
            $pre_update->bindValue('memo06', $arrCSV[7]);
            $pre_update->bindValue('memo07', $arrCSV[8]);
            $pre_update->bindValue('memo08', $arrCSV[9]);
            $pre_update->bindValue('memo09', $arrCSV[10]);
            $pre_update->bindValue('memo10', $arrCSV[11]);
            $pre_update->execute();

            $insert_flg = false;
        }

        return $insert_flg;
    }

    private function checkError($app, &$arrCSV) {
        $app['monolog.PostCarrier']->info("arrCSV=".print_r($arrCSV,true));

        $arrErr = array();

        $email = $arrCSV[0];
        $errors = $app['validator']->validateValue($email, array(
            new Assert\NotBlank(),
            // configでこの辺りは変えられる方が良さそう
            new Assert\Email(array('strict' => true)),
            new Assert\Regex(array(
                'pattern' => '/^[[:graph:][:space:]]+$/i',
                'message' => 'form.type.graph.invalid',
            )),
            new Assert\Length(array('max' => 128)),
        ));
        if ($errors->count() != 0) {
            $arrErr[] = "メールアドレス $email に誤りがあります。";
        }
        
        if (array_key_exists(1, $arrCSV) && $arrCSV[1] != '') {
            $ts = strtotime($arrCSV[1]);
            if ($ts) {
                $arrCSV[1] = date('Y-m-d H:i:s', $ts);
            } else {
                $arrErr[] = "登録日の形式に誤りがあります: ${arrCSV[1]}";
            }
        } else {
            $arrCSV[1] = date('Y-m-d H:i:s');
        }

        $rec_count = count($arrCSV);
        for ($i = 2; $i < $rec_count; $i++) {
        }
        for ($i = $rec_count; $i < 12; $i++) {
            $arrCSV[$i] = '';
        }

        $app['monolog.PostCarrier']->info("error=".print_r($errors,true));

        return $arrErr;
    }
}
