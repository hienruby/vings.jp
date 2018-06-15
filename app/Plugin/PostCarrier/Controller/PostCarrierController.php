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
use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use Symfony\Component\Validator\Constraints as Assert;
use Plugin\PostCarrier\Entity\PostCarrierOrderDetail;
use Plugin\PostCarrier\Util\PostCarrierUtil;

require_once(dirname(__FILE__)."/../vendor/phphtmlparser/htmlparser.inc");

class PostCarrierController
{

    /**
     * PostCarrier画面
     *
     * @param Application $app
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Application $app, Request $request, $page_no = null)
    {
        if (PostCarrierUtil::checkNotConfigured($app)) {
            return $app->redirect($app->url('plugin_PostCarrier_config'));
        }

        $searchForm = $app['form.factory']
            ->createBuilder('postcarrier')
            ->getForm();

        $pagination = null;

        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        $mode = $request->get('mode');

        $session = $request->getSession();

        $customerCount = 0;

        $onload_action = '';

        if ('POST' === $request->getMethod() && $mode !== 'back') {
            // 1ページ目の検索

            $idValid = false;
            $searchForm->handleRequest($request);
            if ($searchForm->isValid()) {
                $searchData = $searchForm->getData();
                
                // 本会員かメルマガ会員か、最低どちらかを選択するのが必須
                if ($searchData['mail_type_web'] != 1 && $searchData['mail_type_c'] != 1) {
                    $msg = '※ いずれかの検索対象を選択してください。';
                    $searchForm->get('mail_type_web')->addError(new FormError($msg));
                    $searchForm->get('mail_type_c')->addError(new FormError($msg));
                } else if ($searchData['mail_type_c'] == 1 && count($searchData['group']) == 0) {
                    $msg = "メルマガグループが選択されていません。";
                    $searchForm->get('group')->addError(new FormError($msg));
                } else {
                    $idValid = true;
                }
            }

            if ($idValid) {
                // 会員の配信停止・削除処理
                $delete_id = $request->get('delete_id');
                if ($mode == 'delete_web') {
                    $Customer = $app['eccube.plugin.postcarrier.repository.postcarrier_mailmaga_customer']->findOneBy(array('customer_id' => $delete_id));
                    $Customer->setMailmagaFlg(3);
                    $app['eccube.plugin.postcarrier.repository.postcarrier_mailmaga_customer']->save($Customer);
                } else if ($mode == 'delete_mail') {
                    $Customer = $app['eccube.plugin.postcarrier.repository.postcarrier_group_customer']->find($delete_id);
                    if ($Customer) {
                        $app['eccube.plugin.postcarrier.repository.postcarrier_group_customer']->delete($Customer);
                    }
                } else if ($mode == 'customer_export') {
                    $this->csvExport($app, $searchData);
                }

                // 検索ボタンクリック時の処理
                $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->setApplication($app);
                $customerCount = $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->searchMixCustomerData($searchData, null, 0, true);

                $page_no = 1;
                $offset = 0;
                $customerData = $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->searchMixCustomerData($searchData, null, 0, false, $offset, $page_count);

                $pagination = $app['paginator']()->paginate(
                                                            array(),
                                                            $page_no,
                                                            $page_count
                                                            );
                $pagination->setItems($customerData);
                $pagination->setTotalItemCount($customerCount);

                $app['monolog.PostCarrier']->info("customerCount=$customerCount");

                // 検索データをsessionに保持
                $session->set('eccube.admin.postcarrier.search', $searchData);
                $session->set('eccube.admin.postcarrier.search.page_no', $page_no);

                $onload_action = 'search_scroll();';
            } 
        } else if (is_null($page_no) && $mode !== 'back') {
            // 検索画面初期表示
            $initData = array(
                'buy_product_id_conjunction' => 'or',
                'buy_product_code_conjunction' => 'or',
                'buy_product_code_conjunction2' => 'or',
                'buy_product_name_conjunction' => 'or',
                'event_buy_product_id_conjunction' => 'or',
            );
            $searchForm->setData($initData);

            // 検索データをsessionから削除
            $session->remove('eccube.admin.postcarrier.search');
            $session->remove('eccube.admin.postcarrier.search.page_no');
        } else {
            // 2ページ目以降の検索またはテンプレート設定画面からの戻り

            // 検索データをsessionから取得
            $searchData = $session->get('eccube.admin.postcarrier.search');
            if (is_null($page_no)) {
                $page_no = intval($session->get('eccube.admin.postcarrier.search.page_no'));
            } else {
                $session->set('eccube.admin.postcarrier.search.page_no', $page_no);
            }

            if (!is_null($searchData)) {

                $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->setApplication($app);
                $customerCount = $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->searchMixCustomerData($searchData, null, 0, true);

                $page_no = $page_no ? $page_no : 1;
                $offset = ($page_no - 1) * $page_count;
                $customerData = $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->searchMixCustomerData($searchData, null, 0, false, $offset, $page_count);

                $pagination = $app['paginator']()->paginate(
                                                            array(),
                                                            $page_no,
                                                            $page_count
                                                            );
                $pagination->setItems($customerData);
                $pagination->setTotalItemCount($customerCount);

                // 検索条件を復元する
                $searchData = $this->restoreSessionSearchData($searchData, $app);
                $searchForm->setData($searchData);

                $onload_action = 'search_scroll();';
            }
        }

        return $app->render('PostCarrier/Resource/template/admin/index.twig', array(
            'searchForm' => $searchForm->createView(),
            'pagination' => $pagination,
            'page_no' => $page_no,
            'pageMaxis' => $pageMaxis,
            'page_count' => $page_count,
            'customerCount' => $customerCount,
            'onload_action' => $onload_action,
        ));
    }

    /**
     * テンプレート選択
     * RequestがPOST以外の場合はBadRequestHttpExceptionを発生させる
     * @param Application $app
     * @param Request $request
     * @param string $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function select(Application $app, Request $request, $id = null) {
        // POSTでない場合は終了する
        if ('POST' !== $request->getMethod()) {
            throw new BadRequestHttpException();
        }

        $mode = $request->get('modal');

        // Formの取得
        $builder = $app['form.factory']->createBuilder('postcarrier', null);
        if ($mode == 'test_delivery') {
            $builder->remove('testAddress');
            $builder->add('testAddress', 'email', array(
                'label' => 'テスト配信アドレス',
                'required' => true,
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

            $this->addTemplateValidation($builder);
        }
        $form = $builder->getForm();
        $form->handleRequest($request);
        $formData = $form->getData();

        $form = $this->doSelect($app, $form, $formData, $id, $mode);

        // 商品検索フォーム
        $builder = $app['form.factory']
            ->createBuilder('admin_search_product');
        $searchProductModalForm = $builder->getForm();

        return $app->render('PostCarrier/Resource/template/admin/template_select.twig', array(
                'form' => $form->createView(),
                'id' => $id,
                'searchProductModalForm' => $searchProductModalForm->createView(),
        ));
    }

    private function doSelect($app, $form, $formData, $id = null, $mode = '') {
        // プログラム側で更新するデータ
        $updateData = array();

        // 商品削除と、商品名と商品コードの設定
        $OrderDetails = array();
        foreach ($formData['OrderDetails'] as $OrderDetail) {
            if ($OrderDetail->getProduct()) { // 削除時はnullになる
                $OrderDetail->setProductName($OrderDetail->getProduct()->getName());
                $OrderDetail->setProductCode($OrderDetail->getProductClass()->getCode());
                $OrderDetails[] = $OrderDetail;
            }
        }
        $updateData['OrderDetails'] = $OrderDetails;

        $StopOrderDetails = array();
        foreach ($formData['StopOrderDetails'] as $OrderDetail) {
            if ($OrderDetail->getProduct()) {
                $OrderDetail->setProductName($OrderDetail->getProduct()->getName());
                $OrderDetail->setProductCode($OrderDetail->getProductClass()->getCode());
                $StopOrderDetails[] = $OrderDetail;
            }
        }
        $updateData['StopOrderDetails'] = $StopOrderDetails;

        if ($mode == 'test_delivery') {
            if($form->isValid()) {
                $formLinkData = $this->doLink($formData);

                $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->setApplication($app);
                $customerData = $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->searchMixCustomerData($formLinkData, null, 0, false, 0, 1);
                $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->testMail($isError, $formLinkData, $customerData[0], $formLinkData['testAddress']);
                if ($isError) {
                    $msg = 'テスト配信に失敗しました。';
                    if (array_key_exists('message', $result)) {
                        $msg = $result['message'];
                    }
                    $app->addError($msg, 'admin');
                } else {
                    $app->addSuccess('テスト配信を実行しました。', 'admin');
                }
            } 
        } else if ($mode == 'select_event') {
            switch ($formData['event']) {
            case 'commitDate': case 'orderDate':
                break;
            default:
                $updateData['event_buy_product_count_only'] = 0;
            }
        } else if ($mode == 'no_start_condition') {
            $updateData['event_buy_product_count_only'] = 0;
            $updateData['OrderDetails'] = array();
        } else if ($mode == 'start_count_condition') {
            $updateData['event_buy_product_count_only'] = 1;
            $updateData['OrderDetails'] = array();
        } else if ($mode == 'no_stop_condition') {
            $updateData['StopOrderDetails'] = array();
        } else if ($mode == 'modal') {
            $list = $updateData['OrderDetails'];
            $addOrderDetail = array_pop($list);
            $addProductId = $addOrderDetail->getProduct()->getId();

            // 重複していないか確認
            $add = true;
            foreach ($list as $OrderDetail) {
                if ($addProductId === $OrderDetail->getProduct()->getId()) {
                    array_pop($updateData['OrderDetails']);
                    $add = false;
                    break;
                }
            }
            if ($add) {
                // 終了条件に含まれていない事を確認する
                foreach ($updateData['StopOrderDetails'] as $OrderDetail) {
                    if ($addProductId === $OrderDetail->getProduct()->getId()) {
                        array_pop($updateData['OrderDetails']);
                        $app->addError('終了条件に含まれる商品を指定することはできません。', 'admin');
                        break;
                    }
                }
            }

            $updateData['event_buy_product_count_only'] = 0;
            if (!$formData['event_buy_product_id_conjunction']) {
                $updateData['event_buy_product_id_conjunction'] = 'or';
            } 
        } else if ($mode == 'add_stop_product') {
            $list = $updateData['StopOrderDetails'];
            $addOrderDetail = array_pop($list);
            $addProductId = $addOrderDetail->getProduct()->getId();

            // 重複していないか確認
            $add = true;
            foreach ($list as $OrderDetail) {
                if ($addProductId === $OrderDetail->getProduct()->getId()) {
                    array_pop($updateData['StopOrderDetails']);
                    $add = false;
                    break;
                }
            }
            if ($add) {
                // 開始条件に含まれていない事を確認する
                foreach ($updateData['OrderDetails'] as $OrderDetail) {
                    if ($addProductId === $OrderDetail->getProduct()->getId()) {
                        array_pop($updateData['StopOrderDetails']);
                        $app->addError('開始条件に含まれる商品を指定することはできません。', 'admin');
                        break;
                    }
                }
            }
        } else if ($mode == 'delete_start_product') {
            // 上で処理済
        } else if ($mode == 'delete_stop_product') {
            // 上で処理済
        } else if ($id) {
            // テンプレートが選択されている場合はテンプレートデータを取得する
            $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getTemplate($isError, $id);
            if ($isError) {
                $app->addError('admin.postcarrier.request.failed', 'admin');
            } else {
                $form = $app['form.factory']
                    ->createBuilder('postcarrier', null)
                    ->getForm();

                $BaseInfo = $app['eccube.repository.base_info']->get();
                $data = PostCarrierTemplateController::extractTemplate($result, $BaseInfo->getEmail03()); // XXX ポストキャリア設定情報を渡す
                $data['text_mail_flg'] = 1;
                $updateData = array_merge($updateData, $data); // 選択したテンプレートのデータで上書きする
            }
        } else {
            // 初期値を設定
            if (!$formData['mail_method']) {
                $updateData['mail_method'] = 2;
            }

            if (!$formData['sendFor']) {
                $updateData['sendFor'] = 'PC';
            }

            if (!$formData['fromAddr']) {
                $BaseInfo = $app['eccube.repository.base_info']->get();
                $updateData['fromAddr'] = $BaseInfo->getEmail03();
            }

            if (!$formData['schedule_date']) {
                $formData['schedule_date'] = new \DateTime();
                $formData['schedule_date']->modify('+1 hours');
            }

            if (!$formData['text_mail_flg'] && $formData['mail_type_web'] == 1) {
                $formData['text_mail_flg'] = 1;
            }
            if ($formData['mail_type_web'] != 1) { // メルマガ会員配信時は強制的にクリア
                $formData['text_mail_flg'] = 2;
            }
        }

        // プログラム側更新データを反映
        if ($updateData) {
            $builder = $app['form.factory']->createBuilder('postcarrier', null);

            // 差込み項目を検索対象で変化させる。
            $itemData = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getInsetList($formData['mail_type_web'], $formData['mail_type_c']);
            $builder->remove('subject_item');
            $builder->remove('sub_body_item');
            $builder->add('subject_item', 'choice', array(
                'label' => '差し込み項目',
                'required' => false,
                'choices' => $itemData,
                'empty_value' => null,
            ))
            ->add('sub_body_item', 'choice', array(
                'label' => '代替本文の差し込み項目',
                'required' => false,
                'choices' => $itemData,
                'empty_value' => null,
            ));

            // メルマガ会員では、「会員登録日」のみ選択可能
            if ($formData['mail_type_c'] == 1) {
                $eventListMail = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getStepMailNameArray(1);
                $builder->remove('event');
                $builder->add('event', 'choice', array(
                    'choices' => $eventListMail,
                ));
            }

            if ($formData['re_edit']) {
                // 再編集時は、配信方法の変更を許さない
                $items = array(
                    'immediate' => '即時配信',
                    'schedule' => 'スケジュール配信',
                    'event' => 'ステップメール',
                    'periodic' => '定期配信',
                );

                $builder->remove('trigger');
                $builder->add('trigger', 'choice', array(
                    'choices' => array(
                        $formData['trigger'] => $items[$formData['trigger']],
                    ),
                    'required' => false,
                    'empty_value' => false,
                    'data' => $formData['trigger'],
                ));
            } else if ($formData['customerCount'] == 0) {
                // 検索件数0件では、即時配信を禁止する。
                $builder->remove('trigger');
                $builder->add('trigger', 'choice', array(
                    'choices' => array(
                        'schedule' => 'スケジュール配信',
                        'event' => 'ステップメール',
                        'periodic' => '定期配信',
                    ),
                    'required' => false,
                    'empty_value' => false,
                ));
            }

            // "前"が選択できるのは、誕生日だけ
            if ($formData['event'] == 'birthday') {
                $builder->remove('eventDaySelect');
                $builder->add('eventDaySelect', 'choice', array(
                    'choices' => array(
                        'back' => '後', 'front' => '前'
                    ),
                    'empty_value' => false,
                ));
            }

            $newForm = $builder->getForm();
            $newData = array_merge($formData, $updateData);
            $newForm->setData($newData);

            // エラー情報を引き継ぐ
            foreach ($form->all() as $child) {
                if (!$child->isValid()) {
                    $error_child = $newForm->get($child->getName());
                    foreach ($child->getErrors() as $error) {
                        $error_child->addError($error);
                    }
                }
            }
            $form = $newForm;
        }

        return $form;
    }

    /**
     * 確認画面の表示
     * RequestがPOST以外の場合はBadRequestHttpExceptionを発生させる
     * @param Application $app
     * @param Request $request
     * @param string $id
     */
    public function confirm(Application $app, Request $request, $id = null) {

        // POSTでない場合は終了する
        if ('POST' !== $request->getMethod()) {
            throw new BadRequestHttpException();
        }

        // Formの作成
        $builder = $app['form.factory']->createBuilder('postcarrier', null);
        $form = $builder->getForm();
        $form->handleRequest($request);
        $formData = $form->getData();

        // メルマガテンプレート用にvalidationを付与する
        $this->addValidation($builder, $formData);

        $form = $builder->getForm();
        $form->handleRequest($request);
        $formData = $form->getData();

        $itemData = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getInsetList($formData['mail_type_web'], $formData['mail_type_c']);
        $this->checkInsertText($form, 'subject', $formData['subject'], $itemData);
        $this->checkInsertText($form, 'body', $formData['body'], $itemData);
        $this->checkInsertText($form, 'sub_body', $formData['sub_body'], $itemData);

        // validationを実行する
        if(!$form->isValid()) {

            $form = $this->doSelect($app, $form, $formData);

            // 商品検索フォーム
            $builder = $app['form.factory']
                ->createBuilder('admin_search_product');
            $searchProductModalForm = $builder->getForm();

            // エラーの場合はテンプレート選択画面に遷移する
            return $app->render('PostCarrier/Resource/template/admin/template_select.twig', array(
                    'form' => $form->createView(),
                    'id' =>  $id,
                    'searchProductModalForm' => $searchProductModalForm->createView(),
            ));

        }

        $body = $form['body']->getData();
        $bgcolor = '#ffffff';

        // bodyタグからbgcolorを取得する。
        if (preg_match('{<body\s.*?bgcolor=("|\')(.+?)\\1}i', $body, $matches)) {
            $bgcolor = $matches[2];
        }
        // bodyタグはdivタグに変換
        $body = preg_replace('{<(|/)body(?:|\s[^>]*)>}i', '<${1}div>', $body);

        $triggerList = array(
            "immediate" => "即時配信",
            "schedule" => "スケジュール配信",
            "event" => "ステップメール",
            "periodic" => "定期配信",
        );
        $triggerDisp1 = $triggerList[$formData['trigger']];
        $triggerDisp2 = $this->createTriggerDisp($formData);

        return $app->render('PostCarrier/Resource/template/admin/confirm.twig', array(
                'form' => $form->createView(),
                'id' =>  $id,
                'subject_itm' => $form['subject']->getData(),
                'previewbody' => $body,
                'bodybgcolor' => $bgcolor,
                'triggerDisp1' => $triggerDisp1,
                'triggerDisp2' => $triggerDisp2,
        ));
    }

