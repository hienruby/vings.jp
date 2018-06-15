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

namespace Plugin\ProductOption\Form\Extension;

use Eccube\Common\Constant;
use Eccube\Form\DataTransformer;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

class OrderExtention extends AbstractTypeExtension
{

    public $app;

    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $app = $this->app;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($app) {
            $BaseInfo = $app['eccube.repository.base_info']->get();

            $data = $event->getData();
            $orderDetails = &$data['OrderDetails'];

            // 数量0フィルター
            $quantityFilter = function ($v) {
                return !(isset($v['quantity']) && preg_match('/^0+$/', trim($v['quantity'])));
            };

            if ($BaseInfo->getOptionMultipleShipping() == Constant::ENABLED) {

                $shippings = &$data['Shippings'];

                // 数量を抽出
                $getQuantity = function ($v) {
                    return (isset($v['quantity']) && preg_match('/^\d+$/', trim($v['quantity']))) ?
                        trim($v['quantity']) :
                        0;
                };

                foreach ($shippings as &$shipping) {
                    if (!empty($shipping['ShipmentItems'])) {
                        $shipping['ShipmentItems'] = array_filter($shipping['ShipmentItems'], $quantityFilter);
                    }
                }

                if (!empty($orderDetails)) {

                    foreach ($orderDetails as &$orderDetail) {

                        $orderDetail['quantity'] = 0;

                        // 受注詳細と同じ商品規格のみ抽出
                        $productClassFilter = function ($v) use ($orderDetail, $app) {
                            if($v['price'] = ($v['ProductClass'] === $orderDetail['ProductClass'])){
                                $options_a = json_decode($v['serial'],true);
                                $options_b = json_decode($orderDetail['serial'],true);
                                if($app['eccube.productoption.service.util']->compareOptions($options_a, $options_b)){
                                    return true;
                                }
                            }
                            return false;
                        };

                        foreach ($shippings as &$shipping) {

                            if (!empty($shipping['ShipmentItems'])) {

                                // 同じ商品規格の受注詳細の価格を適用
                                $applyPrice = function (&$v) use ($orderDetail, $app) {
                                    if($v['ProductClass'] === $orderDetail['ProductClass']){
                                        $options_a = json_decode($v['serial'],true);
                                        $options_b = json_decode($orderDetail['serial'],true);
                                        if($app['eccube.productoption.service.util']->compareOptions($options_a, $options_b)){
                                            $v['price'] = str_replace(',','',$orderDetail['price']);
                                        }
                                    }
                                };
                                array_walk($shipping['ShipmentItems'], $applyPrice);

                                // 数量適用
                                $relatedShipmentItems = array_filter($shipping['ShipmentItems'], $productClassFilter);
                                $quantities = array_map($getQuantity, $relatedShipmentItems);
                                $orderDetail['quantity'] += array_sum($quantities);
                            }
                        }
                    }
                }
            }

            if (!empty($orderDetails)) {
                $data['OrderDetails'] = array_filter($orderDetails, $quantityFilter);
            }

            $event->setData($data);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'order';
    }

}
