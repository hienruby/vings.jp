<?php
/*
 * Copyright(c) 2016 SYSTEM_KD
 */

namespace Plugin\ClassNameDetail\ServiceProvider;

use Eccube\Application;
use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class ClassNameDetailServiceProvider implements ServiceProviderInterface
{
    public function register(BaseApplication $app)
    {

        // Service
        $app['classnamedetail.service.twigrenderservice'] = $app->share(function () use ($app) {
            return new \Plugin\ClassNameDetail\Service\TwigRenderService($app);
        });

		// Form
        $app['form.types'] = $app->share($app->extend('form.types', function ($types) use ($app) {

            return $types;
        }));
    }

    public function boot(BaseApplication $app)
    {
    }
}
