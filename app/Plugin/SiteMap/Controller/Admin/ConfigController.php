<?php
/*
* Plugin Name : SiteMap
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\SiteMap\Controller\Admin;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;

class ConfigController
{
    public function view(Application $app)
    {
        $pages = $app['eccube.repository.page_layout']->findAll();

        $categories = $app['eccube.repository.category']->findAll();
        
        $details = $app['eccube.repository.product']->findBy(array('Status' => 1));

        $arr = array();
        foreach ($pages as $page) {
            if(strpos($page->getMetaRobots(),'noindex')!==false)continue;
            if ($page->getUrl() != 'entry_activate' && $page->getUrl() != 'preview') {
                array_push($arr, $page);
            }
        }

        return $app->render(
            'SiteMap/Resource/template/view.twig',
            array(
                'data' => $arr,
                'categories' => $categories,
                'details' => $details,
            )
        );
    }

    public function setting(Application $app, Request $request, $changeFlg = 'setting')
    {
        $Parameters = $app['eccube.sitemap.repository.config']->findAll();
        $parameter = array(
            'changefreq' => $Parameters[0]->getChangefreq(),
            'priority'   => $Parameters[0]->getPriority()
        );

        $builder = $app['form.factory']
            ->createBuilder('sitemap_setting', $parameter);
        $form = $builder->getForm();
        $form->handleRequest($request);

        //admin/sitemap/setting/change
        if ($changeFlg == 'change' && $form->isValid()) {
            $parameter = $request->request->get('sitemap_setting');
            //table update
            $table = $app['eccube.sitemap.repository.config']->find(1);
            $table->setChangefreq($parameter['changefreq']);
            $table->setPriority($parameter['priority']);
            $app['orm.em']->flush();
        }

        return $app->render(
            'SiteMap/Resource/template/' . $changeFlg . '.twig',
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