    /**
     * 配信処理
     * 配信終了後配信履歴に遷移する
     * RequestがPOST以外の場合はBadRequestHttpExceptionを発生させる
     * @param Application $app
     * @param Request $request
     * @param string $id
     */
    public function commit(Application $app, Request $request, $id = null) {

        // POSTでない場合は終了する
        if ('POST' !== $request->getMethod()) {
            throw new BadRequestHttpException();
        }

        // Formを取得する
        $form = $app['form.factory']
            ->createBuilder('postcarrier', null)
            ->getForm();
        $form->handleRequest($request);
        $formData = $form->getData();

        if (!$form->isValid()) {

            $form = $this->doSelect($app, $form, $formData);

            // 商品検索フォーム
            $builder = $app['form.factory']
                ->createBuilder('admin_search_product');
            $searchProductModalForm = $builder->getForm();

            // エラーの場合はテンプレート選択画面に遷移する
            return $app->render('PostCarrier/Resource/template/admin/template_select.twig', array(
                    'form' => $form->createView(),
                    'id' =>  $id,
                    'searchProductModalForm' => $searchProductModalForm->createView(),
            ));
        }

        $triggerDisp2 = $this->createTriggerDisp($formData);
        if ($triggerDisp2) {
            $formData['triggerDisp2'] = $triggerDisp2;
        }

        $formLinkData = $this->doLink($formData);

        $formLinkData = $this->setOrderDetailProductInfo($formLinkData);

        $isError = false;
        $error_msg = '';
        $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->setApplication($app);

        // テキストメールか再編集なら一度の配信操作でok
        if ($formLinkData['mail_method'] == '2' || $formLinkData['text_mail_flg'] != '1' || (array_key_exists('re_edit', $formLinkData) && $formLinkData['re_edit']) || $formLinkData['mail_type_web'] != '1') {
            $customerCount = $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->searchMixCustomerData($formLinkData, null, 0, true);
            $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->delivery($isError, $formLinkData, $customerCount);
        } else {
            /*
             * HTML/TEXT希望に応じて自動で投げ分ける
             */

            $formDataHtml = $formLinkData;
            $formDataHtml['htmlmail'] = '1'; // 抽出条件: HTML
            $formDataHtml['re_edit'] = true; // フラグを設定して、編集時に再度二件予約するのを防ぐ。
            $customerCountHtml = $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->searchMixCustomerData($formDataHtml, null, 0, true);
            $app['monolog.PostCarrier']->info("HTML customerCount=$customerCountHtml");
            if ($formDataHtml['trigger']!='immediate' || 0 < $customerCountHtml) {
                $result = $resultHtml = $app['eccube.plugin.postcarrier.service.postcarrier_request']->delivery($isError, $formDataHtml, $customerCountHtml);
            }

            if (!$isError) {
                $formDataText = $formLinkData;
                if (array_key_exists('deliveryId', $formDataText)) {
                    unset($formDataText['deliveryId']); // 二件目は新規予約
                }
                $formDataText['re_edit'] = true; // フラグを設定して、編集時に再度二件予約するのを防ぐ。
                $formDataText['htmlmail'] = '2'; // 抽出条件: TEXT
                $formDataText['mail_method'] = 2;
                $formDataText['mail_type_c'] = false;
                // メルマガ会員属性は削除する。
                $formDataText['subject'] = preg_replace('/\$\{メルマガ会員:.*?\}/u', '', $formDataText['subject']);
                $formDataText['body'] = preg_replace('/\$\{メルマガ会員:.*?\}/u', '', $formDataText['sub_body']);
                $formDataText = $this->doLink($formDataText);
                $customerCountText = $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->searchMixCustomerData($formDataText, null, 0, true);
                $app['monolog.PostCarrier']->info("TEXT customerCount=$customerCountText");
                if ($formDataText['trigger']!='immediate' || 0 < $customerCountText) {
                    $result = $resultText = $app['eccube.plugin.postcarrier.service.postcarrier_request']->delivery($isError, $formDataText, $customerCountText);
                    if ($isError && $formDataText['trigger']!='immediate') {
                        // 先に予約したHTML配信予約を削除する。
                        $app['eccube.plugin.postcarrier.service.postcarrier_request']->schedulerDelete($resultHtml->deliveryId);
                    }
                } else if ($customerCountHtml == 0) {
                    $error_msg = '抽出件数0件のため実行できません';
                }
            }
        }

        if ($isError || $error_msg) {
            if ($error_msg)
                $app->addError($error_msg, 'admin');

            if ($isError)
                $app->addError($result['message'], 'admin');

            $app['monolog.PostCarrier']->info("result=".$result['message']);

            $form = $this->doSelect($app, $form, $formData);

            // 商品検索フォーム
            $builder = $app['form.factory']
                ->createBuilder('admin_search_product');
            $searchProductModalForm = $builder->getForm();

            // エラーの場合はテンプレート選択画面に遷移する
            return $app->render('PostCarrier/Resource/template/admin/template_select.twig', array(
                    'form' => $form->createView(),
                    'id' =>  $id,
                    'searchProductModalForm' => $searchProductModalForm->createView(),
            ));
        }

        switch ($formData['trigger']) {
        case 'schedule':
            $redirect_url = $app->url('admin_postcarrier_schedule');
            break;
        case 'event': 
        case 'periodic':
            $redirect_url = $app->url('admin_postcarrier_stepmail');
            break;
        default:
            $redirect_url = $app->url('admin_postcarrier_history');
            break;
        }
        return $app->redirect($redirect_url);
    }

