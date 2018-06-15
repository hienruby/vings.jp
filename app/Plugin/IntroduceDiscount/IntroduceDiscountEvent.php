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

namespace Plugin\IntroduceDiscount;

use Eccube\Entity\Customer;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Validator\Tests\Fixtures\Entity;
use Plugin\IntroduceDiscount\Entity\AffiliateDiscountTickets;
use Plugin\IntroduceDiscount\Entity\AffiliateHistories;

class IntroduceDiscountEvent
{
    /**
     * @var \Eccube\Application
     */
    private $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    // =========================================================
    // shopping - renderのEvent
    // =========================================================
    /**
     * [shopping/index]表示の時のEvent Fock.
     * 紹介割引券関連項目を追加する
     *
     * @param FilterResponseEvent $event
     */
    public function onRenderShoppingBefore(FilterResponseEvent $event)
    {
        $app = &$this->app;
        $request = $event->getRequest();
        $response = $event->getResponse();

        // Formに紹介割引券関連情報を追加する
        // 紹介割引券関連項目を追加する
        $response->setContent($this->getShopHtml($request, $response));
        $event->setResponse($response);
    }

    // =========================================================
    // shopping ConfirmのEvent
    // =========================================================
    public function onControllerShoppingConfirmBefore()
    {
        $app = &$this->app;
        $form = $this->app['form.factory']->createBuilder()
            ->add('ticket_used', 'hidden', array(
                'required' => false,
                'trim' => true,
            ))->getForm();
        $form->handleRequest($this->app['request']);
        $data = $form->getData();

        $introduceCustomerID = null;
        $meetCustomerID = null;

        $nowDate = new \DateTime();

        $isHistoryInsert = false;
        $isCommit = false;
        $em = $this->app['orm.em'];

        // 受注データを取得
        $Order = $this->getOrder();


        if (array_key_exists('ticket_used', $data)){
            $ticketId = $data["ticket_used"];
            $ticket = $this->app['eccube.plugin.introduce_discount.repository.affiliate_discount_tickets']->find($ticketId);
            $ticket->setUsedOrderId($Order->getId());
            $ticket->setUsedDate($nowDate);
            $em->persist($ticket);

            $introduceCustomerID = $this->app->user()->getId();

            $isHistoryInsert= true;
            $isCommit = true;
        } else if ($this->hasMeet()) {
            $introduceCustomerID = $this->getCustomerIdBySecretKey($this->getIntroduceAffiliateID());
            $meetCustomerID = $this->app->user() !== "anon." ? $this->app->user()->getId() : null;

            if ($introduceCustomerID != null) {
                // affiliate_discount_tickets作成
                $newTicket = new AffiliateDiscountTickets();

                $newTicket->setCustomerId($introduceCustomerID);
                $newTicket->setDelFlg("0");
                $newTicket->setCreateDate($nowDate);
                $em->persist($newTicket);

            }
            // クッキーを削除

            $delTime = time()- 1800;
            setcookie("IntroduceAffiliateID", "", $delTime, "/", $this->app['request']->getHttpHost(), false, true);
            setcookie("IntroduceProductID", "", $delTime, "/", $this->app['request']->getHttpHost(), false, true);

            $isHistoryInsert= true;
            $isCommit = true;
        }

        if ($isHistoryInsert) {
            if ($introduceCustomerID != null) {
                $newHistory = new AffiliateHistories();
                $newHistory->setIntroduceCustomerId($introduceCustomerID);
                $newHistory->setMeetCustomerId($meetCustomerID);
                $newHistory->setOrderId($Order->getId());
                $newHistory->setCreateDate($nowDate);
                $newHistory->setConversionDate($nowDate);
                $em->persist($newHistory);

                $isCommit = true;
            }
        }

        if ($isCommit){
            $em->flush();
        }
    }


    // =========================================================
    // クラス内メソッド
    // =========================================================

