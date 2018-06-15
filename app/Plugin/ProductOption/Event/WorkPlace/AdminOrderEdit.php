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

use Eccube\Common\Constant;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Validator\Constraints as Assert;

class AdminOrderEdit extends AbstractWorkPlace
{
    public function createTwig(TemplateEvent $event)
    {
        $app = $this->app;
        $parameters = $event->getParameters();

        $Order = $parameters['Order'];

        $plgOrderDetails = array();
        $plgShipmentItems = array();

        $form = $parameters['form'];
        $formOrderDetails = $form['OrderDetails'];
        foreach($formOrderDetails as $detail_idx => $formOrderDetail){
            $Options = json_decode($formOrderDetail['serial']->vars['value'], true);
            $plgOrderDetails[$detail_idx] = $app['eccube.productoption.service.util']->getLabelFromOptions($Options);
        }

        $Shippings = $form['Shippings'];
        foreach($Shippings as $shipping_idx => $Shipping){
            if(count($Shipping['ShipmentItems']) > 0){
                foreach($Shipping['ShipmentItems'] as $item_idx => $formShipmentItem){
                    $Options = json_decode($formShipmentItem['serial']->vars['value'], true);
                    $plgShipmentItems[$shipping_idx][$item_idx] = $app['eccube.productoption.service.util']->getLabelFromOptions($Options);
                }
            }
        }

        $source = $event->getSource();

        if(preg_match('/\{%\s*for\s*orderDetailForm\s*in\s*form\.OrderDetails\s*%\}/',$source, $result)){
            $search = $result[0];
            $replace = '{% for detail_idx , orderDetailForm in form.OrderDetails %}';
            $source = str_replace($search, $replace, $source);
        }

        if(preg_match('/\{%\s*for\s*shippingForm\s*in\s*form\.Shippings\s*%\}/',$source, $result)){
            $search = $result[0];
            $replace = '{% set shipmentitem_idx = -1 %}{% for shipping_idx , shippingForm in form.Shippings %}';
            $source = str_replace($search, $replace, $source);
        }

        if(preg_match('/\{%\s*for\s*shipmentItemForm\s*in\s*shippingForm\.ShipmentItems\s*%\}/',$source, $result)){
            $search = $result[0];
            $replace = '{% for shippingItemkey, shipmentItemForm in shippingForm.ShipmentItems %}{% set shipmentitem_idx = shipmentitem_idx + 1%}';
            $source = str_replace($search, $replace, $source);
        }

        if(preg_match('/\{\{\sform_widget\(orderDetailForm\.tax_rule\)\s\}\}/',$source, $result)){
            $search = $result[0];
            $replace = '{{ form_widget(orderDetailForm.serial) }}';
            $source = str_replace($search, $replace, $source);
        }

        if(preg_match('/\{\{\sform_widget\(shipmentItemForm\.class_category_name2\)\s\}\}/',$source, $result)){
            $search = $result[0];
            $replace = '{{ form_widget(shipmentItemForm.serial) }}';
            $source = str_replace($search, $replace, $source);
        }

        if(preg_match('/<(.*)\s*id="product_info_list__class_category_name.*>\n/',$source, $result)){
            $start_tag = $result[0];
            $tag_name = trim($result[1]);
            $end_tag = '</' . $tag_name . '>';
            $start_index = strpos($source, $start_tag);
            $end_index = strpos($source, $end_tag, $start_index);
            $search = substr($source, $start_index, ($end_index - $start_index));

            $snipet = file_get_contents($app['config']['plugin_realdir']. '/ProductOption/Resource/template/admin/Order/detail_option.twig');
            $replace = $search.$snipet;
            $source = str_replace($search, $replace, $source);
        }

        if(preg_match('/<(.*)\s*id="shipment_item__class_category_name.*>\n/',$source, $result)){
            $start_tag = $result[0];
            $tag_name = trim($result[1]);
            $end_tag = '</' . $tag_name . '>';
            $start_index = strpos($source, $start_tag);
            $end_index = strpos($source, $end_tag, $start_index);
            $search = substr($source, $start_index, ($end_index - $start_index));

            $snipet = file_get_contents($app['config']['plugin_realdir']. '/ProductOption/Resource/template/admin/Order/shipmentitem_option.twig');
            $replace = $search.$snipet;
            $source = str_replace($search, $replace, $source);
        }

        if(preg_match("/\{\{\sinclude\(\'Order\/order_detail_prototype\.twig\',\s\{\s\'orderDetailForm\'\:\sform\.OrderDetails\.vars\.prototype\s\}\)\s\}\}/",$source, $result)){
            $search = $result[0];
            $replace = $search . '<div style="display:none;">{{ form_widget(form.OrderDetails.vars.prototype.serial) }}</div>';
            $source = str_replace($search, $replace, $source);
        }

        if(preg_match("/\{\{\sinclude\(\'Order\/shipment_item_prototype\.twig\'\,\s\{\s\'shipmentItemForm\'\:\sshippingForm\.ShipmentItems\.vars\.prototype\s\}\)\s\}\}/",$source, $result)){
            $search = $result[0];
            $replace = $search . '<div style="display:none;">{{ form_widget(shippingForm.ShipmentItems.vars.prototype.serial) }}</div>';
            $source = str_replace($search, $replace, $source);
        }

        $event->setSource($source);
        $parameters['plgOrderDetails'] = $plgOrderDetails;
        $parameters['plgShipmentItems'] = $plgShipmentItems;
        $event->setParameters($parameters);
    }

