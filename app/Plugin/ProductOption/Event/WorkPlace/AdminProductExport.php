<?php
/*
 * Plugin Name : ProductOption
 *
 * Copyright (C) BraTech Co., Ltd. All Rights Reserved.
 * http://www.bratech.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\ProductOption\Event\WorkPlace;

use Eccube\Event\EventArgs;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


class AdminProductExport extends AbstractWorkPlace
{
    public function export(EventArgs $event)
    {
        $app = $this->app;

        $ExportCsvRow = $event->getArgument('ExportCsvRow');
        if ($ExportCsvRow->isDataNull()) {

            $csvService = $event->getArgument('csvService');
            $ProductClass = $event->getArgument('ProductClass');
            $Product = $ProductClass->getProduct();
            $Csv = $event->getArgument('Csv');

            $csvEntityName = str_replace('\\\\', '\\', $Csv->getEntityName());
            if($csvEntityName == 'Plugin\ProductOption\Entity\ProductOption'){
                $plgProductOptions = $app['eccube.productoption.repository.product_option']->findBy(array('Product' => $Product), array('rank' => 'asc'));
                if($plgProductOptions){
                    $array = array();
                    foreach($plgProductOptions as $plgProductOption){
                        if($Csv->getFieldName() == 'product_option'){
                            $array[] = $plgProductOption->getOptionId();
                        }elseif($Csv->getFieldName() == 'product_option_name'){
                            $array[] = $plgProductOption->getOption()->getManageName();
                        }
                    }
                    $ExportCsvRow->setData(implode($app['config']['csv_import_delimiter'], $array));
                }
            }
        }
    }
}
