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

namespace Plugin\CartAnalytics;

use Eccube\Application;
use Eccube\Entity\Category;
use Eccube\Event\EventArgs;
use Eccube\Event\TemplateEvent;
use Plugin\CartAnalytics\Entity\CartAnalytics;
use Symfony\Component\Form\FormInterface;

class CartAnalyticsEvent
{

    const CART_ANALYTICS_SESSION_NAME = 'plg_cart_analytics';

    /**
     * @var \Eccube\Application
     */
    private $app;

    /**
     * CategoryContentEvent constructor.
     *
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    public function calcCartAnalytics(EventArgs $event)
    {
        try {

            $cartAnalyticsId = null;
            $today = new \DateTime();
            $session = $this->session = $this->app['session'];

            if ($session->has(self::CART_ANALYTICS_SESSION_NAME)) {
                //セッションがある場合はDBデータ削除
                $cartAnalyticsId = $session->get(self::CART_ANALYTICS_SESSION_NAME);
                $qb = $this->app['orm.em']->createQueryBuilder();
                $query = $qb->delete('\Plugin\CartAnalytics\Entity\CartAnalytics', 'c')
                    ->where('c.cart_analytics_id = :cartAnalyticsId')
                    ->setParameter('cartAnalyticsId', $cartAnalyticsId)
                    ->getQuery();
                $query->execute();
            } else {
                //セッションがない場合ははじめてのカート追加なのでIDを生成、セッションにセット
                $cartAnalyticsId = md5(uniqid(rand(), 1));
                $session->set(self::CART_ANALYTICS_SESSION_NAME, $cartAnalyticsId);
            }

            $CartItems = $this->app['eccube.service.cart']->getCart()->getCartItems();

            //カート内の全商品をDBに登録
            foreach ($CartItems as $Item) {
                $quantity = $Item->getQuantity();
                $ProductClass = $Item->getObject();
                $Product = $ProductClass->getProduct();
                $CartAnalytics = new CartAnalytics();
                $CartAnalytics->setCartAnalyticsId($cartAnalyticsId);
                $CartAnalytics->setProductClassId($ProductClass->getId());
                $CartAnalytics->setProductId($Product->getId());
                $CartAnalytics->setQuantity($quantity);
                $CartAnalytics->setPrice($quantity * $ProductClass->getPrice02());
                $CartAnalytics->setAddDate($today);
                $CartAnalytics->setBuyFlg(0);
                $session->set(self::CART_ANALYTICS_SESSION_NAME, $cartAnalyticsId);
                $this->app['orm.em']->persist($CartAnalytics);
            }

            $this->app['orm.em']->flush();
            
        }catch (\Exception $e) {
            $this->app->log($e);
        }
    }

    /*
    public function addCartAnalytics(EventArgs $event)
    {
        try {
            $Product = $event->getArgument('Product');
            $form = $event->getArgument('form');
            $addCartData = $form->getData();
            $productClassId = $addCartData['product_class_id'];
            $quantity = $addCartData['quantity'];
            $ProductClass = $this->app['eccube.repository.product_class']->find($productClassId);
    
            $today = new \DateTime();
    
            $cartAnalyticsRepository = $this->app['cart_analytics.repository.cart_analytics'];
    
            $session = $this->session = $this->app['session'];
            if ($session->has(self::CART_ANALYTICS_SESSION_NAME)) {
                //セッションがある場合は二回目以降のアクセスなのでDBからデータ取得
                $cartAnalyticsId = $session->get(self::CART_ANALYTICS_SESSION_NAME);
                $CartAnalytics = $cartAnalyticsRepository->findOneBy(array(
                        'cart_analytics_id' => $cartAnalyticsId,
                        'product_class_id' => $productClassId)
                );
                //二回目以降でも該当商品については初めてかも知れない
                if (is_null($CartAnalytics)) {
                    $CartAnalytics = new CartAnalytics();
                    $CartAnalytics->setCartAnalyticsId($cartAnalyticsId);
                    $CartAnalytics->setProductClassId($productClassId);
                    $CartAnalytics->setProductId($Product->getId());
                    $CartAnalytics->setQuantity($quantity);
                    $CartAnalytics->setPrice($quantity * $ProductClass->getPrice02());
                    $CartAnalytics->setAddDate($today);
                    $CartAnalytics->setBuyFlg(0);
                } else {
                    $CartAnalytics->setQuantity($CartAnalytics->getQuantity() + $quantity);
                    $CartAnalytics->setPrice($CartAnalytics->getQuantity() * $ProductClass->getPrice02());
                }
            } else {
                //セッションがない場合ははじめてのカート追加なのでIDを生成
                $cartAnalyticsId = md5(uniqid(rand(), 1));
                $CartAnalytics = new CartAnalytics();
                $CartAnalytics->setCartAnalyticsId($cartAnalyticsId);
                $CartAnalytics->setProductClassId($productClassId);
                $CartAnalytics->setProductId($Product->getId());
                $CartAnalytics->setQuantity($quantity);
                $CartAnalytics->setPrice($quantity * $ProductClass->getPrice02());
                $CartAnalytics->setAddDate($today);
                $CartAnalytics->setBuyFlg(0);
                $session->set(self::CART_ANALYTICS_SESSION_NAME, $cartAnalyticsId);
            }
    
            $this->app['orm.em']->persist($CartAnalytics);
            $this->app['orm.em']->flush();
        }catch (\Exception $e) {
            
        }
    }

    public function upCartAnalytics(EventArgs $event)
    {
        try {
            $newFlg = false;
            $productClassId = $event->getArgument('productClassId');
            $quantity = 1;
            $today = new \DateTime();
    
            $cartAnalyticsRepository = $this->app['cart_analytics.repository.cart_analytics'];
    
            $session = $this->app['session'];
            if ($session->has(self::CART_ANALYTICS_SESSION_NAME)) {
                //セッションがある場合は二回目以降のアクセスなのでDBからデータ取得
                $cartAnalyticsId = $session->get(self::CART_ANALYTICS_SESSION_NAME);
                $CartAnalytics = $cartAnalyticsRepository->findOneBy(array(
                        'cart_analytics_id' => $cartAnalyticsId,
                        'product_class_id' => $productClassId)
                );
                //二回目以降でも該当商品については初めてかも知れない
                if (is_null($CartAnalytics)) {
                    $CartAnalytics = new CartAnalytics();
                    $CartAnalytics->setCartAnalyticsId($cartAnalyticsId);
                    $newFlg = true;
                } else {
                    $ProductClass = $this->app['eccube.repository.product_class']->find($productClassId);
                    $CartAnalytics->setQuantity($CartAnalytics->getQuantity() + $quantity);
                    $CartAnalytics->setPrice($CartAnalytics->getQuantity() * $ProductClass->getPrice02());
                }
            } else {
                //セッションがない場合ははじめてのカート追加なのでIDを生成
                //通常はありえないが、カートに追加されている状態でプラグインがONになった場合などはあり得る。
                $cartAnalyticsId = md5(uniqid(rand(),1));
                $CartAnalytics = new CartAnalytics();
                $CartAnalytics->setCartAnalyticsId($cartAnalyticsId);
                $session->set(self::CART_ANALYTICS_SESSION_NAME, $cartAnalyticsId);
                $newFlg = true;
            }
    
            if ($newFlg) {
                $ProductClass = $this->app['eccube.repository.product_class']->find($productClassId);
                $CartAnalytics->setProductClassId($productClassId);
                $CartAnalytics->setProductId($ProductClass->getProduct()->getId());
                $CartAnalytics->setQuantity($quantity);
                $CartAnalytics->setPrice($quantity * $ProductClass->getPrice02());
                $CartAnalytics->setAddDate($today);
                $CartAnalytics->setBuyFlg(0);
            }
    
            $this->app['orm.em']->persist($CartAnalytics);
            $this->app['orm.em']->flush();
        }catch (\Exception $e) {
    
        }
    }

    public function downCartAnalytics(EventArgs $event)
    {
        try {
            $productClassId = $event->getArgument('productClassId');
            $quantity = 1;
    
            $cartAnalyticsRepository = $this->app['cart_analytics.repository.cart_analytics'];
    
            $session = $this->app['session'];
            if ($session->has(self::CART_ANALYTICS_SESSION_NAME)) {
                //セッションがある場合は二回目以降のアクセスなのでDBからデータ取得
                $cartAnalyticsId = $session->get(self::CART_ANALYTICS_SESSION_NAME);
                $CartAnalytics = $cartAnalyticsRepository->findOneBy(array(
                        'cart_analytics_id' => $cartAnalyticsId,
                        'product_class_id' => $productClassId)
                );
                if (is_null($CartAnalytics)) {
                    //データが無い場合は何もせず
                    return;
                } else {
                    if ($CartAnalytics->getQuantity() > 0) {
                        $ProductClass = $this->app['eccube.repository.product_class']->find($productClassId);
                        $CartAnalytics->setQuantity($CartAnalytics->getQuantity() - $quantity);
                        $CartAnalytics->setPrice($CartAnalytics->getQuantity() * $ProductClass->getPrice02());
                    }
                }
            } else {
                //セッション切れの場合は何もせず
                return;
            }
    
            $this->app['orm.em']->persist($CartAnalytics);
            $this->app['orm.em']->flush();
        }catch (\Exception $e) {
    
        }
    }

    public function removeCartAnalytics(EventArgs $event)
    {
        try {
            $productClassId = $event->getArgument('productClassId');
    
            $cartAnalyticsRepository = $this->app['cart_analytics.repository.cart_analytics'];
    
            $session = $this->app['session'];
            if ($session->has(self::CART_ANALYTICS_SESSION_NAME)) {
                //セッションがある場合は二回目以降のアクセスなのでDBからデータ取得
                $cartAnalyticsId = $session->get(self::CART_ANALYTICS_SESSION_NAME);
                $CartAnalytics = $cartAnalyticsRepository->findOneBy(array(
                        'cart_analytics_id' => $cartAnalyticsId,
                        'product_class_id' => $productClassId)
                );
                if (is_null($CartAnalytics)) {
                    //データが無い場合は何もせず
                    return;
                }
            } else {
                //セッション切れの場合は何もせず
                return;
            }
    
            $this->app['orm.em']->remove($CartAnalytics);
            $this->app['orm.em']->flush();
        }catch (\Exception $e) {
    
        }
    }
    */

    public function buyCartAnalytics(EventArgs $event)
    {
        try {
            $cartAnalyticsRepository = $this->app['cart_analytics.repository.cart_analytics'];
    
            $session = $this->app['session'];
            if ($session->has(self::CART_ANALYTICS_SESSION_NAME)) {
                //セッションがある場合は二回目以降のアクセスなのでDBからデータ取得
                $cartAnalyticsId = $session->get(self::CART_ANALYTICS_SESSION_NAME);
                $CartAnalyticsList = $cartAnalyticsRepository->findBy(array(
                        'cart_analytics_id' => $cartAnalyticsId)
                );
                if (count($CartAnalyticsList) === 0) {
                    //データが無い場合は何もせず
                    return;
                }
                $session->remove(self::CART_ANALYTICS_SESSION_NAME);
            } else {
                //セッション切れの場合は何もせず
                return;
            }
    
            foreach ($CartAnalyticsList as $CartAnalytics)
            {
                $CartAnalytics->setBuyFlg(1);
            }
            $this->app['orm.em']->flush();
        }catch (\Exception $e) {
            $this->app->log($e);
        }
    }
}
