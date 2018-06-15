<?php

/*
 * This file is part of the ProductMeta
 *
 * Copyright (C) 2017 ONE HAND RED
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ProductMeta;

use Eccube\Application;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;

class ProductMetaEvent
{

    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function onAdminProductEditComplete(EventArgs $event)
    {
        $this->app['productmeta.event.adminproduct']->onAdminProductEditComplete($event);
    }

    public function onAdminProductCopyComplete(EventArgs $event)
    {
        $this->app['productmeta.event.adminproduct']->onAdminProductCopyComplete($event);
    }

    public function onAdminProductDeleteComplete(EventArgs $event)
    {
        $this->app['productmeta.event.adminproduct']->onAdminProductDeleteComplete($event);
    }

    public function onAdminProductProductRender(TemplateEvent $event)
    {
        $this->app['productmeta.event.adminproduct']->onAdminProductProductRender($event);
    }

    public function onFrontProductDetailInitialize(EventArgs $event)
    {
        $this->app['productmeta.event.frontproduct']->onFrontProductDetailInitialize($event);
    }
}