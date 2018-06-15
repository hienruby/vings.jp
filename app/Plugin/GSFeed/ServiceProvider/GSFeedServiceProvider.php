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


namespace Plugin\GSFeed\ServiceProvider;

use Eccube\Application;
use Eccube\Common\Constant;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class GSFeedServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {
        // Routingを追加
        $admin = $app['controllers_factory'];
        $front = $app['controllers_factory'];
        // 強制SSL
        if ($app['config']['force_ssl'] == Constant::ENABLED) {
            $admin->requireHttps();
            $front->requireHttps();
        }

        $front->match('/gsfeed',
          '\Plugin\GSFeed\Controller\GSFeedController::xml'
        )->bind('gsfeed');

        $admin->match('/gsfeed/setting',
          '\Plugin\GSFeed\Controller\Admin\ConfigController::setting'
        )->bind('gsfeed_setting');

        $admin->match('/gsfeed/setting/change',
          '\Plugin\GSFeed\Controller\Admin\ConfigController::change'
        )->bind('gsfeed_change');

        $app->mount('/'.trim($app['config']['admin_route'], '/').'/', $admin);
        $app->mount('', $front);

        // Formの定義
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
            $types[] = new \Plugin\GSFeed\Form\Type\ConfigType();

            return $types;
        }));

        // Repositoy
        $app['eccube.gsfeed.repository.config'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\GSFeed\Entity\Config');
        });

        // サブナビの拡張
        $app['config'] = $app->share($app->extend('config', function ($config) {
            $nav = array(
                'id' => 'admin_gsfeed',
                'name' => 'Googleショッピングフィード生成',
                'has_child' => 'true',
                'icon' => 'cb-chart',
                'child' => array(
                    array(
                        'id' => 'gsfeed_setting',
                        'url' => 'gsfeed_setting',
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
