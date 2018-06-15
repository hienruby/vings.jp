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
use Eccube\Plugin\AbstractPluginManager;
use Symfony\Component\Filesystem\Filesystem;
use Eccube\Entity\Master\DeviceType;

class PluginManager extends AbstractPluginManager
{
    public function __construct()
    {

    }

    public function install($config, $app)
    {
        $this->migrationSchema($app, __DIR__ . '/Migration', $config['code']);
        $file = new Filesystem();
        try {
            $file->copy($app['config']['plugin_realdir']. '/ProductOption/Resource/template/default/Product/option.twig', $app['config']['template_realdir']. '/Product/option.twig', true);
            $file->copy($app['config']['plugin_realdir']. '/ProductOption/Resource/template/default/Product/option_description.twig', $app['config']['template_realdir']. '/Product/option_description.twig', true);
            $file->copy($app['config']['plugin_realdir']. '/ProductOption/Resource/template/default/Product/option_price.twig', $app['config']['template_realdir']. '/Product/option_price.twig', true);
            $file->copy($app['config']['plugin_realdir']. '/ProductOption/Resource/template/default/Product/option_point.twig', $app['config']['template_realdir']. '/Product/option_point.twig', true);
            $file->copy($app['config']['plugin_realdir']. '/ProductOption/html/js/jquery.plainmodal.min.js', $app['config']['template_html_realdir']. '/../../plugin/ProductOption/jquery.plainmodal.min.js', true);

            $mode = fileperms($app['config']['template_html_realdir'] . '/js');
            if($mode != false){
                chmod($app['config']['template_html_realdir']. '/../../plugin/ProductOption', $mode);
            }
            $mode = fileperms($app['config']['template_html_realdir'] . '/js/eccube.js');
            if($mode != false){
                chmod($app['config']['template_html_realdir']. '/../../plugin/ProductOption/jquery.plainmodal.min.js', $mode);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function uninstall($config, $app)
    {
        $this->migrationSchema($app, __DIR__ . '/Migration', $config['code'], 0);
        unlink($app['config']['template_realdir']. '/Product/option.twig');
        unlink($app['config']['template_realdir']. '/Product/option_description.twig');
        unlink($app['config']['template_realdir']. '/Product/option_price.twig');
        unlink($app['config']['template_realdir']. '/Product/option_point.twig');
        unlink($app['config']['template_html_realdir']. '/../../plugin/ProductOption/jquery.plainmodal.min.js');
    }

    public function enable($config, $app)
    {
        $this->addCsv($app);
        $this->addCSVext($app);
    }

    public function disable($config, $app)
    {
        $Csvs = $app['eccube.repository.csv']->findBy(array('field_name' => 'OrderOption'));
        foreach($Csvs as $Csv){
            $app['orm.em']->remove($Csv);
        }
        $Csvs = $app['eccube.repository.csv']->findBy(array('entity_name' => 'Plugin\\ProductOption\\Entity\\ProductOption'));
        foreach($Csvs as $Csv){
            $app['orm.em']->remove($Csv);
        }
        $app['orm.em']->flush();
    }

    public function update($config, $app)
    {
        $this->migrationSchema($app, __DIR__ . '/Migration', $config['code']);

        $Plugin = $app['eccube.repository.plugin']->findOneBy(array('code' => 'ProductOption'));
        if(version_compare($Plugin->getVersion(),'1.1.0','<=')){
            $file = new Filesystem();
            try {
                $file->copy($app['config']['plugin_realdir']. '/ProductOption/html/js/jquery.plainmodal.min.js', $app['config']['root_dir']. '/html/plugin/ProductOption/jquery.plainmodal.min.js', true);
            } catch (\Exception $e) {
            }

            $file = $app['eccube.repository.page_layout']
                ->getReadTemplateFile('Product/option_description', false);

            $source = $file['tpl_data'];
            if(preg_match('/Option\.Action\.id\s==\s1/',$source, $result)){
                $search = $result[0];
                $source = str_replace($search, 'optionCategory.value|length > 0' , $source);

                $templatePath = $app['eccube.repository.page_layout']->getWriteTemplatePath(false);

                $filePath = $templatePath . '/Product/option_description.twig';
                $fs = new Filesystem();
                $fs->dumpFile($filePath, $source);
            }
        }
        if(version_compare($Plugin->getVersion(),'1.1.1','<=')){
            $Options = $app['orm.em']->getRepository('Plugin\ProductOption\Entity\Option')->getList();
            if($Options){
                $rank = count($Options);
                foreach($Options as $Option){
                    $Option->setRank($rank);
                    $app['orm.em']->persist($Option);
                    $rank--;
                }
                $app['orm.em']->flush();
            }
        }
        if(version_compare($Plugin->getVersion(),'1.2.0','<=')){
            $file = new Filesystem();
            try {
                $file->copy($app['config']['plugin_realdir']. '/ProductOption/Resource/template/default/Product/option_point.twig', $app['config']['template_realdir']. '/Product/option_point.twig', true);
            } catch (\Exception $e) {
            }
        }
        if(version_compare($Plugin->getVersion(),'1.3.8','<=') && $Plugin->getEnable() == Constant::ENABLED && version_compare(Constant::VERSION,'3.0.14','>=')){
            $now = new \DateTime();
            //CSV項目追加
            $CsvType = $app['eccube.repository.master.csv_type']->find(\Eccube\Entity\Master\CsvType::CSV_TYPE_PRODUCT);
            $rank = $app['orm.em']->createQueryBuilder()
                ->select('MAX(c.rank)')
                ->from('Eccube\Entity\Csv','c')
                ->where('c.CsvType = :csvType')
                ->setParameter(':csvType',$CsvType)
                ->getQuery()
                ->getSingleScalarResult();
            if (!$rank) {
                $rank = 0;
            }

            $Csv = new \Eccube\Entity\Csv();
            $Csv->setCsvType($CsvType);
            $Csv->setEntityName('Plugin\\ProductOption\\Entity\\ProductOption');
            $Csv->setFieldName('product_option');
            $Csv->setDispName('オプション情報');
            $Csv->setEnableFlg(0);
            $Csv->setRank($rank + 1);
            $Csv->setCreateDate($now);
            $Csv->setUpdateDate($now);
            $app['orm.em']->persist($Csv);

            $Csv = new \Eccube\Entity\Csv();
            $Csv->setCsvType($CsvType);
            $Csv->setEntityName('Plugin\\ProductOption\\Entity\\ProductOption');
            $Csv->setFieldName('product_option_name');
            $Csv->setDispName('オプション情報(名称)');
            $Csv->setEnableFlg(0);
            $Csv->setRank($rank + 2);
            $Csv->setCreateDate($now);
            $Csv->setUpdateDate($now);
            $app['orm.em']->persist($Csv);
            $app['orm.em']->flush();
        }
        if(version_compare($Plugin->getVersion(),'1.3.9','<=') && $Plugin->getEnable() == Constant::ENABLED){
            $this->addCSVext($app);
        }
    }

    private function addCsv($app)
    {
        $now = new \DateTime();
        //CSV項目追加
        $Csv = new \Eccube\Entity\Csv();
        $CsvType = $app['eccube.repository.master.csv_type']->find(\Eccube\Entity\Master\CsvType::CSV_TYPE_ORDER);
        $rank = $app['orm.em']->createQueryBuilder()
            ->select('MAX(c.rank)')
            ->from('Eccube\Entity\Csv','c')
            ->where('c.CsvType = :csvType')
            ->setParameter(':csvType',$CsvType)
            ->getQuery()
            ->getSingleScalarResult();
        if (!$rank) {
            $rank = 0;
        }
        $Csv->setCsvType($CsvType);
        $Csv->setEntityName('Plugin\\ProductOption\\Entity\\OrderDetail');
        $Csv->setFieldName('OrderOption');
        $Csv->setDispName('オプション情報');
        $Csv->setEnableFlg(0);
        $Csv->setRank($rank + 1);
        $Csv->setCreateDate($now);
        $Csv->setUpdateDate($now);
        $app['orm.em']->persist($Csv);

        $Csv = new \Eccube\Entity\Csv();
        $CsvType = $app['eccube.repository.master.csv_type']->find(\Eccube\Entity\Master\CsvType::CSV_TYPE_SHIPPING);
        $rank = $app['orm.em']->createQueryBuilder()
            ->select('MAX(c.rank)')
            ->from('Eccube\Entity\Csv','c')
            ->where('c.CsvType = :csvType')
            ->setParameter(':csvType',$CsvType)
            ->getQuery()
            ->getSingleScalarResult();
        if (!$rank) {
            $rank = 0;
        }
        $Csv->setCsvType($CsvType);
        $Csv->setEntityName('Plugin\\ProductOption\\Entity\\ShipmentItem');
        $Csv->setFieldName('OrderOption');
        $Csv->setDispName('オプション情報');
        $Csv->setEnableFlg(0);
        $Csv->setRank($rank + 1);
        $Csv->setCreateDate($now);
        $Csv->setUpdateDate($now);
        $app['orm.em']->persist($Csv);

        if(version_compare(Constant::VERSION,'3.0.14','>=')){
            $now = new \DateTime();
            //CSV項目追加
            $CsvType = $app['eccube.repository.master.csv_type']->find(\Eccube\Entity\Master\CsvType::CSV_TYPE_PRODUCT);
            $rank = $app['orm.em']->createQueryBuilder()
                ->select('MAX(c.rank)')
                ->from('Eccube\Entity\Csv','c')
                ->where('c.CsvType = :csvType')
                ->setParameter(':csvType',$CsvType)
                ->getQuery()
                ->getSingleScalarResult();
            if (!$rank) {
                $rank = 0;
            }

            $Csv = new \Eccube\Entity\Csv();
            $Csv->setCsvType($CsvType);
            $Csv->setEntityName('Plugin\\ProductOption\\Entity\\ProductOption');
            $Csv->setFieldName('product_option');
            $Csv->setDispName('オプション情報');
            $Csv->setEnableFlg(0);
            $Csv->setRank($rank + 1);
            $Csv->setCreateDate($now);
            $Csv->setUpdateDate($now);
            $app['orm.em']->persist($Csv);

            $Csv = new \Eccube\Entity\Csv();
            $Csv->setCsvType($CsvType);
            $Csv->setEntityName('Plugin\\ProductOption\\Entity\\ProductOption');
            $Csv->setFieldName('product_option_name');
            $Csv->setDispName('オプション情報(名称)');
            $Csv->setEnableFlg(0);
            $Csv->setRank($rank + 2);
            $Csv->setCreateDate($now);
            $Csv->setUpdateDate($now);
            $app['orm.em']->persist($Csv);
        }

        $app['orm.em']->flush();
    }

    private function addCSVext($app)
    {
        $Options = $app['orm.em']->getRepository('Plugin\ProductOption\Entity\Option')->findAll();
        $now = new \DateTime();
        //CSV項目追加
        foreach($Options as $Option){
            $OrderCsvType = $app['eccube.repository.master.csv_type']->find(\Eccube\Entity\Master\CsvType::CSV_TYPE_ORDER);
            $order_rank = $app['orm.em']->createQueryBuilder()
                ->select('MAX(c.rank)')
                ->from('Eccube\Entity\Csv','c')
                ->where('c.CsvType = :csvType')
                ->setParameter(':csvType',$OrderCsvType)
                ->getQuery()
                ->getSingleScalarResult();
            if (!$order_rank) {
                $order_rank = 0;
            }

            $ShippingCsvType = $app['eccube.repository.master.csv_type']->find(\Eccube\Entity\Master\CsvType::CSV_TYPE_SHIPPING);
            $shipping_rank = $app['orm.em']->createQueryBuilder()
                ->select('MAX(c.rank)')
                ->from('Eccube\Entity\Csv','c')
                ->where('c.CsvType = :csvType')
                ->setParameter(':csvType',$ShippingCsvType)
                ->getQuery()
                ->getSingleScalarResult();
            if (!$shipping_rank) {
                $shipping_rank = 0;
            }

            $Csv = new \Eccube\Entity\Csv();
            $Csv->setCsvType($OrderCsvType);
            $Csv->setEntityName('Plugin\\ProductOption\\Entity\\OrderDetail');
            $Csv->setFieldName('OrderOption');
            $Csv->setReferenceFieldName($Option->getId());
            $Csv->setDispName($Option->getManageName());
            $Csv->setEnableFlg(0);
            $Csv->setRank(++$order_rank);
            $Csv->setCreateDate($now);
            $Csv->setUpdateDate($now);
            $app['orm.em']->persist($Csv);

            $Csv = new \Eccube\Entity\Csv();
            $Csv->setCsvType($ShippingCsvType);
            $Csv->setEntityName('Plugin\\ProductOption\\Entity\\ShipmentItem');
            $Csv->setFieldName('OrderOption');
            $Csv->setReferenceFieldName($Option->getId());
            $Csv->setDispName($Option->getManageName());
            $Csv->setEnableFlg(0);
            $Csv->setRank(++$shipping_rank);
            $Csv->setCreateDate($now);
            $Csv->setUpdateDate($now);
            $app['orm.em']->persist($Csv);
        }
        $app['orm.em']->flush();
    }
}
