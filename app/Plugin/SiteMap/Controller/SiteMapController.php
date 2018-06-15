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

namespace Plugin\SiteMap\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteMapController
{
    public function xml(Application $app)
    {        
        $pages = $app['eccube.repository.page_layout']->findAll();

        $categories = $app['eccube.repository.category']->findAll();
        
        $details = $app['eccube.repository.product']->findBy(array('Status' => 1));
        
        $Parameters = $app['eccube.sitemap.repository.config']->findAll();
        $changefreq = $Parameters[0]->getChangefreq();
        $priority = $Parameters[0]->getPriority();
        
        $Items = array();
        foreach ($pages as $page) {
            if(strpos($page->getMetaRobots(),'noindex')!==false)continue;
            if ($page->getUrl() == 'product_list') {
                foreach ($categories as $category) {
                    $Item = array();
                    $Item['loc'] = $app->url($page->getUrl()) . "?category_id=" . $category->getId();
                    $Item['lastmod'] = $this->dateToString($category->getUpdateDate());
                    $Items[] = $Item;
                }
            }
            elseif ($page->getUrl() == 'product_detail') {
                foreach ($details as $detail) {
                    $Item = array();
                    $Item['loc'] = $app->url($page->getUrl(), array('id' => $detail->getId()));
                    $Item['lastmod'] = $this->dateToString($detail->getUpdateDate());
                    $Items[] = $Item;
                }
            }
            elseif ($page->getUrl() == 'entry_activate') ;
            elseif ($page->getUrl() == 'preview') ;
            elseif ($page->getEditFlg() === 0) {
                $Item = array();
                $Item['loc'] = $app->url($app['config']['user_data_route'], array('route' => $page->getUrl()));
                $Item['lastmod'] = $this->dateToString($page->getUpdateDate());
                $Items[] = $Item;
            }
            else {
                $Item = array();
                $Item['loc'] = $app->url($page->getUrl());
                $Item['lastmod'] = $this->dateToString($page->getUpdateDate());
                $Items[] = $Item;
            }
        }
        
        $xml = $app->renderView(
            'SiteMap/Resource/template/sitemap.twig',
            array(
                'changefreq' => $changefreq,
                'priority' => $priority,
                'Items' => $Items,
            )
        );
        
        //xmlファイル作成用
        $fp = fopen($app['config']['root_dir'] . "/html/sitemap.xml", "w");
        fwrite($fp, $xml . "\n");
        fclose($fp);

        $response = new Response();
        $response->setContent($xml);
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Content-type','application/xml; charset=utf-8');
        return $response;
    }

    private function dateToString($date)
    {
        return date_format($date, 'Y-m-d\TH:i:s+09:00');
    }

}
