<?php
/**
 * This file is part of the ImgExpansion
 *
 * Copyright (C) 2016 IDS Corporation
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ImgExpansion\ServiceProvider;

// use Eccube\Application;
use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;
use Plugin\ImgExpansion\PluginManager;

class ImgExpansionServiceProvider implements ServiceProviderInterface
{

    public function register(BaseApplication $app)
    {
        $plgCode = PluginManager::PLUGIN_CODE;

        // ログファイル設定
        $app['monolog.' . $plgCode] = $app->share(function ($app) {
            $plgCode = PluginManager::PLUGIN_CODE;

            $logger = new $app['monolog.logger.class']('plugin.' . $plgCode);

            $file = $app['config']['root_dir'] . '/app/log/' . $plgCode . '.log';
            $RotateHandler = new RotatingFileHandler($file, $app['config']['log']['max_files'], Logger::INFO);
            $RotateHandler->setFilenameFormat(
                $plgCode . '_{date}',
                'Y-m-d'
            );

            $logger->pushHandler(
                new FingersCrossedHandler(
                    $RotateHandler,
                    new ErrorLevelActivationStrategy(Logger::INFO)
                )
            );

            return $logger;
        });
    }

    public function boot(BaseApplication $app)
    {
    }
}
