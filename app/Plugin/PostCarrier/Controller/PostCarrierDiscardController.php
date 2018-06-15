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

class PostCarrierDiscardController
{
    /**
     * 一覧表示
     */
    public function index(Application $app, Request $request, $page_no = null)
    {
        if (PostCarrierUtil::checkNotConfigured($app)) {
            return $app->redirect($app->url('plugin_PostCarrier_config'));
        }

        $action = $request->get('action');

        $builder = $app['form.factory']->createBuilder('postcarrier_discard');
        $builder->remove('email');
        $builder->add('email', 'email', array(
                'label' => '配信除外アドレス',
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    // configでこの辺りは変えられる方が良さそう
                    new Assert\Email(array('strict' => true)),
                    new Assert\Regex(array(
                        'pattern' => '/^[[:graph:][:space:]]+$/i',
                        'message' => 'form.type.graph.invalid',
                    )),
                    new Assert\Length(array('max' => 128)),
                ),
            ));
        $form = $builder->getForm();
        $form->handleRequest($request);
        $formData = $form->getData();

        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }
        $page_no = $page_no === null ? 1 : $page_no;
        $offset = $page_count * ($page_no - 1);

        $data = array();
        $item_count = 0;

        if ('POST' === $request->getMethod() && $form->isValid()) {
            if ($action == 'add') {
                $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->saveDiscard($isError, $formData['email']);
                if ($isError) {
                    $msg = 'admin.postcarrier.request.failed';
                    if (array_key_exists('message', $result)) {
                        $msg = $result['message'];
                    }
                    $app->addError($msg, 'admin');
                } else {
                    $app->addSuccess('登録しました。', 'admin');
                }
            } else if ($action == 'search') {
                $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->searchDiscard($isError, $formData['email']);
                if ($isError) {
                    if (array_key_exists('message', $result)) {
                        $msg = $result['message'];
                    }
                    $app->addError($msg, 'admin');

                    $item_count = 0;
                    $result = array();
                } else {
                    $item_count = 1;
                    $data = $result;
                }
            }
        }

        if ($action != 'search') {
            $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getDiscardList($isError, $item_count, $page_count, $offset);
            if ($isError) {
                $app->addError('admin.postcarrier.request.failed', 'admin');
                $item_count = 0;
                $result = array();
            } else {
                $data = $result;
            }
        }

        $pagination = $app['paginator']()->paginate(array(), $page_no, $page_count);
        $pagination->setItems($data);
        $pagination->setTotalItemCount($item_count);

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/discard.twig', array(
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

        $builder = $app['form.factory']->createBuilder('postcarrier_discard');
        $builder->remove('import_file');
        $builder->add('import_file', 'file', array(
                'label' => false,
                'mapped' => false,
                'required' => false,
                'constraints' => array(
                    new Assert\NotBlank(array('message' => 'ファイルを選択してください。')),
                    new Assert\File(array(
                        'maxSize' => $app['config']['csv_size'] . 'M',
                        'maxSizeMessage' => 'CSVファイルは' . $app['config']['csv_size'] . 'M以下でアップロードしてください。',
                    )),
                ),
            ));
        $form = $builder->getForm();

        $headers = $this->getCsvHeader();

        if ('POST' === $request->getMethod()) {

            $form->handleRequest($request);

            if ($form->isValid()) {
                $formFile = $form['import_file']->getData();
                $formData = $form->getData();

                if (!empty($formFile)) {
                    $filename = $this->getUploadFileName($app, $formFile);
                    $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->saveDiscardFile($filename);
                }
            }
        }

        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }
        $page_no = 1;
        $offset = $page_count * ($page_no - 1);

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getDiscardList($isError, $item_count, $page_count, $offset);

        $pagination = $app['paginator']()->paginate(array(), $page_no, $page_count);
        $pagination->setItems($result);
        $pagination->setTotalItemCount($item_count);

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/discard.twig', array(
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
     * 廃品除外アドレスの削除
     * @param Application $app
     * @param Request $request
     */
    public function add(Application $app, Request $request)
    {
        if ('POST' !== $request->getMethod()) {
            return $app->redirect($app->url('admin_postcarrier_discard'));
        }

        $form = $app['form.factory']->createBuilder('postcarrier_discard', null)->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $formData = $form->getData();
            $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->saveDiscard($formData['email']);
        }

        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }
        $page_no = 1;
        $offset = $page_count * ($page_no - 1);

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getDiscardList($isError, $item_count, $page_count, $offset);

        $pagination = $app['paginator']()->paginate(array(), $page_no, $page_count);
        $pagination->setItems($result);
        $pagination->setTotalItemCount($item_count);

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/discard.twig', array(
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
    public function delete(Application $app, Request $request, $email)
    {
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->deleteDiscard($isError, $email);
        if ($isError) {
            $msg = 'admin.postcarrier.request.failed';
            if (array_key_exists('message', $result)) {
                $msg = $result['message'];
            }
            $app->addError($msg, 'admin');
        } else {
            $app->addSuccess('削除しました。', 'admin');
        }

        $builder = $app['form.factory']->createBuilder('postcarrier_discard');
        $form = $builder->getForm();
        $form->handleRequest($request);

        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }
        $page_no = 1;
        $offset = $page_count * ($page_no - 1);

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getDiscardList($isError, $item_count, $page_count, $offset);
        if ($isError) {
            $app->addError('admin.postcarrier.request.failed', 'admin');
            $item_count = 0;
            $result = array();
        } else {
            $data = $result;
        }

        $pagination = $app['paginator']()->paginate(array(), $page_no, $page_count);
        $pagination->setItems($data);
        $pagination->setTotalItemCount($item_count);

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/discard.twig', array(
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
     * アップロードされたCSVファイルの行ごとの処理
     *
     * @param $formFile
     * @return CsvImportService
     */
    protected function getUploadFileName($app, $formFile)
    {
        // アップロードされたCSVファイルを一時ディレクトリに保存
        $this->fileName = 'upload_' . Str::random() . '.' . $formFile->getClientOriginalExtension();
        $formFile->move($app['config']['csv_temp_realdir'], $this->fileName);

        return $app['config']['csv_temp_realdir'] . '/' . $this->fileName;
    }

    public function csvExport(Application $app, Request $request)
    {
        // タイムアウトを無効にする.
        set_time_limit(0);

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->downloadDiscardList($isError);
        if (!$isError) {
            $app['monolog.PostCarrier']->info('result='.strlen($result));
            $filename = "discard_address.zip";
            Header("Content-disposition: attachment; filename=${filename}");
            Header("Content-type: application/octet-stream; name=${filename}");
            Header("Cache-Control: ");
            Header("Pragma: ");
            echo $result;
            exit;
        } else {
            return $app->redirect($app->url('admin_postcarrier_discard'));
        }
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
}
