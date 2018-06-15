<?php

/*
 * This file is part of the ProductMeta
 *
 * Copyright (C) 2017 ONE HAND RED
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ProductMeta\Event;

use Eccube\Application;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;
use Plugin\ProductMeta\Entity\ProductMeta;

class AdminProductEvent
{

    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function onAdminProductEditComplete(EventArgs $event)
    {
        $Product = $event->getArgument('Product');
        $form = $event->getArgument('form');

        $ProductMeta = $this->app['productmeta.repository.productmeta']->find($Product->getId());
        if (is_null($ProductMeta)) {
            $ProductMeta = new ProductMeta();
            $ProductMeta->setId($Product->getId());
        }
        $ProductMeta->setAuthor($form['author']->getData());
        $ProductMeta->setDescription($form['description']->getData());
        $ProductMeta->setKeyword($form['keyword']->getData());
        $ProductMeta->setMetaRobots($form['meta_robots']->getData());
        $ProductMeta->setMetaTags($form['meta_tags']->getData());
        $this->app['orm.em']->persist($ProductMeta);
        $this->app['orm.em']->flush($ProductMeta);
    }

    public function onAdminProductCopyComplete(EventArgs $event)
    {
        $Product = $event->getArgument('Product');

        $CopyProductMeta = $this->app['productmeta.repository.productmeta']->find($Product->getId());
        if (is_null($CopyProductMeta)) {
            // Do nothing
        } else {
            // 複製後の商品IDを取得
            $CopyProduct = $event->getArgument('CopyProduct');
            $ProductMeta = clone $CopyProductMeta;
            $ProductMeta->setId($CopyProduct->getId());
            $this->app['orm.em']->persist($ProductMeta);
            $this->app['orm.em']->flush($ProductMeta);
        }
    }

    public function onAdminProductDeleteComplete(EventArgs $event)
    {
        $Product = $event->getArgument('Product');

        $ProductMeta = $this->app['productmeta.repository.productmeta']->find($Product->getId());
        if (is_null($ProductMeta)) {
            //　Do nothing
        } else {
            $this->app['orm.em']->remove($ProductMeta);
            $this->app['orm.em']->flush();
        }
    }

    public function onAdminProductProductRender(TemplateEvent $event)
    {
        $parameters = $event->getParameters();

        $snipet = file_get_contents(__DIR__ . '/../Resource/template/admin/Product/productmeta.twig');
        $search = '<div id="detail_box__footer" class="row hidden-xs hidden-sm">';
        $replace = $snipet . $search;
        $source = str_replace($search, $replace, $event->getSource());

        $event->setSource($source);
    }
}