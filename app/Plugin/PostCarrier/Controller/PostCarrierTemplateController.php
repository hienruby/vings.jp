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
use Plugin\PostCarrier\Util\PostCarrierUtil;

class PostCarrierTemplateController
{
    private $main_title;
    private $sub_title;

    public function __construct()
    {
    }

    /**
     * 一覧表示
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

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getTemplateList($isError, $item_count, 0);
        if ($isError) {
            $app->addError('admin.postcarrier.request.failed', 'admin');
            $item_count = 0;
            $data = array();
        } else {
            $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getTemplateList($isError, $dummy, $page_count, $offset);
            if ($isError) {
                $app->addError('admin.postcarrier.request.failed', 'admin');
                $item_count = 0;
                $data = array();
            } else {
                $data = $result['templates'];
            }
        }

        $pagination = $app['paginator']()->paginate(
                array(),
                $page_no,
                $page_count
        );
        $pagination->setItems($data);
        $pagination->setTotalItemCount($item_count);

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/template_list.twig', array(
                'pagination' => $pagination,
                'page_no' => $page_no,
                'pageMaxis' => $pageMaxis,
                'page_count' => $page_count,
        ));
    }

    /**
     * preview画面表示
     * @param Application $app
     * @param Request $request
     * @param unknown $id
     * @return void|\Symfony\Component\HttpFoundation\Response
     */
    public function preview(Application $app, Request $request, $id)
    {

        // id の存在確認
        // nullであれば一覧に戻る
        if(is_null($id) || strlen($id) == 0) {
            $app->addError('admin.postcarrier.template.data.illegalaccess', 'admin');

            // メルマガテンプレート一覧へリダイレクト
            return $app->redirect($app->url('admin_postcarrier_template'));
        }

        // パラメータ$idにマッチするデータが存在するか判定
        // あれば、subject/bodyを取得
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->previewTemplate($isError, $id);
        if ($isError) {
            // データが存在しない場合はメルマガテンプレート一覧へリダイレクト
            $app->addError('admin.postcarrier.template.data.notfound', 'admin');

            return $app->redirect($app->url('admin_postcarrier_template'));
        }

        $body = $result['body'];
        $bgcolor = '#ffffff';

        // bodyタグからbgcolorを取得する。
        if (preg_match('{<body\s.*?bgcolor=("|\')(.+?)\\1}i', $body, $matches)) {
            $bgcolor = $matches[2];
        }
        // bodyタグはdivタグに変換
        $body = preg_replace('{<(|/)body(?:|\s[^>]*)>}i', '<${1}div>', $body);

        // プレビューページ表示
        return $app->render('PostCarrier/Resource/template/admin/preview.twig', array(
                'subject' => $result['subject'],
                'previewbody' => $body,
                'bodybgcolor' => $bgcolor,
                'menu' => 'postcarrier_template',
                'return_url' => $app->url('admin_postcarrier_template'),
        ));
    }

    /**
     * メルマガテンプレートを論理削除
     * @param Application $app
     * @param Request $request
     * @param unknown $id
     */
    public function delete(Application $app, Request $request, $id)
    {
        // POSTかどうか判定
        // パラメータ$idにマッチするデータが存在するか判定
        // POSTかつ$idに対応するdtb_postcarrier_templateのレコードがあれば、del_flg = 1に設定して更新
        if ('POST' === $request->getMethod()) {
            // idがからの場合はメルマガテンプレート一覧へリダイレクト
            if(is_null($id) || strlen($id) == 0) {
                $app->addError('admin.postcarrier.template.data.illegalaccess', 'admin');

                return $app->redirect($app->url('admin_postcarrier_template'));
            }

            // メルマガテンプレートを削除する
            $app['eccube.plugin.postcarrier.service.postcarrier_request']->deleteTemplate($isError, $id);
        }

        // メルマガテンプレート一覧へリダイレクト
        return $app->redirect($app->url('admin_postcarrier_template'));
    }

    /**
     * テンプレート編集画面表示
     * @param Application $app
     * @param Request $request
     * @param unknown $id
     */
    public function edit(Application $app, Request $request, $id) {

        // POST以外はエラーにする
        if ('POST' !== $request->getMethod()) {
            throw new BadRequestHttpException();
        }

        if(is_null($id) || strlen($id) == 0) {
            $app->addError('admin.postcarrier.template.data.illegalaccess', 'admin');

            return $app->redirect($app->url('admin_postcarrier_template'));
        }

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getTemplate($isError, $id);

        if(is_null($result)) {
            $app->addError('admin.postcarrier.template.data.notfound', 'admin');

            return $app->redirect($app->url('admin_postcarrier_template'));
        }

        $BaseInfo = $app['eccube.repository.base_info']->get();
        $result = $this->extractTemplate($result, $BaseInfo->getEmail03()); // XXX ポストキャリア設定情報を渡す

        $result['id'] = $id; // 既存テンプレートの編集
        $form = $app['form.factory']
            ->createBuilder('postcarrier_template_edit', $result)
            ->getForm();

        return $app->render('PostCarrier/Resource/template/admin/template_edit.twig', array(
                'form' => $form->createView()
        ));

    }