    private function getShopHtml($request, $response) {
        // HTMLを取得し、DOM化
        $crawler = new Crawler($response->getContent());

        $html = $this->getHtml($crawler);

        // Formの値を取得する
        $form = $this->getShoppingForm();
        $data = $form->getData();

        // 受注データを取得
        $Order = $this->getOrder();
        if(is_null($Order)) {
            return $html;
        }

        $afsetting = $this->app['eccube.plugin.introduce_discount.repository.affiliate_settings']->find(1);
        if (is_null($afsetting)) {
            return $html;
        }
        $formAffiliate = $this->getShoppingForm(false);

        try {
            if ($this->app->user() !== "anon.") {
                // 割引券を取得
                $tickets = $this->app['eccube.plugin.introduce_discount.repository.affiliate_discount_tickets']->getListByCustomer($this->app->user());

                $ticketCount = count($tickets);

                $isUseTicket = array_key_exists('ticket_use', $data);

                if (0 < $ticketCount) {
                    $ticketCount = $isUseTicket ? $ticketCount - 1 : $ticketCount;

                    if ($isUseTicket) {
                        $formAffiliate = $this->app['form.factory']->createBuilder()
                            ->add('ticket_used', 'hidden', array(
                                'required' => false,
                                'trim' => true,
                            ))->getForm();
                        $formAffiliate['ticket_used']->setData($tickets[0]->getId());
                    }


                    $parts = $this->app->renderView('IntroduceDiscount/View/shop/shopping_item.twig',
                        array(
                            'percent' => $afsetting->getIntroduceConversionDiscountRate(),
                            'rest_ticket' => $ticketCount,
                            'used_ticket' => ($isUseTicket ? "1" : "0"),
                            'form' => $formAffiliate->createView()));

                    // このタグを前後に分割し、間に項目を入れ込む
                    $form = html_entity_decode($crawler->filter('#confirm_main')->last()->html(), ENT_NOQUOTES, 'UTF-8');
                    $pos = strrpos($form, '<h2 class="heading02">');


                    if ($pos !== false) {
                        $beforeForm = substr($form, 0, $pos);
                        $afterForm = substr($form, $pos);
                        $newForm = $beforeForm . html_entity_decode($parts, ENT_NOQUOTES, 'UTF-8') . $afterForm;
                        $html = str_replace($form, $newForm, $html);
                    }

                }
            }

            $isMeet = $this->hasMeet();

            if ($isMeet || $isUseTicket) {

                // 招待者または割引券を使った場合

                // ----------------------------------
                // 値引き項目追加 / 合計金額上書き
                // ----------------------------------
                $discountPrice = 0;
                if ($isMeet) {
                    $discountTargetPrice = 0;

                    foreach ($Order->getOrderDetails() as $detail) {
                        if($detail->getProduct()->getId() === $this->getIntroduceProductId()){
                            $discountTargetPrice = (int)$detail->getPrice();
                            break;
                        }
                    }

                    $rate = $afsetting->getMeetConversionDiscountRate();


                } else {
                    $discountTargetPrice = 0;

                    foreach ($Order->getOrderDetails() as $detail) {
                        if ($discountTargetPrice < (int)$detail->getPrice()) {
                            $discountTargetPrice = (int)$detail->getPrice();
                        }
                    }
                    $rate = $afsetting->getIntroduceConversionDiscountRate();
                }
                $discountPrice = $discountTargetPrice * ($rate / 100);
                // 註文に対して割引適応
                $beforeOrderTotal = number_format($Order->getTotal());
                $Order->setDiscount($discountPrice * -1);
                $Order->setTotal($Order->getTotal() + ($Order->getDiscount()));
                $Order->setPaymentTotal($Order->getTotal());

                $this->app['orm.em']->flush();
                // このタグを前後に分割し、間に項目を入れ込む
                // 元の合計金額は書き込み済みのため再度書き込みを行う
                $parts = $this->app->renderView('IntroduceDiscount/View/shop/discount_shopping_item.twig',
                    array(
                        'discountTitle' => ($isMeet ? "招待" : "紹介/割引券"),
                        'Order' => $Order,
                        'form' => $formAffiliate->createView()
                    ));
                $form = html_entity_decode($crawler->filter('#confirm_side .total_box')->first()->html(), ENT_NOQUOTES, 'UTF-8');

                $pos = strpos($form, '</dl>');
                if ($pos !== false) {
                    $beforeForm = substr($form, 0, $pos);
                    $afterForm = substr($form, $pos);
                    $newForm = $beforeForm . $parts . $afterForm;
                    $html = str_replace($form, $newForm, $html);
                }

                $textTotal = html_entity_decode($crawler->filter('#confirm_side .total_price .text-primary')->first()->html(), ENT_NOQUOTES, 'UTF-8');
                $repTotalForm = str_replace($beforeOrderTotal, number_format($Order->getTotal()), $textTotal);
                $html = str_replace($textTotal, $repTotalForm, $html);
            }

        } catch (\InvalidArgumentException $e) {
            // no-op
        }

        return $html;
    }


    public function onRenderProductDetailBefore(FilterResponseEvent $event)
    {
        $request = $event->getRequest();
        $customer = $this->app->user();
        if ($request->query->has('aid')) {
            // 現在のユーザが作成したAIDじゃないかどうかの確認
            if ($this->getEnvAdID($customer)!==$request->query->get('aid')) {

                // 30日有効なクッキーを発行
                $limitTime = time()+60*60*24*30;
                setcookie("IntroduceAffiliateID", $request->query->get('aid'), $limitTime, "/", $request->getHttpHost(), false, true);
                setcookie("IntroduceProductID", $request->attributes->get('id'), $limitTime, "/", $request->getHttpHost(), false, true);

            }

        }

        if ($customer !== "anon.") {

            // IDから情報を取得する
            $afsetting = $this->app['eccube.plugin.introduce_discount.repository.affiliate_settings']->find(1);
            if (!is_null($afsetting)) {
                $response = $event->getResponse();

                // DomCrawlerにHTMLを食わせる
                $crawler = new Crawler($response->getContent());

                $twig = $this->app->renderView(
                    'IntroduceDiscount/View/shop/url.twig',
                    array(
                        "url" => "http://".$request->getHttpHost().$request->getRequestUri()."?aid=".$this->getEnvAdID($customer),
                        "point1" => $afsetting->getIntroduceConversionDiscountRate(),
                        "point2" => $afsetting->getMeetConversionDiscountRate(),
                            )
                );

                $oldCrawler = $crawler
                    ->filter('.btn_area')
                    ->last();

                $oldHtml = '';
                $newHtml = '';
                if (count($oldCrawler) > 0) {
                    $oldHtml = $oldCrawler->html();
                    $newHtml = $oldHtml.$twig;
                }


                $html = str_replace($oldHtml, $newHtml, $this->getHtml($crawler));

                $response->setContent($html);
                $event->setResponse($response);

            }
        }
    }

