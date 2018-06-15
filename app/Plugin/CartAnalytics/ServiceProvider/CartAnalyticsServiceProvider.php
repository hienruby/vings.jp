<?php
/*
* This file is part of EC-CUBE
*
* Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
* http://www.lockon.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\CartAnalytics\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class CartAnalyticsServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {
        //Repository
        $app['cart_analytics.repository.cart_analytics'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\CartAnalytics\Entity\CartAnalytics');
        });
        
        //Controller
        $app->match('/' . $app["config"]["admin_route"] . '/cart_analytics/list', '\Plugin\CartAnalytics\Controller\Admin\CartAnalyticsController::index')->bind('admin_cart_analytics_list');
        $app->match('/' . $app["config"]["admin_route"] . '/cart_analytics/report', '\Plugin\CartAnalytics\Controller\Admin\CartAnalyticsController::report')->bind('admin_cart_analytics_report');
        $app->match('/' . $app["config"]["admin_route"] . '/cart_analytics/recover', '\Plugin\CartAnalytics\Controller\Admin\CartAnalyticsController::recover')->bind('admin_cart_analytics_recover');
        
        //Form
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
            $types[] = new \Plugin\CartAnalytics\Form\Type\Admin\SearchCartAnalyticsType($app);
            return $types;
        }));
        
        //メッセージ
        $app['translator'] = $app->share($app->extend('translator', function ($translator, \Silex\Application $app) {
            $translator->addLoader('yaml', new \Symfony\Component\Translation\Loader\YamlFileLoader());

            $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
            if (file_exists($file)) {
                $translator->addResource('yaml', $file, $app['locale']);
            }

            return $translator;
        }));
        
        //メニュー
        $app['config'] = $app->share($app->extend('config', function ($config) {
            $config['nav'][] = array(
                'name' => 'CartAnalytics',
                'id' => 'cart_analytics',
                'icon' => 'cb-shopping-cart',
                'has_child' => true,
                'child' => array(
                    array('id' => 'cart_analytics_list', 'name' => 'カート離脱率', 'url' => 'admin_cart_analytics_list'),
                    array('id' => 'cart_analytics_report', 'name' => 'レポートダウンロード', 'url' => 'admin_cart_analytics_report'),
                    array('id' => 'cart_analytics_recover', 'name' => '離脱者へメール送信', 'url' => 'admin_cart_analytics_recover')
                ),
            );
            return $config; 
        }));
    }

    public function boot(BaseApplication $app)
    {
    }
}
