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


class BlockCart extends AbstractWorkPlace
{
    public function createTwig(TemplateEvent $event)
    {
        $app = $this->app;
        $parameters = $event->getParameters();

        $CartOption = $app['eccube.productoption.service.cart']->getCartOption();

        $source = $event->getSource();

        if(preg_match('/\{%\s*for\s*CartItem\s*in\s*Cart.CartItems\s*%\}/',$source, $result)){
            $search = $result[0];
            $snipet = '{% for key, CartItem in Cart.CartItems %}';
            $replace = $snipet;
            $source = str_replace($search, $replace, $source);
        }

        if(preg_match('/<.* class\=\"item_price\"/',$source, $result)){
            $search = $result[0];
            $snipet = file_get_contents($app['config']['plugin_realdir']. '/ProductOption/Resource/template/default/Block/cart_option.twig');
            $replace = $snipet.$search;
            $source = str_replace($search, $replace, $source);
        }

        $event->setSource($source);
        $parameters['CartOptions'] = $CartOption->getCartOptions();
        $event->setParameters($parameters);
    }
}
