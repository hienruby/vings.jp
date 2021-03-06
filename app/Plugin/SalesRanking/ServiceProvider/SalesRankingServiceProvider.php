<?php
/*
* Plugin Name : SalesRanking
*
* Copyright (C) 2015 BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\SalesRanking\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class SalesRankingServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {
        //Routing
        $app->match('/block/sales_ranking', '\Plugin\\SalesRanking\Controller\SalesRankingController::index')->bind('block_sales_ranking');
        $app->match('/' . $app["config"]["admin_route"] . '/plugin/SalesRanking/config', '\Plugin\SalesRanking\Controller\Admin\\ConfigController::index')->bind('plugin_SalesRanking_config');
        
        // Form/Type
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use($app) {
            $types[] = new \Plugin\SalesRanking\Form\Type\Admin\ConfigType($app);
            return $types;
        }));
        
        // Repositoy
        $app['eccube.salesranking.repository.config'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\SalesRanking\Entity\Config');
        });
        
        // locale message
        $app['translator'] = $app->share($app->extend('translator', function ($translator, \Silex\Application $app) {
            $translator->addLoader('yaml', new \Symfony\Component\Translation\Loader\YamlFileLoader());

            $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
            if (file_exists($file)) {
                $translator->addResource('yaml', $file, $app['locale']);
            }

            return $translator;
        }));
    }

    public function boot(BaseApplication $app)
    {
    }
}
