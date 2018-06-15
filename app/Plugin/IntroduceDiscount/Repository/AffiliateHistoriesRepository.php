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

namespace Plugin\IntroduceDiscount\Repository;

use Doctrine\ORM\EntityRepository;
use Eccube\Entity\Customer;

class AffiliateHistoriesRepository extends EntityRepository
{

	/**
	 * 検索条件(customer)での検索を行う。
	 * s
	 * @param Customer $customer
	 * @return \Doctrine\ORM\QueryBuilder
	 */
	public function getListByIntroduceCustomerIdAndMeetCustomer($introduceCustomerID, Customer $meetCustomer)
	{

		$qb = $this->createQueryBuilder('c')
			->select('c')
			->andWhere('c.introduce_customer_id = :introduceCustomerID')
			->andWhere('c.meet_customer_id = :meetCustomerID')
			->setParameter('introduceCustomerID', $introduceCustomerID)
			->setParameter('meetCustomerID', $meetCustomer->getId())
			->addOrderBy('c.create_date', 'ASC');

		return $qb->getQuery()->getResult();
	}
}