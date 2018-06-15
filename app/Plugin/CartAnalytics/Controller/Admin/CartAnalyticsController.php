<?php
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2015 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */


namespace Plugin\CartAnalytics\Controller\Admin;

use Eccube\Application;
use Eccube\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CartAnalyticsController extends AbstractController
{
    
    Const DATE_FORMAT = 'Y-m-d';
    
    public function index(Application $app, Request $request)
    {
        $from = new \DateTime();
        $from->modify('-6 Day');
        $to = new \DateTime();
        $analyticsList = array();
        $dateList = array();
        
        $isValid = true;
        
        $searchForm = $app['form.factory']
            ->createBuilder('admin_search_cart_analytics')->getForm();

        if ('POST' === $request->getMethod()) {
            $searchForm->handleRequest($request);
            if ($searchForm->isValid()) {
                $searchData = $searchForm->getData();
                $fromDate = $searchData['add_date_from'];
                $toDate = $searchData['add_date_to'];
                if ($fromDate != null) {
                    $from = clone $fromDate;
                }
                if ($toDate != null) {
                    $to = clone $toDate;
                }
            } else {
                $isValid = false;
            }
        }

        if ($isValid) {
            //表示用に日付一覧を作成
            $day = clone $from;
            $dateList[] = $day->format(self::DATE_FORMAT);
            while ($day->format(self::DATE_FORMAT) != $to->format(self::DATE_FORMAT)) {
                $day->modify('+1 Day');
                $dateList[] = $day->format(self::DATE_FORMAT);
            }

            //期間が長過ぎたらエラー
            if (count($dateList) > 31) {
                $app->addError('admin.cart_analytics.search.error.date', 'admin');
            } else {
                $analyticsList = $app['cart_analytics.repository.cart_analytics']
                    ->selectAnalyticsData($app, $from, $to, self::DATE_FORMAT);
            }
        }

        return $app->render('CartAnalytics/Resource/template/admin/cart_analytics_list.twig', array(
            'analyticsList' => $analyticsList,
            'dateList' => $dateList,
            'searchForm' => $searchForm->createView(),
        ));
    }
    
    public function report(Application $app, Request $request)
    {
        return $app->render('CartAnalytics/Resource/template/admin/cart_analytics_report.twig');
    }

    public function recover(Application $app, Request $request)
    {
        return $app->render('CartAnalytics/Resource/template/admin/cart_analytics_recover.twig');
    }
}
