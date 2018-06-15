<?php
/*
* Plugin Name : GSFeed
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\GSFeed\Controller\Admin;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;

class ConfigController
{
    public function setting(Application $app, Request $request, $changeFlg = 'setting')
    {
        $Parameters = $app['eccube.gsfeed.repository.config']->findAll();
        $parameter = array(
            'brand'       => $Parameters[0]->getBrand(),
            'gcategory'   => $Parameters[0]->getGCategory()
        );

        $builder = $app['form.factory']
            ->createBuilder('gsfeed_setting', $parameter);
        $form = $builder->getForm();
        $form->handleRequest($request);

        //admin/gsfeed/setting/change
        if ($changeFlg == 'change' && $form->isValid()) {
            $parameter = $request->request->get('gsfeed_setting');
            //table update
            $table = $app['eccube.gsfeed.repository.config']->find(1);
            $table->setBrand($parameter['brand']);
            $table->setGCategory($parameter['gcategory']);
            $app['orm.em']->flush();
        }

        return $app->render(
            'GSFeed/Resource/template/' . $changeFlg . '.twig',
            array(
                'form' => $form->createView(),
                'data' => $parameter,
            )
        );

    }

    public function change(Application $app, Request $request)
    {
        return $this->setting($app, $request, 'change');
    }

}
