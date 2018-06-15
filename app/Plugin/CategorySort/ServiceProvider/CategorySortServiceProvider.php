<?php

/*
 * This file is part of the CategorySort
 *
 * Copyright (C) 2017 CategorySort
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CategorySort\ServiceProvider;

use Eccube\Application;
use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Plugin\CategorySort\Form\Type\CategorySortConfigType;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

class CategorySortServiceProvider implements ServiceProviderInterface
{

    public function register(BaseApplication $app)
    {
        // プラグイン用設定画面
        $app->match('/'.$app['config']['admin_route'].'/plugin/CategorySort/config', 'Plugin\CategorySort\Controller\ConfigController::index')->bind('plugin_CategorySort_config');

        // 独自コントローラ
        $app->match('/'.$app['config']['admin_route'].'/plugin/CategorySort/sort', 'Plugin\CategorySort\Controller\CategorySortController::index')->bind('plugin_CategorySort_admin_sort');

        $app->post('/'.$app['config']['admin_route'].'/plugin/CategorySort/save', 'Plugin\CategorySort\Controller\CategorySortController::save')->bind('plugin_CategorySort_admin_save');

        // Form
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {
            $types[] = new CategorySortConfigType();

            return $types;
        }));

        // Repository

        // Service

        // メッセージ登録
        // $file = __DIR__ . '/../Resource/locale/message.' . $app['locale'] . '.yml';
        // $app['translator']->addResource('yaml', $file, $app['locale']);

        // load config
        // プラグイン独自の定数はconfig.ymlの「const」パラメータに対して定義し、$app['[lower_code]config']['定数名']で利用可能
        // if (isset($app['config']['CategorySort']['const'])) {
        //     $config = $app['config'];
        //     $app['[lower_code]config'] = $app->share(function () use ($config) {
        //         return $config['CategorySort']['const'];
        //     });
        // }

        // ログファイル設定
        $app['monolog.logger.[lower_code]'] = $app->share(function ($app) {

            $logger = new $app['monolog.logger.class']('[lower_code]');

            $filename = $app['config']['root_dir'].'/app/log/[lower_code].log';
            $RotateHandler = new RotatingFileHandler($filename, $app['config']['log']['max_files'], Logger::INFO);
            $RotateHandler->setFilenameFormat(
                '[lower_code]_{date}',
                'Y-m-d'
            );

            $logger->pushHandler(
                new FingersCrossedHandler(
                    $RotateHandler,
                    new ErrorLevelActivationStrategy(Logger::ERROR),
                    0,
                    true,
                    true,
                    Logger::INFO
                )
            );

            return $logger;
        });


        // メニュー

        $app['config'] = $app->share($app->extend('config', function ($config) {
            $nav = $config['nav'];
            foreach ($nav as $key => $val) {
                if ("product" == $val['id']) {
                    $childNavi['id'] = "plugin_CategorySort_admin_sort";
                    $childNavi['name'] = "カテゴリー並び替え";
                    $childNavi['url'] = "plugin_CategorySort_admin_sort";
                    $nav[$key]['child'][] = $childNavi;
                    continue;
                }
            }
            $config['nav'] = $nav;

            return $config;
        }));


    }

    public function boot(BaseApplication $app)
    {
    }

}
