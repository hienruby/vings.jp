<?php
/*
* Plugin Name : GSFeed
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\GSFeed\Controller;

use Eccube\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GSFeedController
{
    public function xml(Application $app)
    {
        $Products = $app['orm.em']->getRepository('\Eccube\Entity\Product')
            ->findBy(
                array(),
                array('id' => 'ASC')
            );

        $ProductsForCategory = $app['eccube.repository.product'];
        $Categories = $app['eccube.repository.category'];

        $Info = $app['orm.em']->getRepository('\Eccube\Entity\BaseInfo')
            ->findAll();
        $Info = $Info[0];
        
        $Parameters = $app['eccube.gsfeed.repository.config']->findAll();
        $Parameter = array(
            'brand'     => $Parameters[0]->getBrand(),
            'gcategory' => $Parameters[0]->getGCategory()
        );
        
        $Items = array();
        foreach ($Products as $Product) {
            if($Product->getStatus()->getId() == 2)continue;
            $Item = array();
            $Item['id'] = $Product->getCodeMin();
            $Item['title'] = $Product->getName();
            $Item['link'] = $app->url('product_detail', array('id' => $Product['id']));
            $Item['description'] = strip_tags($Product->getDescriptionDetail()). ' 商品コード:' . $Product->getCodeMin();
            $image = $Product->getMainListImage();
            if($image){
                $image_url = $app->url('homepage') . "upload/save_image/" . $image['file_name'];
            }else{
                $image_url = null;
            }
            $Item['image_link'] = $image_url;
            $Item['price'] = $Product->getPrice02IncTaxMin();
            
            $categoryArr = array();
            $product_category = $ProductsForCategory->find($Product->getId())->getProductCategories();
            if($product_category[0]){
                $child = $product_category[0]->getCategory(); //rank高い順，末端
                array_push($categoryArr, $child);
                $parent = $Categories->find($child['id'])->getParent();
                while (!is_null($parent)) {
                    array_push($categoryArr, $parent);
                    $parent = $Categories->find($parent)->getParent();
                }
                $category = implode(" > ", array_reverse($categoryArr));
                $Item['product_type'] = $category;
            }else{
                $Item['product_type'] = '';
            }
            $Item['mpn'] = $Product->getId();
            $stock_unlimited = $Product->getStockUnlimitedMin();
            $stock = intval($Product->getStockMin());
            if($stock_unlimited == 1){
                $Item['availability'] = 'in stock';
            }else{
                $Item['availability'] = $stock > 0 ? 'in stock' : 'out of stock';
            }

            $Items[] = $Item;
        }
        
        $feed = $app->renderView(
            'GSFeed/Resource/template/gsfeed.twig',
            array(
                'Info' => $Info,
                'Parameter' => $Parameter,
                'Items' => $Items,
            )
        );
        
        $response = new Response();
        $response->setContent($feed);
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Content-type','application/xml; charset=utf-8');
        return $response;
    }
}
