<?php

/*
 * This file is part of the ProductMeta
 *
 * Copyright (C) 2017 ONE HAND RED
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ProductMeta\ServiceProvider;

use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;

class ProductMetaServiceProvider implements ServiceProviderInterface
{

    public function register(BaseApplication $app)
    {
        // Event
        $app['productmeta.event.adminproduct'] = $app->share(function () use ($app) {
            return new \Plugin\ProductMeta\Event\AdminProductEvent($app);
        });
        $app['productmeta.event.frontproduct'] = $app->share(function () use ($app) {
            return new \Plugin\ProductMeta\Event\FrontProductEvent($app);
        });

        // FormExtension
        $app['form.type.extensions'] = $app->share($app->extend('form.type.extensions', function ($extensions) use ($app) {
            $extensions[] = new \Plugin\ProductMeta\Form\Extension\Admin\ProductTypeExtension($app);
            return $extensions;
        }));

        // Repository
        $app['productmeta.repository.productmeta'] = $app->share(function () use ($app) {
            return $app['orm.em']->getRepository('Plugin\ProductMeta\Entity\ProductMeta');
        });
    }

    public function boot(BaseApplication $app)
    {
    }
}