<?php
/*
 * This file is part of the SocialButton
 *
 * Copyright (C) 2016 Nekyo
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Plugin\SocialButton\ServiceProvider;

use Eccube\Application;
use Monolog\Handler\FingersCrossed\ErrorLevelActivationStrategy;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class SocialButtonServiceProvider implements ServiceProviderInterface
{
	public function register(BaseApplication $app)
	{
		// ログファイル設定
		$app['monolog.SocialButton'] = $app->share(function ($app) {

			$logger = new $app['monolog.logger.class']('plugin.SocialButton');

			$file = $app['config']['root_dir'] . '/app/log/SocialButton.log';
			$RotateHandler = new RotatingFileHandler($file, $app['config']['log']['max_files'], Logger::INFO);
			$RotateHandler->setFilenameFormat(
				'SocialButton_{date}',
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
