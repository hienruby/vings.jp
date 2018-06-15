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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


class AdminOrderExport extends AbstractWorkPlace
{
    public function exportOrder(EventArgs $event)
    {
        $app = $this->app;

        $ExportCsvRow = $event->getArgument('ExportCsvRow');
        if ($ExportCsvRow->isDataNull()) {

            $csvService = $event->getArgument('csvService');
            $OrderDetail = $event->getArgument('OrderDetail');
            $Csv = $event->getArgument('Csv');

            $csvEntityName = str_replace('\\\\', '\\', $Csv->getEntityName());
            if($csvEntityName == 'Plugin\ProductOption\Entity\OrderDetail'){
                $data = '';
                if(!is_null($Csv->getReferenceFieldName())){
                    $optionId = $Csv->getReferenceFieldName();
                    $plgOrderDetail = $app['eccube.productoption.repository.order_detail']->findOneBy(array('order_detail_id' => $OrderDetail->getId()));
                    if($plgOrderDetail){
                        $OrderOptionItems = $plgOrderDetail->getOrderOption()->getOrderOptionItems();
                        foreach($OrderOptionItems as $OrderOptionItem){
                            if($optionId == $OrderOptionItem->getOptionId()){
                                $data = $OrderOptionItem->getOptionCategoryName();
                                break;
                            }
                        }
                    }
                }else{
                    $plgOrderDetail = $app['eccube.productoption.repository.order_detail']->findOneBy(array('order_detail_id' => $OrderDetail->getId()));
                    if($plgOrderDetail){
                        $data = implode($app['config']['csv_export_multidata_separator'],$plgOrderDetail->getOrderOption()->getLabel());
                    }
                }
                $ExportCsvRow->setData($data);
            }
        }
    }

    public function exportShipping(EventArgs $event)
    {
        $app = $this->app;

        $ExportCsvRow = $event->getArgument('ExportCsvRow');
        if ($ExportCsvRow->isDataNull()) {

            $csvService = $event->getArgument('csvService');
            $ShipmentItem = $event->getArgument('ShipmentItem');
            $Csv = $event->getArgument('Csv');

            $csvEntityName = str_replace('\\\\', '\\', $Csv->getEntityName());
            if($csvEntityName == 'Plugin\ProductOption\Entity\ShipmentItem'){
                $data = '';
                if(!is_null($Csv->getReferenceFieldName())){
                    $optionId = $Csv->getReferenceFieldName();
                    $plgShipmentItem = $app['eccube.productoption.repository.shipment_item']->findOneBy(array('item_id' => $ShipmentItem->getId()));
                    if($plgShipmentItem){
                        $OrderOptionItems = $plgShipmentItem->getOrderOption()->getOrderOptionItems();
                        foreach($OrderOptionItems as $OrderOptionItem){
                            if($optionId == $OrderOptionItem->getOptionId()){
                                $data = $OrderOptionItem->getOptionCategoryName();
                                break;
                            }
                        }
                    }
                }else{
                    $plgShipmentItem = $app['eccube.productoption.repository.shipment_item']->findOneBy(array('item_id' => $ShipmentItem->getId()));
                    if($plgShipmentItem){
                        $data = implode($app['config']['csv_export_multidata_separator'],$plgShipmentItem->getOrderOption()->getLabel());
                    }
                }
                $ExportCsvRow->setData($data);
            }
        }
    }
}