    /**
     * テンプレート編集確定処理
     * @param Application $app
     * @param Request $request
     * @param unknown $id
     */
    public function commit(Application $app, Request $request) {

        // Formを取得
        $builder = $app['form.factory']->createBuilder('postcarrier_template_edit');
        $form = $builder->getForm();
        $form->handleRequest($request);
        $data = $form->getData();

        if ('POST' === $request->getMethod()) {
            if (!$form->isValid()) {
                return $app->render('PostCarrier/Resource/template/admin/template_edit.twig', array(
                        'form' => $form->createView()
                ));
            }

            // 既存テンプレート編集
            if ($data['id']) $data['template_id'] = $data['id'];

            $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->saveTemplate($isError, $data);
            if ($isError) {
                $app->addSuccess('admin.postcarrier.template.save.failure', 'admin');
                return $app->render('PostCarrier/Resource/template/admin/template_edit.twig', array(
                        'form' => $form->createView()
                ));
            } else {
                $app->addSuccess('admin.postcarrier.template.save.complete', 'admin');
            }
        }

        // メルマガテンプレート一覧へリダイレクト
        return $app->redirect($app->url('admin_postcarrier_template'));

    }

    /**
     * メルマガテンプレート登録画面を表示する
     * @param Application $app
     * @param Request $request
     */
    public function regist(Application $app, Request $request) {
        // formの作成
        $form = $app['form.factory']
            ->createBuilder('postcarrier_template_edit')
            ->getForm();


        // デフォルトデータを与える
        $BaseInfo = $app['eccube.repository.base_info']->get();
        $form->setData(array(
            'mail_method' => 2,
            'sendFor' => 'PC',
            'fromAddr' => $BaseInfo->getEmail03(),
        ));

        return $app->render('PostCarrier/Resource/template/admin/template_edit.twig', array(
                'form' => $form->createView()
        ));

    }

    /**
     * テンプレートコピー編集画面表示
     * @param Application $app
     * @param Request $request
     * @param unknown $id
     */
    public function copy(Application $app, Request $request, $id) {

        // POST以外はエラーにする
        if ('POST' !== $request->getMethod()) {
            throw new BadRequestHttpException();
        }
        // id の存在確認
        // nullであれば一覧に戻る
        if(is_null($id) || strlen($id) == 0) {
            $app->addError('admin.postcarrier.template.data.illegalaccess', 'admin');

            // メルマガテンプレート一覧へリダイレクト
            return $app->redirect($app->url('admin_postcarrier_template'));
        }

        // 選択したメルマガテンプレートを検索
        // 存在しなければメッセージを表示
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getTemplate($isError, $id);

        if(is_null($result)) {
            // データが存在しない場合はメルマガテンプレート一覧へリダイレクト
            $app->addError('admin.postcarrier.template.data.notfound', 'admin');

            return $app->redirect($app->url('admin_postcarrier_template'));
        }

        // formの作成
        $form = $app['form.factory']
            ->createBuilder('postcarrier_template_edit', $result)
            ->getForm();

        return $app->render('PostCarrier/Resource/template/admin/template_edit.twig', array(
                'form' => $form->createView()
        ));

    }

    /**
     * テンプレートコピー編集画面表示
     * @param Application $app
     * @param Request $request
     * @param unknown $id
     */
    public function copyHistory(Application $app, Request $request, $id) {
        // formの作成
        $form = $app['form.factory']
            ->createBuilder('postcarrier_template_edit')
            ->getForm();


        // 履歴からデータ取得
        $BaseInfo = $app['eccube.repository.base_info']->get();

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getDelivery($id);
        $data = $this->extractTemplate($result, $BaseInfo->getEmail03()); // XXX ポストキャリア設定情報を渡す
        $form->setData($data);

        return $app->render('PostCarrier/Resource/template/admin/template_edit.twig', array(
                'form' => $form->createView()
        ));
    }

    //function extractTemplate($result, $postCarrier) {
    static function extractTemplate($result, $fromAddr) {
        $data = array();

        $data['subject'] = $result['subject'];
        $data['fromDisp'] = $result['fromDisp'];
        $data['fromAddr'] = $result['fromAddr'];
        if (empty($data['fromAddr'])) {
            // デフォルト値を設定する
            $data['fromAddr'] = $fromAddr;
        }
        $data['body'] = $result['message'][0]['body'];
        $tmpType = $result['message'][0]['type'];
        if($tmpType=="text"){
            $data['mail_method'] = 2;
        }else{
            $data['mail_method'] = 1;
        }
        if ($result['sendFor'] == "PCSP") {
            $memo_data = unserialize($result['memo']);
            if ($memo_data['templSendFor'] == "PC" || $memo_data['templSendFor'] == "MOBILE") {
                $data['sendFor'] = $memo_data['templSendFor'];
            } else {
                $data['sendFor'] = "PC";
            }
        } else {
            $data['sendFor'] = $result['sendFor'];
        }
        $data['replytoDisp'] = $result['replytoDisp'];
        $data['replytoAddr'] = $result['replytoAddr'];

        if (array_key_exists(1, $result['message']))
            $data['sub_body'] = $result['message'][1]['body'];

        if(array_key_exists('link', $result['message'][0]) && $result['message'][0]['link'] != null){
            $linkPats = array();
            $linkUrls = array();
            foreach( $result['message'][0]['link'] as $key=>$val ){
                $linkPats[] = '${リンク#'.$key.'}';
                $linkUrls[] = $val['url'];
            }
            // リンク抽出状態から復元する。
            $data['body'] = str_replace($linkPats, $linkUrls, $data['body']);
        }

        if (array_key_exists('name', $result))
            $data['adm_name'] = $result['name'];
        if (array_key_exists('note', $result))
            $data['adm_note'] = $result['note'];

        if (array_key_exists('re_edit', $result))
            $data['re_edit'] = $result['re_edit'];

        return $data;
    }
}
