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

namespace Plugin\Shiro8FreeShippingDisplay3;

use Eccube\Event\EventArgs;
use Symfony\Component\DomCrawler\Crawler;
use Eccube\Event\TemplateEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Component\Filesystem\Filesystem;
use Eccube\Util\Str;

class Shiro8FreeShippingDisplay3Event
{
    /**
     * @var \Eccube\Application
     */
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }
    
    //フロント-注文確認画面画面
    public function onRenderShoppingBefore(FilterResponseEvent $event)
    {
        $app = $this->app;

        $request = $event->getRequest();
        $response = $event->getResponse();
        
        //カートの取得
        $Cart = $app['eccube.service.cart']->getCart();
        $BaseInfo = $app['eccube.repository.base_info']->get();

        $isDeliveryFree = false;
        $least = 0;
        $quantity = 0;
        if ($BaseInfo->getDeliveryFreeAmount()) {
            if ($BaseInfo->getDeliveryFreeAmount() <= $Cart->getTotalPrice()) {
                // 送料無料（金額）を超えている
                $isDeliveryFree = true;
            } else {
                $least = $BaseInfo->getDeliveryFreeAmount() - $Cart->getTotalPrice();
            }
        }

        if ($BaseInfo->getDeliveryFreeQuantity()) {
            if ($BaseInfo->getDeliveryFreeQuantity() <= $Cart->getTotalQuantity()) {
                // 送料無料（個数）を超えている
                $isDeliveryFree = true;
            } else {
                $quantity = $BaseInfo->getDeliveryFreeQuantity() - $Cart->getTotalQuantity();
            }
        }
        
        $html = $response->getContent();
        
        $twig = $app->renderView(
            'Shiro8FreeShippingDisplay3/Resource/template/plg_shiro8_free_shipping.twig',
            array(
                'Cart' => $Cart,
                'least' => $least,
                'quantity' => $quantity,
                'is_delivery_free' => $isDeliveryFree,
            )
        );

        $search = '/<form id="shopping-form" method="post" /s';
        $newHtml = $twig . '<form id="shopping-form" method="post" ';
        
        $html = preg_replace($search, $newHtml, $html);

        $response->setContent($html);
        $event->setResponse($response);
    }
}
