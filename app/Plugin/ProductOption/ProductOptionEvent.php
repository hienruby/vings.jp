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

namespace Plugin\ProductOption;

use Eccube\Common\Constant;
use Eccube\Event\TemplateEvent;
use Eccube\Event\EventArgs;
use Plugin\ProductOption\Event\WorkPlace\AdminProduct;
use Plugin\ProductOption\Event\WorkPlace\AdminProductEdit;
use Plugin\ProductOption\Event\WorkPlace\AdminProductExport;
use Plugin\ProductOption\Event\WorkPlace\AdminOrderEdit;
use Plugin\ProductOption\Event\WorkPlace\AdminOrderEditLegacy;
use Plugin\ProductOption\Event\WorkPlace\AdminOrderEditSearchProduct;
use Plugin\ProductOption\Event\WorkPlace\AdminOrderEditSearchProductLegacy;
use Plugin\ProductOption\Event\WorkPlace\AdminOrderMail;
use Plugin\ProductOption\Event\WorkPlace\AdminOrderMailAll;
use Plugin\ProductOption\Event\WorkPlace\AdminOrderExport;
use Plugin\ProductOption\Event\WorkPlace\FrontProductDetail;
use Plugin\ProductOption\Event\WorkPlace\FrontCart;
use Plugin\ProductOption\Event\WorkPlace\FrontShopping;
use Plugin\ProductOption\Event\WorkPlace\FrontShoppingMultiple;
use Plugin\ProductOption\Event\WorkPlace\FrontShoppingComplete;
use Plugin\ProductOption\Event\WorkPlace\FrontMypage;
use Plugin\ProductOption\Event\WorkPlace\FrontMypageHistory;
use Plugin\ProductOption\Event\WorkPlace\ServiceExportOrder;
use Plugin\ProductOption\Event\WorkPlace\ServiceExportShipping;
use Plugin\ProductOption\Event\WorkPlace\ServiceMail;
use Plugin\ProductOption\Event\WorkPlace\ServiceAdminMail;
use Plugin\ProductOption\Event\WorkPlace\BlockCart;
use Plugin\ProductOption\Event\WorkPlace\FrontCartPoint;
use Plugin\ProductOption\Event\WorkPlace\FrontShoppingPoint;
use Plugin\ProductOption\Event\WorkPlace\FrontShoppingCompletePoint;
use Plugin\ProductOption\Event\WorkPlace\ExpressLinkShippingMail;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ProductOptionEvent
{

    public function onRenderProductDetail(TemplateEvent $event)
    {
        $helper = new FrontProductDetail();
        $helper->createTwig($event);
    }

    public function addCartInitialize(EventArgs $event)
    {
        if(version_compare(Constant::VERSION,'3.0.10','<')){
            $helper = new FrontProductDetail();
            $helper->execute($event);
        }
    }

    public function addCartComplete(EventArgs $event)
    {
        if(version_compare(Constant::VERSION,'3.0.9','>')){
            $helper = new FrontProductDetail();
            $helper->execute($event);
        }
    }

    public function onRenderCart(TemplateEvent $event)
    {
        $helper = new FrontCart();
        $helper->createTwig($event);
    }

    public function onRenderCartPoint(TemplateEvent $event)
    {
        $helper = new FrontCartPoint();
        $helper->createTwig($event);
    }

    public function onRenderShopping(TemplateEvent $event)
    {
        $helper = new FrontShopping();
        $helper->createTwig($event);
    }

    public function onRenderShoppingPoint(TemplateEvent $event)
    {
        $helper = new FrontShoppingPoint();
        $helper->createTwig($event);
    }

    public function onRenderShoppingMultiple(TemplateEvent $event)
    {
        $helper = new FrontShoppingMultiple();
        $helper->createTwig($event);
    }

    public function onRenderMypage(TemplateEvent $event)
    {
        $helper = new FrontMypage();
        $helper->createTwig($event);
    }

    public function onRenderMypageHistory(TemplateEvent $event)
    {
        $helper = new FrontMypageHistory();
        $helper->createTwig($event);
    }

    public function onRenderAdminProduct(TemplateEvent $event)
    {
        $helper = new AdminProduct();
        $helper->createTwig($event);
    }

    public function onRenderAdminProductEdit(TemplateEvent $event)
    {
        $helper = new AdminProductEdit();
        $helper->createTwig($event);
    }

    public function onRenderAdminOrderEdit(TemplateEvent $event)
    {
        if(version_compare(Constant::VERSION,'3.0.13','<')){
            $helper = new AdminOrderEditLegacy();
        }else{
            $helper = new AdminOrderEdit();
        }
        $helper->createTwig($event);
    }

    public function changePrice(FilterResponseEvent $event)
    {
        if(version_compare(Constant::VERSION,'3.0.13','<')){
            $helper = new AdminOrderEditLegacy();
        }else{
            $helper = new AdminOrderEdit();
        }
        $helper->render($event);
    }

    public function registOrder(EventArgs $event)
    {
        if(version_compare(Constant::VERSION,'3.0.13','<')){
            $helper = new AdminOrderEditLegacy();
        }else{
            $helper = new AdminOrderEdit();
        }
        $helper->save($event);
    }

    public function onRenderAdminOrderSearchProduct(TemplateEvent $event)
    {
        if(version_compare(Constant::VERSION,'3.0.13','<')){
            $helper = new AdminOrderEditSearchProductLegacy();
        }else{
            $helper = new AdminOrderEditSearchProduct();
        }
        $helper->createTwig($event);
    }

    public function onRenderAdminOrderMailConfirm(TemplateEvent $event)
    {
        $helper = new AdminOrderMail();
        $helper->createTwig($event);
    }

    public function onRenderAdminOrderMailAllConfirm(TemplateEvent $event)
    {
        $helper = new AdminOrderMailAll();
        $helper->createTwig($event);
    }

    public function customOrder(EventArgs $event)
    {
        $helper = new FrontShopping();
        $helper->execute($event);
    }

    public function mypageOrderInitialize(EventArgs $event)
    {
        if(version_compare(Constant::VERSION,'3.0.10','<')){
            $helper= new FrontMypageHistory();
            $helper->execute($event);
        }
    }

    public function mypageOrderComplete(EventArgs $event)
    {
        if(version_compare(Constant::VERSION,'3.0.9','>')){
            $helper= new FrontMypageHistory();
            $helper->execute($event);
        }
    }

    public function multipleShippingEdit(EventArgs $event)
    {
        if(version_compare(Constant::VERSION,'3.0.11','<')){
            $helper = new FrontShoppingMultiple();
            $helper->execute($event);
        }
    }

    public function completeShopping(EventArgs $event)
    {
        $helper = new FrontShoppingComplete();
        $helper->execute($event);
    }

    public function completeShoppingPoint(EventArgs $event)
    {
        $helper = new FrontShoppingCompletePoint();
        $helper->save($event);
    }

    public function onServiceShoppingNotifyComplete(EventArgs $event)
    {
        $helper = new FrontShoppingCompletePoint();
        $helper->save($event);
    }

    public function onSendOrderMail(EventArgs $event)
    {
        $helper = new ServiceMail();
        $helper->execute($event);
    }

    public function onSendAdminOrderMail($event)
    {
        $helper = new ServiceAdminMail();
        $helper->execute($event);
    }

    public function completeSendOrderMail(EventArgs $event)
    {
        $helper = new FrontShoppingComplete();
        $helper->save($event);
    }

    public function copmleteSendAdminOrderMail(EventArgs $event)
    {
        $helper = new AdminOrderMail();
        $helper->save($event);
    }

    public function copmleteSendAdminOrderMailAll(EventArgs $event)
    {
        $helper = new AdminOrderMailAll();
        $helper->save($event);
    }

    public function hookAdminProductCopyComplete(EventArgs $event)
    {
        $helper = new AdminProduct();
        $helper->save($event);
    }

    public function exportOrder()
    {
        if(version_compare(Constant::VERSION,'3.0.14','<')){
            $helper = new ServiceExportOrder();
            $helper->execute();
        }
    }

    public function exportShipping()
    {
        if(version_compare(Constant::VERSION,'3.0.14','<')){
            $helper = new ServiceExportShipping();
            $helper->execute();
        }
    }

    public function hookAdminOrderCsvExportOrder(EventArgs $event)
    {
        $helper = new AdminOrderExport();
        $helper->exportOrder($event);
    }

    public function hookAdminOrderCsvExportShipping(EventArgs $event)
    {
        $helper = new AdminOrderExport();
        $helper->exportShipping($event);
    }

    public function setCartPrice()
    {
        $helper = new FrontCart();
        $helper->execute();
    }

    public function hookAdminProductCsvExport(EventArgs $event)
    {
        $helper = new AdminProductExport();
        $helper->export($event);
    }

    public function onTemplateBlockCart(TemplateEvent $event)
    {
        $helper = new BlockCart();
        $helper->createTwig($event);
    }

    public function onTemplateExpressLinkMailConfirm(TemplateEvent $event)
    {
        $helper = new ExpressLinkShippingMail();
        $helper->createTwig($event);
    }

    public function hookExpressLinkShippingMailInitialize(EventArgs $event)
    {
        $helper = new ExpressLinkShippingMail();
        $helper->execute($event);
    }

}
