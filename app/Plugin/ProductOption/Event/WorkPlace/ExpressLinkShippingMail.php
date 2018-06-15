<?php
/*
 * Plugin Name : ProductOption
 *
 * Copyright (C) 2015 BraTech Co., Ltd. All Rights Reserved.
 * http://www.bratech.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ProductOption\Event\WorkPlace;

use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


class ExpressLinkShippingMail extends AbstractWorkPlace
{
    public function createTwig(TemplateEvent $event)
    {
        $app = $this->app;
        $parameters = $event->getParameters();

        $Order = $parameters['Order'];

        $body = $parameters['body'];

        // 受注詳細
        $detail_check = $app['eccube.productoption.service.util']->replaceMailDetail($body);
        // お届け先商品
        $shipment_check = $app['eccube.productoption.service.util']->replaceMailShipmentItem($body);

        if(!$detail_check && !$shipment_check){
            $orderDetails = $Order->getOrderDetails();
            $plgOrderDetails = $app['eccube.productoption.service.util']->getPlgOrderDetails($orderDetails);

            $Shippings = $Order->getShippings();
            $plgShipmentItems = $app['eccube.productoption.service.util']->getPlgShipmentItems($Shippings);

            $body = $app->renderView('Mail/shipping.twig', array(
                'header' => $form['header']->vars['value'],
                'footer' => $form['footer']->vars['value'],
                'Order' => $Order,
                'plgOrderDetails' => $plgOrderDetails,
                'plgShipmentItems' => $plgShipmentItems,
            ));
        }

        $parameters['body'] = $body;

        $event->setParameters($parameters);
    }

    public function execute(EventArgs $event)
    {
        $app = $this->app;

        $MailTemplate = $event['MailTemplate'];
        $Order = $event['Order'];
        $message = $event['message'];

        $body = $message->getBody();

        // 受注詳細
        $detail_check = $app['eccube.productoption.service.util']->replaceMailDetail($body);
        // お届け先商品
        $shipment_check = $app['eccube.productoption.service.util']->replaceMailShipmentItem($body);

        if(!$detail_check && !$shipment_check){
            $orderDetails = $Order->getOrderDetails();
            $plgOrderDetails = $app['eccube.productoption.service.util']->getPlgOrderDetails($orderDetails);

            $Shippings = $Order->getShippings();
            $plgShipmentItems = $app['eccube.productoption.service.util']->getPlgShipmentItems($Shippings);

            $body = $app->renderView('Mail/order.twig', array(
                'header' => $MailTemplate->getHeader(),
                'footer' => $MailTemplate->getFooter(),
                'Order' => $Order,
                'plgOrderDetails' => $plgOrderDetails,
                'plgShipmentItems' => $plgShipmentItems,
            ));
        }

        $message->setBody($body);

        $event['message'] = $message;
    }
}
