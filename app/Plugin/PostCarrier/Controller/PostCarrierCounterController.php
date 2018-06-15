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

class PostCarrierCounterController
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

        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getSendCounter($isError, $item_count, 0);
        $result = $app['eccube.plugin.postcarrier.service.postcarrier_request']->getSendCounter($isError, $dummy, $page_count, $offset);
        if ($isError) {
            $app->addError('admin.postcarrier.request.failed', 'admin');
            $item_count = 0;
            $result = array();
        } else {
            $data = $result;
        }

        $pagination = $app['paginator']()->paginate(array(), $page_no, $page_count);
        $pagination->setItems($result);
        $pagination->setTotalItemCount($item_count);

        $pageMaxis = $app['eccube.repository.master.page_max']->findAll();

        return $app->render('PostCarrier/Resource/template/admin/counter.twig', array(
                'pagination' => $pagination,
                'page_no' => $page_no,
                'pageMaxis' => $pageMaxis,
                'page_count' => $page_count,
        ));
    }
}
