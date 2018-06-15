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
use Eccube\Common\Constant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception as HttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Plugin\PostCarrier\Util\PostCarrierUtil;

class PostCarrierHistoryController
{
    private $main_title;
    private $sub_title;

    public function __construct()
    {
    }

    /**
     * 配信履歴一覧
     */
    public function index(Application $app, Request $request, $page_no = null)
    {
        if (PostCarrierUtil::checkNotConfigured($app)) {
            return $app->redirect($app->url('plugin_PostCarrier_config'));
        }

        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }
        $page_no = $page_no === null ? 1 : $page_no;
        $offset = $page_count * ($page_no - 1);

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getMailLogList($isError, $item_count, $page_count, $offset);
        if ($isError) {
            $app->addError('admin.postcarrier.request.failed', 'admin');
            $item_count = 0;
            $data = array();
        } else {
            $data = $result;
        }

        $pagination = $app['paginator']()->paginate(array(), $page_no, $page_count);
        $pagination->setItems($data);
        $pagination->setTotalItemCount($item_count);

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/history_list.twig', array(
            'pagination' => $pagination,
            'page_no' => $page_no,
            'pageMaxis' => $pageMaxis,
            'page_count' => $page_count,
        ));
    }

    /**
    * プレビュー
    */
    public function preview(Application $app, Request $request, $id)
    {
        // dtb_send_historyから対象レコード抽出
        // subject/bodyを抽出し、以下のViewへ渡す
        // パラメータ$idにマッチするデータが存在するか判定
        if (is_null($id)) {
            throw new BadRequestHttpException();
        }

        // パラメータ$idにマッチするデータが存在するか判定
        // あれば、subject/bodyを取得
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->previewDelivery($isError, $id);
        if (!$isError) {
            $body = $result['body'];
            $bgcolor = '#ffffff';

            // bodyタグからbgcolorを取得する。
            if (preg_match('{<body\s.*?bgcolor=("|\')(.+?)\\1}i', $body, $matches)) {
                $bgcolor = $matches[2];
            }
            // bodyタグはdivタグに変換
            $body = preg_replace('{<(|/)body(?:|\s[^>]*)>}i', '<${1}div>', $body);
        } else {
            //$this->arrErr['msg'] = $result['message'];
            //$app->addError('admin.postcarrier.template.data.notfound', 'admin');
            return $app->redirect($app->url('admin_postcarrier_history'));
        }

        $menu = 'postcarrier_history';
        $return_url = $app->url('admin_postcarrier_history');
        $from = $request->get('from');
        if ($from == 'sch') {
            $menu = 'postcarrier_schedule';
            $return_url = $app->url('admin_postcarrier_schedule');
        } else if ($from == 'step') {
            $menu = 'postcarrier_stepmail';
            $return_url = $app->url('admin_postcarrier_stepmail');
        }

        // プレビューページ表示
        return $app->render('PostCarrier/Resource/template/admin/preview.twig', array(
                'subject' => $result['subject'],
                'previewbody' => $body,
                'bodybgcolor' => $bgcolor,
                'menu' => $menu,
                'return_url' => $return_url,
        ));
    }

    /**
     * 配信条件を表示する
     *
     * @param Application $app
     * @param Request $request
     * @param unknown $id
     * @throws BadRequestHttpException
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function condition(Application $app, Request $request, $id)
    {
        if (is_null($id)) {
            throw new BadRequestHttpException();
        }

        //$id = 11397; // 全条件
        //$id = 11400; // ステップメール
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getDelivery($id);
        /*
        if(is_null($sendHistory)) {
            $app->addError('admin.mailmagazine.history.datanotfound', 'admin');
            return $app->redirect($app->url('admin_postcarrier_history'));
        }
        */

        $searchData = unserialize($result['memo']);

        // 区分値を文字列に変更する
        // 必要な項目のみ
        $displayData = $this->searchDataToDisplayData($searchData, $app);

        $menu = 'postcarrier_history';
        $return_url = $app->url('admin_postcarrier_history');
        $from = $request->get('from');
        if ($from == 'sch') {
            $menu = 'postcarrier_schedule';
            $return_url = $app->url('admin_postcarrier_schedule');
        } else if ($from == 'step') {
            $menu = 'postcarrier_stepmail';
            $return_url = $app->url('admin_postcarrier_stepmail');
        }

        return $app->render('PostCarrier/Resource/template/admin/history_condition.twig', array(
            'search_data' => $displayData,
            'menu' => $menu,
            'return_url' => $return_url,
        ));
    }

    /**
     * search_dataの配列を表示用に変換する.
     *
     * @param unknown $searchData
     */
    protected function searchDataToDisplayData($searchData, $app) {
        //$app['monolog.PostCarrier']->info("searchData=".print_r($searchData,true));

        $data = $searchData;

        // 会員種別
        $val = null;
        if ($searchData['customer_status']) {
            $val = 'メルマガ希望でない本会員を含める(全ての本会員に配信)';
        }
        $data['customer_status'] = $val;

        // 性別
        $val = null;
        if(!is_null($searchData['sex']) && 0 < count($searchData['sex'])) {
            $arrSex = $app['eccube.repository.master.sex']->findBy(array('id' => $searchData['sex']));
            $val = implode(" ", array_map(function ($sex) { return $sex->getName(); }, $arrSex));
        } 
        $data['sex'] = $val;

        // 都道府県
        $val = null;
        if(!is_null($searchData['pref']) && $searchData['pref']) {
            $pref = $app['eccube.repository.master.pref']->find($searchData['pref']);
            $data['pref'] = $pref->getName();
        }
        $data['pref'] = $val;

        // 購入商品カテゴリ
        $val = null;
        if(!is_null($searchData['buy_category']) && $searchData['buy_category']) {
            $buy_category = $app['eccube.repository.category']->find($searchData['buy_category']);
            $val = $buy_category->getName();
        }
        $data['buy_category'] = $val;

        // 支払方法
        $val = null;
        if(!is_null($searchData['payment']) && $searchData['payment']) {
            $arrPayment = $app['eccube.repository.payment']->findBy(array('id' => $searchData['payment']));
            $val = implode(" ", array_map(function ($payment) { return $payment->getMethod(); }, $arrPayment));
        }
        $data['payment'] = $val;

        // 対応状況
        $val = null;
        if(!is_null($searchData['status']) && $searchData['status']) {
            $status = $app['eccube.repository.master.order_status']->find($searchData['status']);
            $val = $status->getName();
        }
        $data['status'] = $val;

        $val = null;
        if(!is_null($searchData['event_buy_product_id_conjunction']) && $searchData['event_buy_product_id_conjunction']) {
            if ($searchData['event_buy_product_id_conjunction'] == 'or') {
                $val = 'いずれかの条件に一致（OR）';
            } else if ($searchData['event_buy_product_id_conjunction'] == 'and') {
                $val = '全ての条件に一致（AND）';
            }
        }
        $data['event_buy_product_id_conjunction'] = $val;

        $val = null;
        if(!is_null($searchData['group']) && $searchData['group']) {
            $tmp = array();
            foreach ($searchData['group'] as $group_id) {
                $Group = $app['eccube.plugin.postcarrier.repository.postcarrier_group']->find($group_id);
                $tmp[] = $Group->getGroupName();
            }
            $val = implode(", ", $tmp);
        }
        $data['group'] = $val;

        return $data;
    }

    /**
     * 配信履歴を論理削除する
     * RequestがPOST以外の場合はBadRequestHttpExceptionを発生させる
     *
     * @param Application $app
     * @param Request $request
     * @param unknown $id
     * @throws BadRequestHttpException
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Application $app, Request $request, $id)
    {

        // POSTかどうか判定
        if ('POST' !== $request->getMethod()) {
            throw new BadRequestHttpException();
        }

        // パラメータ$idにマッチするデータが存在するか判定
        if (!$id) {
            throw new BadRequestHttpException();
        }

        // 配信履歴を取得する
        $sendHistory = $app['eccube.plugin.postcarrier.repository.postcarrier_history']->find($id);

        // 配信履歴がない場合はエラーメッセージを表示する
        if(is_null($sendHistory)) {
            $app->addError('admin.mailmagazine.history.datanotfound', 'admin');
            return $app->redirect($app->url('admin_postcarrier_history'));
        }

        // POSTかつ$idに対応するdtb_send_historyのレコードがあれば、del_flg = 1に設定して更新
        $sendHistory->setDelFlg(Constant::ENABLED);

        $app['orm.em']->persist($sendHistory);
        $app['orm.em']->flush();

        $app->addSuccess('admin.mailmagazine.history.delete.sucesss', 'admin');

        // メルマガテンプレート一覧へリダイレクト
        return $app->redirect($app->url('admin_postcarrier_history'));
    }

    public function result(Application $app, Request $request, $id)
    {
        $arrMarketing = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getMarketing($id, false);

        $arrMarketing['nSent2'] = $arrMarketing['nSent'] - $arrMarketing['nClick'];
        $arrMarketing['nClick2'] = $arrMarketing['nClick'] - $arrMarketing['nConversion'];
        //開封率設定
        if($arrMarketing['nOpened']==0 || $arrMarketing['populationOpened']==0){
            $arrMarketing['nOpened2']=0;
        }else{
            $arrMarketing['nOpened2'] = $arrMarketing['nOpened'] / $arrMarketing['populationOpened'] * 100;
        }

        //配信履歴からHTML配信か否かのフラグを取得
        $htmlMailFlg=false;
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getDelivery($id);
        if($result['message'][0]['type']=='html'){
            $htmlMailFlg=true;
        }

        return $app->render('PostCarrier/Resource/template/admin/history_result.twig', array(
            'id' => $id,
            'subject' => $arrMarketing['subject'],
            'arrMarketing' => $arrMarketing,
            'htmlMailFlg' => $htmlMailFlg,
            'adm_name' => $result['name'],
            'adm_note' => $result['note'],
        ));
    }

    public function resultCustomer(Application $app, Request $request, $id)
    {
        $arrMarketing = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getMarketing($id, true);
        $subject = $arrMarketing['subject'];
        $arrMarketing = $this->createCustomersData($arrMarketing);

        return $app->render('PostCarrier/Resource/template/admin/history_result_customer.twig', array(
            'id' => $id,
            'subject' => $subject,
            'arrMarketing' => $arrMarketing,
        ));
    }

    public function resultLink(Application $app, Request $request, $id)
    {
        $arrMarketing = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getMarketing($id, false);
        $subject = $arrMarketing['subject'];
        $arrMarketing = $this->createLinksData($arrMarketing['links']);

        return $app->render('PostCarrier/Resource/template/admin/history_result_link.twig', array(
            'id' => $id,
            'subject' => $subject,
            'arrMarketing' => $arrMarketing,
        ));
    }


    /**
     * 配信条件を表示する
     *
     * @param Application $app
     * @param Request $request
     * @param unknown $id
     * @throws BadRequestHttpException
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function detail(Application $app, Request $request, $id, $page_no = null)
    {
        if (is_null($id)) {
            throw new BadRequestHttpException();
        }

        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }
        $page_no = $page_no === null ? 1 : $page_no;
        $offset = $page_count * ($page_no - 1);

        $isError = false;
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getMailLog($isError, $id, $item_count, 0);
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getMailLog($isError, $id, $dummy, $page_count, $offset);
        if ($isError || $item_count <= 0) {
            $item_count = 0;
            $data = array();
        } else {
            $data = $result['messages'];
        }

        $pagination = $app['paginator']()->paginate(array(), $page_no, $page_count);
        $pagination->setItems($data);
        $pagination->setTotalItemCount($item_count);

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/history_detail.twig', array(
            'pagination' => $pagination,
            'page_no' => $page_no,
            'pageMaxis' => $pageMaxis,
            'page_count' => $page_count,
            'id' => $id
        ));
    }

    public function detailExport(Application $app, Request $request, $id) {
        // タイムアウトを無効にする.
        set_time_limit(0);

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->downloadMaillog($isError, $id);
        if (!$isError) {
            $filename = "maillog-$id.zip";
            Header("Content-disposition: attachment; filename=${filename}");
            Header("Content-type: application/octet-stream; name=${filename}");
            Header("Cache-Control: ");
            Header("Pragma: ");
            echo $result;
            exit;
        } else {
            return $app->redirect($app->url('admin_postcarrier_history_detail'));
        }
    }

    private function createCustomersData($arrMarketing){
        $maxCount = 0;
        foreach($arrMarketing['result'] as $marketing){
            $count = $marketing['男']['nTotalClick'] + $marketing['女']['nTotalClick'];
            if($maxCount < $count){
                $maxCount = $count;
            }
        }

        $customerData['nTotalClick'] = $maxCount;
        $customerData['scals'] = $maxCount * 1.15;

        $maxCount = 0;
        foreach($arrMarketing['result'] as $marketing){
            $count = $marketing['男']['nTotalConversion'] + $marketing['女']['nTotalConversion'];
            if($maxCount < $count){
                $maxCount = $count;
            }
        }
        $customerData['nTotalConversion'] = $maxCount;

        $clickData = array();
        $clickData[0][0] = $arrMarketing['result']['10代']['女']['nTotalClick'];
        $clickData[0][1] = $arrMarketing['result']['20代']['女']['nTotalClick'];
        $clickData[0][2] = $arrMarketing['result']['30代']['女']['nTotalClick'];
        $clickData[0][3] = $arrMarketing['result']['40代']['女']['nTotalClick'];
        $clickData[0][4] = $arrMarketing['result']['50代']['女']['nTotalClick'];
        $clickData[0][5] = $arrMarketing['result']['60代']['女']['nTotalClick'];
        $clickData[0][6] = $arrMarketing['result']['その他']['女']['nTotalClick'];
        $clickData[1][0] = $arrMarketing['result']['10代']['男']['nTotalClick'];
        $clickData[1][1] = $arrMarketing['result']['20代']['男']['nTotalClick'];
        $clickData[1][2] = $arrMarketing['result']['30代']['男']['nTotalClick'];
        $clickData[1][3] = $arrMarketing['result']['40代']['男']['nTotalClick'];
        $clickData[1][4] = $arrMarketing['result']['50代']['男']['nTotalClick'];
        $clickData[1][5] = $arrMarketing['result']['60代']['男']['nTotalClick'];
        $clickData[1][6] = $arrMarketing['result']['その他']['男']['nTotalClick'];
        $customerData['click'] = $clickData;

        $conversionData = array();
        $conversionData[0][0] = $arrMarketing['result']['10代']['女']['nTotalConversion'];
        $conversionData[0][1] = $arrMarketing['result']['20代']['女']['nTotalConversion'];
        $conversionData[0][2] = $arrMarketing['result']['30代']['女']['nTotalConversion'];
        $conversionData[0][3] = $arrMarketing['result']['40代']['女']['nTotalConversion'];
        $conversionData[0][4] = $arrMarketing['result']['50代']['女']['nTotalConversion'];
        $conversionData[0][5] = $arrMarketing['result']['60代']['女']['nTotalConversion'];
        $conversionData[0][6] = $arrMarketing['result']['その他']['女']['nTotalConversion'];
        $conversionData[1][0] = $arrMarketing['result']['10代']['男']['nTotalConversion'];
        $conversionData[1][1] = $arrMarketing['result']['20代']['男']['nTotalConversion'];
        $conversionData[1][2] = $arrMarketing['result']['30代']['男']['nTotalConversion'];
        $conversionData[1][3] = $arrMarketing['result']['40代']['男']['nTotalConversion'];
        $conversionData[1][4] = $arrMarketing['result']['50代']['男']['nTotalConversion'];
        $conversionData[1][5] = $arrMarketing['result']['60代']['男']['nTotalConversion'];
        $conversionData[1][6] = $arrMarketing['result']['その他']['男']['nTotalConversion'];
        $customerData['conversion'] = $conversionData;

        return $customerData;
    }

    function createLinksData($arrMarketing){
        if(!is_array($arrMarketing)) return array();

        ksort($arrMarketing);
        $maxwidth = 90; //90%
        $maxcount = 0;
        foreach($arrMarketing as $marketing){
            if($maxcount < $marketing['nTotalClick']){
                $maxcount = $marketing['nTotalClick'];
            }
            if($maxcount < $marketing['nTotalConversion']){
                $maxcount = $marketing['nTotalConversion'];
            }
        }

        $tmpArrays = array();
        foreach($arrMarketing as $marketing){
            $url = parse_url($marketing['url']);
            $tmpUrl = $url['path'];
            if(array_key_exists('query', $url) && $url['query']!="") $tmpUrl = $tmpUrl.'?'.$url['query'];
            if(array_key_exists('fragment', $url) && $url['fragment']!="") $tmpUrl = $tmpUrl.'#'.$url['fragment'];
            $marketing['url_short'] =$tmpUrl;

            if($marketing['nTotalClick']==0){
                $marketing['click_width'] = 0;
            }else{
                $marketing['click_width'] = (float)($maxwidth * $marketing['nTotalClick'] / $maxcount);
            }
            if($marketing['nTotalConversion']==0){
                $marketing['conversion_width'] = 0;
            }else{
                $marketing['conversion_width'] = (float)($maxwidth * $marketing['nTotalConversion'] / $maxcount);
            }
            //$marketing['conversion_width'] = (float)($maxwidth * $marketing['nTotalConversion'] / $maxcount);
            $tmpArrays[] = $marketing;
        }
        return $tmpArrays;
    }
}
