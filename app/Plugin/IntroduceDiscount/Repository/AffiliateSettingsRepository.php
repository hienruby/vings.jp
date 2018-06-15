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
use Doctrine\ORM\Query;
use Plugin\IntroduceDiscount\Entity\AffiliateSettings;

class AffiliateSettingsRepository extends EntityRepository
{
	/**
	 * 情報を保存
	 */
	public function save()
	{

		$nowRows = $this->findAll();


		if (count($nowRows)===0) {
			// レコードがないときは作成
			$em = $this->getEntityManager();
			$affiliateSettings = new AffiliateSettings();
			$affiliateSettings
				->setIntroduceConversionDiscountRate(20)
				->setMeetConversionDiscountRate(20);
			$em->persist($affiliateSettings);
			$em->flush();
		}
	}


	/**
	 * find all
	 *
	 * @return type
	 */
	public function findAll()
	{
		$query = $this
			->getEntityManager()
			->createQuery('SELECT m FROM Plugin\IntroduceDiscount\Entity\AffiliateSettings m');

		return $query->getResult(Query::HYDRATE_ARRAY);
	}

}