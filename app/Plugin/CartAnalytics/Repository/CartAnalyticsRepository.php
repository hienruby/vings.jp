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

namespace Plugin\CartAnalytics\Repository;

use Doctrine\ORM\EntityRepository;
use Plugin\CartAnalytics\Entity\CartAnalytics;

class CartAnalyticsRepository extends EntityRepository
{
    public function selectAnalyticsData(\Eccube\Application $app, \DateTime $from, \DateTime $to, $dateFormat)
    {
        $analyticsList = array();

        $qb = $this->createQueryBuilder('ca')
            ->select('SUM(ca.price) as price, ca.buy_flg, ca.add_date')
            ->where('ca.add_date >= :from')->setParameter('from', $from)
            ->andWhere('ca.add_date <= :to')->setParameter('to', $to)
            ->groupBy('ca.buy_flg, ca.add_date')
            ->orderBy('ca.add_date', 'ASC');
        $resultPrice = $qb->getQuery()->getResult();

        if (count($resultPrice) > 0) {
            $qb = $this->createQueryBuilder('ca')
                ->select('ca.cart_analytics_id, ca.buy_flg, ca.add_date')
                ->where('ca.add_date >= :from')->setParameter('from', $from)
                ->andWhere('ca.add_date <= :to')->setParameter('to', $to)
                ->groupBy('ca.cart_analytics_id, ca.buy_flg, ca.add_date');
            $resultCount = $qb->getQuery()->getResult();

            $countList = array();
            //日付ごとの人数を集計
            foreach ($resultCount as $res) {
                $date = $res['add_date']->format($dateFormat);
                if (array_key_exists($date, $countList)) {
                    $countList[$date][$res['buy_flg']]++;
                } else {
                    $countList[$date][$res['buy_flg']] = 1;
                    $countList[$date][$res['buy_flg'] === 1 ? 0 : 1] = 0;
                }
            }

            foreach ($resultPrice as $res) {
                $date = $res['add_date']->format($dateFormat);
                $analyticsList[$date][$res['buy_flg']]['price'] = $res['price'];
                $analyticsList[$date][$res['buy_flg']]['count'] = $countList[$date][$res['buy_flg']];
            }
        }
        return $analyticsList;
    }
}