    public function onRenderMyPageHistoryBefore(FilterResponseEvent $event){
        $app = &$this->app;
        $request = $event->getRequest();
        $response = $event->getResponse();

        if ($request->attributes->has("id")) {
            $orderId = $request->attributes->get("id");
            $Order = $app['eccube.repository.order']->findOneBy(array(
                'id' => $orderId,
                'Customer' => $app->user(),
            ));
            if (0 > $Order->getDiscount()){
                // HTMLを取得し、DOM化
                $crawler = new Crawler($response->getContent());

                $html = $this->getHtml($crawler);

                $parts = $this->app->renderView('IntroduceDiscount/View/shop/discount_shopping_item.twig',
                    array(
                        'discountTitle' => "割引",
                        'Order' => $Order
                    ));

                $form = html_entity_decode($crawler->filter('#confirm_side .total_box')->first()->html(), ENT_NOQUOTES, 'UTF-8');
                $pos = strpos($form, '</dl>');
                if ($pos !== false) {
                    $beforeForm = substr($form, 0, $pos);
                    $afterForm = substr($form, $pos);
                    $newForm = $beforeForm . $parts . $afterForm;
                    $html = str_replace($form, $newForm, $html);
                }
                $response->setContent($html);
                $event->setResponse($response);
            }
        }
    }



    /**
     * 解析用HTMLを取得
     *
     * @param Crawler $crawler
     * @return string
     */
    private function getHtml(Crawler $crawler)
    {
        $html = '';
        foreach ($crawler as $domElement) {
            $domElement->ownerDocument->formatOutput = true;
            $html .= $domElement->ownerDocument->saveHTML();
        }
        return html_entity_decode($html, ENT_NOQUOTES, 'UTF-8');
    }

    private function getEnvAdID($customer) {
        if ($customer !== "anon.") {
            return str_rot13(substr($customer->getSecretKey(),0,4).substr($customer->getSecretKey(),-4));
        }
        return "";
    }

    private function getCustomerIdBySecretKey($aid)
    {
        if ($aid === null) {
            return null;
        }
        $qb = $this->app['eccube.repository.customer']->createQueryBuilder('c')
            ->select('c')
            ->andWhere('c.del_flg = 0');

        $qb->andWhere(' c.secret_key LIKE :secretKey ')
            ->setParameter('secretKey', str_rot13(substr($aid, 0, 4)) . '%' . str_rot13(substr($aid, -4)));

        $qb->setMaxResults(1);


        $customers = $qb->getQuery()->getResult();

        if (0 < count($customers)) {
            return $customers[0]->getId();
        }
        return null;
    }

    private function hasMeet() {
        $introduceCustomerID = $this->getCustomerIdBySecretKey($this->getIntroduceAffiliateID());
        if ($introduceCustomerID != null){
            if ($this->app->user() !== "anon.") {
                $historyList =
                    $this->app['eccube.plugin.introduce_discount.repository.affiliate_histories']
                        ->getListByIntroduceCustomerIdAndMeetCustomer($introduceCustomerID, $this->app->user());

                if (0 < count($historyList)) {
                    return false;
                }
            } else {
                return true;
            }
        }

        return $introduceCustomerID != null && $this->getIntroduceAffiliateID() !== $this->getEnvAdID($this->app->user());
    }

    private function getIntroduceAffiliateID(){

        if (!isset($_COOKIE["IntroduceAffiliateID"])){
            return null;
        }

        return htmlspecialchars($_COOKIE["IntroduceAffiliateID"]);
    }

    private function getIntroduceProductId(){

        if (!isset($_COOKIE["IntroduceProductID"])){
            return null;
        }
        return (int)htmlspecialchars($_COOKIE["IntroduceProductID"]);
    }

    /**
     * Formを取得する
     * @param boolean $handleRequest
     */
    private function getShoppingForm($handleRequest = true) {
        $form = $this->app['form.factory']->createBuilder()
            ->add('ticket_use', 'hidden', array(
                'required' => false,
                'trim' => true,
            ))->getForm();

        if($handleRequest) {
            $form->handleRequest($this->app['request']);
        }
        return $form;

    }

    /**
     * 受注データを取得
     */
    private function getOrder() {
        // 受注データを取得
        $orderService = $this->app['eccube.service.order'];
        $cartService = $this->app['eccube.service.cart'];

        $preOrderId = $cartService->getPreOrderId();
        $Order = $this->app['eccube.repository.order']->findOneBy(array(
            'pre_order_id' => $preOrderId,
            'OrderStatus' => $this->app['config']['order_processing']
        ));

        return $Order;
    }

}
