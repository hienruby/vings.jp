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

namespace Plugin\SiteMap\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class SiteMapServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {
        // Routingを追加
        $admin = $app['config']['admin_route'];
        $app->match($admin . '/sitemap',
          '\Plugin\SiteMap\Controller\Admin\ConfigController::xml'
        )->bind('admin_sitemap');

        $app->match('/sitemap',
          '\Plugin\SiteMap\Controller\SiteMapController::xml'
        )->bind('sitemap');

        $app->match($admin . '/sitemap/view',
          '\Plugin\SiteMap\Controller\Admin\ConfigController::view'
        )->bind('sitemap_view');

        $app->match($admin . '/sitemap/setting',
          '\Plugin\SiteMap\Controller\Admin\ConfigController::setting'
        )->bind('sitemap_setting');

        $app->match($admin . '/sitemap/setting/change',
          '\Plugin\SiteMap\Controller\Admin\ConfigController::change'
        )->bind('sitemap_change');


        // Formの定義
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
            $types[] = new \Plugin\SiteMap\Form\Type\ConfigType();

            return $types;
        }));

        // Repositoy
        $app['eccube.sitemap.repository.config'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\SiteMap\Entity\Config');
        });

        // サブナビの拡張
        $app['config'] = $app->share($app->extend('config', function ($config) {
            $nav = array(
                'id' => 'admin_sitemap',
                'name' => 'サイトマップ',
                'has_child' => 'true',
                'icon' => 'cb-chart',
                'child' => array(
                    array(
                        'id' => 'admin_sitemap_view',
                        'url' => 'sitemap_view',
                        'name' => 'サイト閲覧',
                    ),
                    array(
                        'id' => 'admin_sitemap_setting',
                        'url' => 'sitemap_setting',
                        'name' => '設定',
                    )
                ),
            );

            $config['nav'][] = $nav;

            return $config;
        }));
    }

    public function boot(BaseApplication $app)
    {
    }
}
