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
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Plugin\ProductMeta\Entity\ProductMeta;

class FrontProductEvent
{

    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function onFrontProductDetailInitialize(EventArgs $event)
    {
        /** ref /Application.php L:363-382 */
        // フロント画面
        $request = $event->getRequest();
        $route = $request->attributes->get('_route');
        $page = $route;
        // ユーザ作成画面
        if ($route === 'user_data') {
            $params = $request->attributes->get('_route_params');
            $route = $params['route'];
            // プレビュー画面
        } elseif ($request->get('preview')) {
            $route = 'preview';
        }

        try {
            $DeviceType = $this->app['eccube.repository.master.device_type']
                ->find(\Eccube\Entity\Master\DeviceType::DEVICE_TYPE_PC);
            $PageLayout = $this->app['eccube.repository.page_layout']->getByUrl($DeviceType, $route, $page);
        } catch (\Doctrine\ORM\NoResultException $e) {
            $PageLayout = $this->app['eccube.repository.page_layout']->newPageLayout($DeviceType);
        }
        /** ref /Application.php L:363-382 */

        $Product = $event->getArgument('Product');
        $ProductMeta = $this->app['productmeta.repository.productmeta']->find($Product->getId());
        if (is_null($ProductMeta)) {
            // Do nothing
        } else {
            if ($ProductMeta->getAuthor()) {
                $PageLayout->setAuthor($ProductMeta->getAuthor());
            }
            if ($ProductMeta->getDescription()) {
                $PageLayout->setDescription($ProductMeta->getDescription());
            }
            if ($ProductMeta->getKeyword()) {
                $PageLayout->setKeyword($ProductMeta->getKeyword());
            }
            if ($ProductMeta->getMetaRobots()) {
                $PageLayout->setMetaRobots($ProductMeta->getMetaRobots());
            }
            if ($ProductMeta->getMetaTags()) {
                $PageLayout->setMetaTags($ProductMeta->getMetaTags());
            }
            $this->app['twig']->addGlobal('PageLayout', $PageLayout);
        }
    }
}