    public function render(FilterResponseEvent $event)
    {
        $app = $this->app;
        if (!$app->isGranted('ROLE_ADMIN')) {
            return $app->redirect($app->url('admin_login'));
        }

        $request = $event->getRequest();
        $response = $event->getResponse();
        $BaseInfo = $app['eccube.repository.base_info']->get();

        $id = $request->get('id');

        if (is_null($id)) {
            // 空のエンティティを作成.
            $Order = $this->newOrder();
        } else {
            $Order = $app['eccube.repository.order']->find($id);
            if (is_null($Order)) {
                throw new NotFoundHttpException();
            }
        }

        if ('POST' === $request->getMethod()) {

            if ($request->get('modal') === 'modal') {
                if($app['eccube.productoption.service.util']->checkInstallPlugin('CustomerRank')){
                    $Customer = $Order->getCustomer();
                    if($Customer){
                        $customer_id = $Customer->getId();
                    }else{
                        $PostOrder = $_POST['order'];
                        $customer_id = $PostOrder['Customer'];
                        if($customer_id > 0){
                            $Customer = $app['eccube.repository.customer']->find($customer_id);
                            $Order->setCustomer($Customer);
                        }
                    }
                    if($customer_id > 0){
                        $PlgCustomer = $app['eccube.customerrank.repository.customer']->findOneBy(array('customer_id' => $customer_id));
                        if($PlgCustomer){
                            $CustomerRank = $PlgCustomer->getCustomerRank();
                        }
                    }
                }

                $builder = $app['form.factory']
                    ->createBuilder('order');
                $form = $builder->getForm();
                $form->handleRequest($request);

                $Options = array();
                if (count($form['OrderDetails']) > 0) {
                    foreach ($form['OrderDetails'] as $idx => $refOrderDetail) {
                        if ($refOrderDetail->get('new')->getData() == 1) {
                            $target_detail_idx = $idx;
                            $addSerial = $refOrderDetail->get('serial')->getData();
                            $Options = json_decode($addSerial, true);
                        }
                    }
                }
                if(!isset($target_detail_idx))return;

                $option_price = $app['eccube.productoption.service.util']->getPriceFromOptions($Options);
                $deliv_free_flg = $app['eccube.productoption.service.util']->getDeliveryFreeFlgFromOptions($Options);

                $OrderDetails = $form->get('OrderDetails')->getData();

                $price = $OrderDetails[$target_detail_idx]->getPrice();
                if(isset($CustomerRank)){
                    $productClassId = $OrderDetails[$target_detail_idx]->getProductClass()->getId();
                    $price = $app['eccube.customerrank.service.util']->getMemberPriceByProductClass($CustomerRank, $productClassId);
                }
                $OrderDetails[$target_detail_idx]->setPrice($price + $option_price);

                $detail_iteration = 1;
                foreach($OrderDetails as $key => $OrderDetail){
                    if($key == $target_detail_idx){
                        break;
                    }
                    $detail_iteration++;
                }

                if ($BaseInfo->getOptionMultipleShipping() == Constant::ENABLED) {
                    foreach ($form['Shippings'] as $shipping_idx => $refShipping) {
                        foreach ($refShipping['ShipmentItems'] as $item_idx => $refShipmentItem) {
                            if ($refShipmentItem->get('new')->getData() == 1) {
                                $target_shipping_idx = $shipping_idx;
                                $target_item_idx = $item_idx;
                            }
                        }
                    }

                    $Shippings = $form->get('Shippings')->getData();
                    $ShipmentItems = $Shippings[$target_shipping_idx]->getShipmentItems();
                    $price = $ShipmentItems[$target_item_idx]->getPrice();
                    if(isset($CustomerRank)){
                        $productClassId = $ShipmentItems[$target_item_idx]->getProductClass()->getId();
                        $price = $app['eccube.customerrank.service.util']->getMemberPriceByProductClass($CustomerRank, $productClassId);
                    }
                    $ShipmentItems[$target_item_idx]->setPrice($price + $option_price);
                    $ShipmentItems[$target_item_idx]->setPriceIncTax($price + $option_price + $app['eccube.service.tax_rule']->calcTax($price + $option_price, $OrderDetails[$target_detail_idx]->getTaxRate(), $OrderDetails[$target_detail_idx]->getTaxRule()));
                }

                $taxtotal = 0;
                $subtotal = 0;
                foreach ($OrderDetails as $OrderDetail) {
                    $tax = $app['eccube.service.tax_rule']
                        ->calcTax($OrderDetail->getPrice(), $OrderDetail->getTaxRate(), $OrderDetail->getTaxRule());
                    $OrderDetail->setPriceIncTax($OrderDetail->getPrice() + $tax);

                    $taxtotal += $tax;
                    $subtotal += $OrderDetail->getTotalPrice();
                }

                if($deliv_free_flg){
                    $Order->setDeliveryFeeTotal(0);
                    $shippings = $Order->getShippings();
                    foreach ($shippings as $Shipping) {
                        $Shipping->setShippingDeliveryFee(0);
                    }
                }

                $Order->setTax($taxtotal);
                $Order->setSubtotal($subtotal);
                $Order->setTotal($subtotal + $Order->getCharge() + $Order->getDeliveryFeeTotal() - $Order->getDiscount());
                $Order->setPaymentTotal($Order->getTotal());

                //値書き換え
                $html = $response->getContent();

                libxml_use_internal_errors(true);
                $dom = new \DOMDocument();
                $dom->loadHTML('<?xml encoding="UTF-8">' . mb_convert_encoding($html,'HTML-ENTITIES', 'UTF-8'));
                $dom->encoding = "UTF-8";
                $dom->formatOutput = true;

                //明細
                $this->setInputValue($dom, 'order[OrderDetails]['.$target_detail_idx.'][price]', $OrderDetails[$target_detail_idx]->getPrice());
                $formElement = $dom->getElementById('product_info_list__total_price--'.$detail_iteration);
                if($formElement){
                    $formElement->childNodes->item(2)->nodeValue = $this->priceFilter($OrderDetails[$target_detail_idx]->getTotalPrice());
                }

                //お届け先明細
                if ($BaseInfo->getOptionMultipleShipping() == Constant::ENABLED) {
                    $ShipmentItems = $Shippings[$target_shipping_idx]->getShipmentItems();
                    $this->setInputValue($dom, 'order[Shippings]['.$target_shipping_idx.'][ShipmentItems]['.$target_item_idx.'][price]', $ShipmentItems[$target_item_idx]->getPrice());
                }

                //小計
                $formElement = $dom->getElementById('product_info_result_box__body_sub_price');
                if($formElement){
                    $formElement->childNodes->item(2)->nodeValue = $this->priceFilter($Order->getSubTotal());
                }

                //合計・お支払合計
                $formElement = $dom->getElementById('product_info_result_box__body_summary');
                if($formElement){
                    $formElement->childNodes->item(2)->nodeValue = $this->priceFilter($Order->getTotal());
                    $formElement->childNodes->item(6)->nodeValue = $this->priceFilter($Order->getPaymentTotal());
                }

                //送料
                $this->setInputValue($dom, 'order[delivery_fee_total]', $Order->getDeliveryFeeTotal());

                $response->setContent(mb_convert_encoding($dom->saveHTML(), 'UTF-8', 'HTML-ENTITIES'));
                $event->setResponse($response);
            }
        }
    }

