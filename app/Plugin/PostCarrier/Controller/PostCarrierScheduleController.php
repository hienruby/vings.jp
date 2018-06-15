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

class PostCarrierScheduleController
{
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

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getScheduler($isError, 'SCHEDULE', $item_count, $page_count, $offset);
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

        return $app->render('PostCarrier/Resource/template/admin/schedule_list.twig', array(
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
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getTemplate($isError, $id);
        if(is_null($result)) {
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
                'menu' => 'postcarrier_schedule',
                'return_url' => $app->url('admin_postcarrier_schedule'),
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
        if ('POST' === $request->getMethod()) {
            // idがからの場合はメルマガテンプレート一覧へリダイレクト
            if(is_null($id) || strlen($id) == 0) {
                $app->addError('admin.postcarrier.template.data.illegalaccess', 'admin');

                return $app->redirect($app->url('admin_postcarrier_stepmail'));
            }

            // メルマガテンプレートを削除する
            $app['eccube.plugin.postcarrier.service.postcarrier_request']->schedulerDelete($id);
        }

        $from = $request->get('from');
        if ($from == 'step') {
            return $app->redirect($app->url('admin_postcarrier_stepmail'));
        } else {
            return $app->redirect($app->url('admin_postcarrier_schedule'));
        }
    }

    public function pause(Application $app, Request $request, $id) {

        $app['eccube.plugin.postcarrier.service.postcarrier_request']->schedulerPause($id);

        return $app->redirect($app->url('admin_postcarrier_stepmail'));
    }

    public function resume(Application $app, Request $request, $id) {

        $app['eccube.plugin.postcarrier.service.postcarrier_request']->schedulerResume($id);

        return $app->redirect($app->url('admin_postcarrier_stepmail'));
    }


    public function copy(Application $app, Request $request, $id) {

        $app['eccube.plugin.postcarrier.service.postcarrier_request']->schedulerCopy($isError, $id);

        return $app->redirect($app->url('admin_postcarrier_stepmail'));
    }

    public function run(Application $app, Request $request, $id) {

        $app['eccube.plugin.postcarrier.service.postcarrier_request']->schedulerExecute($id);

        return $app->redirect($app->url('admin_postcarrier_history'));
    }
}