    public function researchHistory(Application $app, Request $request, $id)
    {
        $pagination = null;
        $searchForm = $app['form.factory']
            ->createBuilder('postcarrier')
            ->getForm();

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getDelivery($id);

        $searchData = unserialize($result['memo']);
        $searchData = $this->restoreSearchData($searchData, $app);

        // テンプレート情報を復元
        $BaseInfo = $app['eccube.repository.base_info']->get();
        $templateData = PostCarrierTemplateController::extractTemplate($result, $BaseInfo->getEmail03());

        // HTML/テキストの投げ分け設定をクリアする。
        $templateData['htmlmail'] = '';
        $templateData['re_edit'] = 0; // 再検索の時は制限しない

        $searchData = array_merge($searchData, $templateData);

        $searchForm->setData($searchData);

        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/index.twig', array(
            'searchForm' => $searchForm->createView(),
            'pagination' => $pagination,
            'page_no' => 1,
            'pageMaxis' => $pageMaxis,
            'page_count' => $page_count,
            'customerCount' => 0,
            'onload_action' => '',
        ));
    }

    public function edit(Application $app, Request $request, $id) {
        $pagination = null;
        $searchForm = $app['form.factory']
            ->createBuilder('postcarrier')
            ->getForm();

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getDelivery($id);

        $searchData = unserialize($result['memo']);
        $searchData = $this->restoreSearchData($searchData, $app);

        // テンプレート情報を復元
        $BaseInfo = $app['eccube.repository.base_info']->get();
        $templateData = PostCarrierTemplateController::extractTemplate($result, $BaseInfo->getEmail03());
        //$app['monolog.PostCarrier']->info("templateData=".print_r($templateData,true));
        $searchData = array_merge($searchData, $templateData);

        // 編集時はdeliveryIdを引き継ぐ
        $searchData['deliveryId'] = $id;

        $searchForm->setData($searchData);

        $page_count = $request->get('page_count');
        if (empty($page_count)) {
            $page_count = $app['config']['default_page_count'];
        }

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/index.twig', array(
            'searchForm' => $searchForm->createView(),
            'pagination' => $pagination,
            'page_no' => 1,
            'pageMaxis' => $pageMaxis,
            'page_count' => $page_count,
            'customerCount' => 0,
            'onload_action' => '',
        ));
    }

    //リンク抽出ボタンクリック時の処理
    function doLink($formData){

        if (defined('POSTCARRIER_ENABLE_CLICK_COUNT_FLG') && POSTCARRIER_ENABLE_CLICK_COUNT_FLG === false) {
            return;
        }

        $linkArrays = array();
        if($formData['mail_method']=="1"){
            $parser = new \HtmlParser($formData['body']);
            while ($parser->parse()){
                if($parser->iNodeType == NODE_TYPE_ELEMENT
                && ($parser->iNodeName === "a" || $parser->iNodeName === "A")){

                    $subject = $parser->iNodeAttributes["href"];
                    $parser->parse();	//text部まで進める
                    $pattern = "{s?https?://[-_.!~*'()a-zA-Z0-9;/?:@&=+$,%#]+}";

                    if(preg_match($pattern, $subject)){
                        $linkArrays[] = array($subject, $parser->iNodeValue);
                    }
                }
            }

            $tmpBody = $formData['body'];
            $tmpCount = 1;
            foreach($linkArrays as $linkArray){
                $pattern = "(<a(\s.*?)href( |)=( |)('|\")".preg_quote($linkArray[0])."('|\"))i";
                $replacement = '<a${1}href="${リンク#'.$tmpCount.'}"';
                $tmpBody = preg_replace($pattern, $replacement, $tmpBody, 1);
                $tmpCount++;
            }

            $formData['body'] = $tmpBody;

        }else if($formData['mail_method']=="2"){
            $tmpBody = $formData['body'];
            $tmpCount = 1;
            $pattern = "{s?https?://[-_.!~*'()a-zA-Z0-9;/?:@&=+$,%#]+}";
            while(preg_match($pattern, $tmpBody, $matches)){
                $replacement = '${リンク#'.$tmpCount.'}';
                $tmpBody = preg_replace($pattern, $replacement, $tmpBody, 1);

                $tmpArray = explode('/',$matches[0]);
                $linkArrays[] = array($matches[0], substr($matches[0], strlen($tmpArray[0].'/'.$tmpArray[1].'/'.$tmpArray[2])));
                $tmpCount++;
            }

            $formData['body'] = $tmpBody;
        }

        $formData['link_count'] = count($linkArrays);
        for($i=0; $i < count($linkArrays); $i++){
            $formData['linkUrl'.($i+1)] = $linkArrays[$i][0];
            $formData['linkValue'.($i+1)] = $linkArrays[$i][1];
        }

        return $formData;
    }

    private function restoreSearchData($data, $app) {
        if ($data['sex']) {
            $data['sex'] = $app['eccube.repository.master.sex']->findBy(array('id' => $data['sex']));
        }

        if ($data['pref']) {
            $data['pref'] = $app['eccube.repository.master.pref']->find($data['pref']);
        }

        if ($data['buy_category']) {
            $data['buy_category'] = $app['eccube.repository.category']->find($data['buy_category']);
        }

        if ($data['payment']) {
            $data['payment'] = $app['eccube.repository.payment']->findBy(array('id' => $data['payment']));
        }

        if ($data['status']) {
            $data['status'] = $app['eccube.repository.master.order_status']->find($data['status']);
        }

        if (0 < count($data['OrderDetails'])) {
            $update = array();
            foreach ($data['OrderDetails'] as $OrderDetail) {
                $obj = new PostCarrierOrderDetail();
                $Product = $app['eccube.repository.product']->find($OrderDetail['product_id']);
                $ClassCategory = $app['eccube.repository.product_class']->find($OrderDetail['product_class_id']);
                $obj->setProduct($Product);
                $obj->setProductClass($ClassCategory);
                $update[] = $obj;
            }
            $data['OrderDetails'] = $update;
        }

        if (0 < count($data['StopOrderDetails'])) {
            $update = array();
            foreach ($data['StopOrderDetails'] as $OrderDetail) {
                $obj = new PostCarrierOrderDetail();
                $Product = $app['eccube.repository.product']->find($OrderDetail['product_id']);
                $ClassCategory = $app['eccube.repository.product_class']->find($OrderDetail['product_class_id']);
                $obj->setProduct($Product);
                $obj->setProductClass($ClassCategory);
                $update[] = $obj;
            }
            $data['StopOrderDetails'] = $update;
        }

        if (0 < count($data['group'])) {
            $data['group'] = $app['eccube.plugin.postcarrier.repository.postcarrier_group']->findBy(array('id' => $data['group']));
        }

        return $data;
    }

    private function restoreSessionSearchData($searchData, $app) {
        if (count($searchData['sex']) > 0) {
            $sex_ids = array();
            foreach ($searchData['sex'] as $Sex) {
                $sex_ids[] = $Sex->getId();
            }
            $searchData['sex'] = $app['eccube.repository.master.sex']->findBy(array('id' => $sex_ids));
        }

        if ($searchData['pref']) {
            $searchData['pref'] = $app['eccube.repository.master.pref']->find($searchData['pref']->getId());
        }

        if ($searchData['buy_category']) {
            $searchData['buy_category'] = $app['eccube.repository.category']->find($searchData['buy_category']->getId());
        }

        if (count($searchData['payment']) > 0) {
            $payment_ids = array();
            foreach ($searchData['payment'] as $Payment) {
                $payment_ids[] = $Payment->getId();
            }
            $searchData['payment'] = $app['eccube.repository.payment']->findBy(array('id' => $payment_ids));
        }

        if ($searchData['status']) {
            $searchData['status'] = $app['eccube.repository.master.order_status']->find($searchData['status']->getId());
        }

        if (count($searchData['group']) > 0) {
            $group_ids = array();
            foreach ($searchData['group'] as $Group) {
                $group_ids[] = $Group->getId();
            }
            $searchData['group'] = $app['eccube.plugin.postcarrier.repository.postcarrier_group']->findBy(array('id' => $group_ids));
        }

        return $searchData;
    }

    private function addTemplateValidation($builder) {
        $builder->remove('fromAddr');
        $builder->add('fromAddr', 'email', array(
                'label' => '送信者アドレス',
                'required' => true,
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
        $builder->remove('subject');
        $builder->add('subject', 'text', array(
                'label' => '件名',
                'required' => true,
                'constraints' => array(
                    new NotBlank(),
                    new Assert\Length(array('max' => 100)),
                )
        ));
        $builder->remove('body');
        $builder->add('body', 'textarea', array(
                'label' => '本文',
                'required' => true,
                'constraints' => array(
                    new NotBlank(),
                    new Assert\Length(array('max' => 100000)),
                )
        ));
    }

    private function addValidation($builder, $formData) {

        $this->addTemplateValidation($builder);

        if ($formData['mail_method'] == 1 && $formData['mail_type_web'] == 1 && $formData['text_mail_flg'] == 1) {
            $builder->remove('sub_body');
            $builder->add('sub_body', 'textarea', array(
                'label' => '代替本文',
                'required' => true,
                'attr' => array('cols' => '90', 'rows' => '15'),
                'constraints' => array(
                    new NotBlank(),
                    new Assert\Length(array('max' => 50000)),
                )
            ));
        }

        switch ($formData['trigger']) {
        case 'immediate':
            break;
        case 'schedule':
            $builder->remove('schedule_date');
            $builder->add('schedule_date', 'datetime', array(
                'label' => '配信日時',
                'required' => true,
                'input' => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm',
                'constraints' => array(
                    new NotBlank(),
                    new Assert\GreaterThanOrEqual(array(
                        'value' => new \DateTime(),
                        'message' => "未来の日時を選択してください。",
                    )),
                )
            ));
            break;
        case 'event':
            $builder->remove('eventDay');
            $builder->add('eventDay', 'number', array(
                'constraints' => array(
                    new Assert\Length(array(
                        'max' => 3,
                    )),
                    new Assert\Regex(array(
                        'pattern' => "/^\d+$/u",
                        'message' => 'form.type.numeric.invalid'
                    )),
                    new Assert\Range(array('min' => ($formData['event'] == 'birthday' ? 0 : 1),
                                           'max' => 365)),
                    new NotBlank(),
                ),
            ));
            $builder->remove('stepmail_time');
            $builder->add('stepmail_time', 'time', array(
                'label' => '配信時刻',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'choice',
                'constraints' => array(
                        new NotBlank()
                )
            ));
            break;
        case 'periodic':
            $builder->remove('periodic_time');
            $builder->add('periodic_time', 'time', array(
                'label' => '配信時刻',
                'required' => false,
                'input' => 'datetime',
                'widget' => 'choice',
                'constraints' => array(
                        new NotBlank()
                )
            ));
            break;
        default:
        }
    }

    function createTriggerDisp($formData) {
        $ret = "";

        if($formData['trigger']=="schedule"){
            $ret = $formData['schedule_date']->format('Y年m年d日 H時i分');
        }else if($formData['trigger']=="event"){
            $eventList = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getStepMailNameArray();
            $eventDaySelectList = array("back" => "後", "front" => "前");

            $ret = $eventList[$formData['event']]."の".$formData['eventDay']."日".$eventDaySelectList[$formData['eventDaySelect']]."の".$formData['stepmail_time']->format('H時i分');
        }else if($formData['trigger']=="periodic"){
            $ret = "毎月".$formData['periodic_day']."日の".$formData['periodic_time']->format('H時i分');
        }

        return $ret;
    }

    function setOrderDetailProductInfo($formData) {
        if ($formData['trigger'] != 'event')
            return $formData;

        // 商品名と商品コードの設定
        $OrderDetails = array();
        foreach ($formData['OrderDetails'] as $OrderDetail) {
            $OrderDetail->setProductName($OrderDetail->getProduct()->getName());
            $OrderDetail->setProductCode($OrderDetail->getProductClass()->getCode());

            // 受注日と発送日以外は、購入回数指定は無効
            if ($formData['event'] != 'commitDate' && $formData['event'] != 'orderDate') {
                $OrderDetail->setQuantity(0);
            }

            $OrderDetails[] = $OrderDetail;
        }
        $formData['OrderDetails'] = $OrderDetails;

        $StopOrderDetails = array();
        foreach ($formData['StopOrderDetails'] as $OrderDetail) {
            $OrderDetail->setProductName($OrderDetail->getProduct()->getName());
            $OrderDetail->setProductCode($OrderDetail->getProductClass()->getCode());
            $StopOrderDetails[] = $OrderDetail;
        }
        $formData['StopOrderDetails'] = $StopOrderDetails;

        return $formData;
    }

    public function preview(Application $app, Request $request)
    {
        // POSTでない場合は終了する
        if ('POST' !== $request->getMethod()) {
            throw new BadRequestHttpException();
        }

        // Formの作成
        $builder = $app['form.factory']->createBuilder('postcarrier', null);
        $form = $builder->getForm();
        $form->handleRequest($request);
        $formData = $form->getData();

        // メルマガテンプレート用にvalidationを付与する
        $this->addValidation($builder, $formData);

        $form = $builder->getForm();
        $form->handleRequest($request);
        $formData = $form->getData();

        // テンプレート編集中のpreviewはデータ取得しない
        $customerData = array();
        if ($request->get('previewMode') != 'edit') {
            $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->setApplication($app);
            $customerData = $app['eccube.plugin.postcarrier.repository.postcarrier_customer']->searchMixCustomerData($formData, false, null, null, 0, 1);
        }
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->preview($isError, $formData, $customerData);
        if (!$isError) {
            $body = $result['body'];
            $bgcolor = '#ffffff';

            // bodyタグからbgcolorを取得する。
            if (preg_match('{<body\s.*?bgcolor=("|\')(.+?)\\1}i', $body, $matches)) {
                $bgcolor = $matches[2];
            }
            // bodyタグはdivタグに変換
            $body = preg_replace('{<(|/)body(?:|\s[^>]*)>}i', '<${1}div>', $body);
        }

        return $app->render('PostCarrier/Resource/template/admin/preview_popup.twig', array(
                'form' => $form->createView(),
                'subject' => $result['subject'],
                'previewbody' => $body,
                'bodybgcolor' => $bgcolor,
                'menu' => 'postcarrier',
        ));
    }

    private function csvExport(Application $app, $searchData) {
        // タイムアウトを無効にする.
        set_time_limit(0);

        $sexDisp = array();
        $arrSex = $app['eccube.repository.master.sex']->findAll();
        foreach ($arrSex as $sex) {
            $sexDisp[$sex->getId()] = $sex->getName();
        }
        $arrMailmagaFlgDisp = array(1 => 'HTML', 2 => 'テキスト', 3 => '希望しない');

        //CSVヘッダー情報、出力情報を取得
        list($arrColumn, $arrHeader) = $this->getCsvDownloadHeader($searchData["mail_type_web"], $searchData["mail_type_c"]);
        $header = implode(",", array_values($arrHeader))."\r\n";

        list($sql, $sqlval) = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getCustomerData($searchData, null, false, true);

        $conn = $app['orm.em']->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sqlval);

        $now = new \DateTime();
        $filename = 'postcarrier_' . $now->format('YmdHis') . '.csv';
        Header("Content-disposition: attachment; filename=${filename}");
        Header("Content-type: application/octet-stream; name=${filename}");
        Header("Cache-Control: ");
        Header("Pragma: ");

        $n = 0;
        echo mb_convert_encoding($header, 'SJIS-Win', 'UTF-8');
        while ($data = $stmt->fetch()) {
            if ($data['sex']) $data['sex'] = $sexDisp[$data['sex']];
            if ($data['mailmaga_flg']) $data['mailmaga_flg'] = $arrMailmagaFlgDisp[$data['mailmaga_flg']];

            $escData = array();
            foreach ($data as $val) {
                $escData[] = PostCarrierUtil::escapeCsvData($val);
            }

            echo mb_convert_encoding(implode(',', $escData), 'SJIS-Win', 'UTF-8');
            echo "\r\n";

            if (++$n % 1000 == 0) {
                ob_flush();
                flush();
            }
        }

        ob_flush();
        flush();
        exit;
    }

    private function getCsvDownloadHeader($mail_type_web, $mail_type_c){
        //システム上の必須カラムをセット
        $tempArray = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getCustomerSearchSystemColumn();
        $header_name = $tempArray[0];
        $header_key = $tempArray[1];

        if($mail_type_web=='1'){
            $tempArray = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getCustomerSearchColumn();
            foreach($tempArray as $key => $value){
                $header_name[] = $value;
                $header_key[] = "dtb_customer_".$key;
            }
        }

        if($mail_type_c=='1'){
            $tempArray = \Plugin\PostCarrier\Service\LC_MDL_ECQUBELEY_CONSTANTS::getCsvCustomerSearchColumn();
            foreach($tempArray as $key => $value){
                $header_name[] = $value;
                $header_key[] = "plg_postcarrier_csv_customer_".$key;
            }
        }
        return array($header_key, $header_name);
    }

    private function checkInsertText($form, $param_name, $target, $textArray) {
        //差し込み項目チェック
        preg_match_all('/\$\{(.*?)\}/', $target, $matches);
        $matches = $matches[1];
        foreach( $matches as $Obj ){
            if(strpos($Obj,'絵文字#')===false && strpos($Obj,'リンク#')===false && !in_array($Obj,$textArray)){
                $msg = '利用できない差し込み項目（${'.$Obj.'}）が含まれています。';
                $form->get($param_name)->addError(new FormError($msg));
            }
        }
    }
}