    public function save(EventArgs $event)
    {
        $app = $this->app;
        $request = $app['request'];

        $TargetOrder = $event->getArgument('TargetOrder');
        $form = $event->getArgument('form');

        foreach($form['OrderDetails'] as $formData){
            $orderDetail = $formData->getData();
            $Serial = $formData->get('serial')->getData();
            $Serial = json_decode($Serial,true);
            $Serial = serialize($Serial);

            if($orderDetail->getId() > 0){
                if($Serial != ''){
                    $plgOrderDetail = $app['eccube.productoption.repository.order_detail']->findOneBy(array('order_detail_id' => $orderDetail->getId()));
                    if(!$plgOrderDetail){
                        $plgOrderDetail = new \Plugin\ProductOption\Entity\OrderDetail();
                        $plgOrderDetail->setOrderDetailId($orderDetail->getId());

                        $plgOrderOption = new \Plugin\ProductOption\Entity\OrderOption();
                        $plgOrderOption->setOrder($TargetOrder)
                                       ->setOrderId($TargetOrder->getId());
                        $plgOrderOption->setSerial($Serial);
                        $plgOrderOption = $app['eccube.productoption.repository.order_option']->save($plgOrderOption);

                        $plgOrderDetail->setOrderOptionId($plgOrderOption->getId())
                                       ->setOrderOption($plgOrderOption);

                        $app['orm.em']->persist($plgOrderDetail);
                    }else{
                        $plgOrderOption = $plgOrderDetail->getOrderOption();
                        $plgOrderOption->setSerial($Serial);
                        $app['eccube.productoption.repository.order_option']->save($plgOrderOption);
                    }
                }
            }
        }

        $app['orm.em']->flush();

        $BaseInfo = $app['eccube.repository.base_info']->get();

        if ($BaseInfo->getOptionMultipleShipping() == Constant::ENABLED) {
            foreach($form['Shippings'] as $shipping_idx => $formShipping){
                $shipping = $formShipping->getData();
                foreach($formShipping['ShipmentItems'] as $formShipmentItem){
                    $shipmentItem = $formShipmentItem->getData();
                    $Serial = $formShipmentItem->get('serial')->getData();
                    $Serial = json_decode($Serial,true);
                    $Serial = serialize($Serial);
                    if($Serial != ''){
                        $plgShipmentItem = $app['eccube.productoption.repository.shipment_item']->findOneBy(array('item_id' => $shipmentItem->getId()));
                        if(!$plgShipmentItem){
                            $plgShipmentItem = new \Plugin\ProductOption\Entity\ShipmentItem();
                            $plgShipmentItem->setItemId($shipmentItem->getId());

                            $plgOrderOption = new \Plugin\ProductOption\Entity\OrderOption();
                            $plgOrderOption->setOrder($TargetOrder)
                                           ->setOrderId($TargetOrder->getId());
                            $plgOrderOption->setSerial($Serial);
                            $plgOrderOption = $app['eccube.productoption.repository.order_option']->save($plgOrderOption);

                            $plgShipmentItem->setOrderOptionId($plgOrderOption->getId())
                                           ->setOrderOption($plgOrderOption);

                            $app['orm.em']->persist($plgShipmentItem);
                        }else{
                            $plgOrderOption = $plgShipmentItem->getOrderOption();
                            $plgOrderOption->setSerial($Serial);
                            $app['eccube.productoption.repository.order_option']->save($plgOrderOption);
                        }
                    }
                }
            }
        }else{
            $Shippings = $TargetOrder->getShippings();
            $arrRegistIdx = array();
            $arrRegistItemIdx = array();
            foreach($Shippings as $shipping){
                foreach($shipping->getShipmentItems() as $item_idx => $shipmentItem){
                    $orderDetails = $form->get('OrderDetails')->getData();
                    foreach($orderDetails as $idx => $orderDetail){
                        if(!in_array($idx,$arrRegistIdx) && !in_array($item_idx,$arrRegistItemIdx)){
                            if($orderDetail->getProductClass()->getId() == $shipmentItem->getProductClass()->getId()){
                                $arrRegistIdx[] = $idx;
                                $arrRegistItemIdx[] = $item_idx;
                                $plgOrderDetail = $app['eccube.productoption.repository.order_detail']->findOneBy(array('order_detail_id' => $orderDetail->getId()));
                                if($plgOrderDetail){
                                    $plgOrderOption = $plgOrderDetail->getOrderOption();

                                    $plgShipmentItem = $app['eccube.productoption.repository.shipment_item']->findOneBy(array('item_id' => $shipmentItem->getId()));
                                    if(!$plgShipmentItem){
                                        $plgShipmentItem = new \Plugin\ProductOption\Entity\ShipmentItem();
                                        $plgShipmentItem->setItemId($shipmentItem->getId());
                                    }

                                    $plgShipmentItem->setOrderOptionId($plgOrderOption->getId())
                                                   ->setOrderOption($plgOrderOption);

                                    $app['orm.em']->persist($plgShipmentItem);
                                }
                            }
                        }
                    }
                }
            }
        }

        $app['orm.em']->flush();
    }

    private function setInputValue($dom, $name, $value)
    {
        $xp = new \DOMXpath($dom);
        $nodes = $xp->query('//input[@name="'.$name.'"]');
        $node = $nodes->item(0);
        if(!is_null($node)){
            $node->setAttribute('value',$value);
        }
    }

    private function priceFilter($value)
    {
        return '\ '. number_format($value);
    }

    protected function newOrder()
    {
        $Order = new \Eccube\Entity\Order();
        $Shipping = new \Eccube\Entity\Shipping();
        $Shipping->setDelFlg(0);
        $Order->addShipping($Shipping);
        $Shipping->setOrder($Order);

        return $Order;
    }
}
