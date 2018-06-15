<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace Plugin\IntroduceDiscount\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception as HttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;

class AffiliateSettingsController
{

    private $main_title;

    private $sub_title;

    public function __construct()
    {}

    /**
     * 編集
     * @param Application $app
     * @param Request $request
     * @param unknown $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Application $app, Request $request, $id) {

        // IDから情報を取得する
        $afsetting = $app['eccube.plugin.introduce_discount.repository.affiliate_settings']->find(1);
        if (is_null($afsetting)) {
            echo "not";
            return;
        }

        //print_r($afsetting);exit(0);
        // formの作成
        $form = $app['form.factory']
            ->createBuilder('admin_affiliate')
            ->getForm();

        $form->get('id')->setData($afsetting->getId());
        $form->get('introduce_conversion_discount_rate')->setData($afsetting->getIntroduceConversionDiscountRate());
        $form->get('meet_conversion_discount_rate')->setData($afsetting->getMeetConversionDiscountRate());

        return $this->renderRegistView($app, array('form' => $form->createView()));
    }

    /**
    * 編集確定
    * @param Application $app
    * @param Request $request
    * @param unknown $id
    * @throws NotFoundHttpException
    * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    */
    public function commit(Application $app, Request $request, $id) {
        if (!'POST' === $request->getMethod()) {
            throw new HttpException();
        }

        $builder = $app['form.factory']->createBuilder('admin_affiliate', null);
        $form = $builder->getForm();
        $form->handleRequest($request);

        if (!$form->isValid()) {
            return $this->renderRegistView($app, array('form' => $form->createView()));
        }

        $data = $form->getData();

        // サービスの取得
        $service = $app['eccube.plugin.introduce_discount.service.affiliate_settings'];

        if(is_null($data['id'])) {
            $app->addError('admin.introduce_discount.notfound', 'admin');
        } else {
            // =============
            // 更新処理
            // =============
            $status = $service->update($data);
            if (!$status) {
                $app->addError('admin.introduce_discount.notfound', 'admin');
                return $app->redirect($app->url('admin_affiliate_edit'));
            }

        }

        // 成功時のメッセージを登録する
        $app->addSuccess('admin.plugin.introduce_discount.regist.success', 'admin');

        return $app->redirect($app->url('admin_affiliate_edit'));
    }

    /**
     * 編集画面用のrender
     * @param unknown $app
     * @param unknown $parameters
     */
    protected function renderRegistView($app, $parameters = array()) {

        return $app->render('IntroduceDiscount/View/admin/regist.twig', $parameters);
    }

}
