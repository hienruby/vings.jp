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

namespace Plugin\IntroduceDiscount\Entity;


class AffiliateSettings extends \Eccube\Entity\AbstractEntity
{
    private $id;

    private $introduce_conversion_discount_rate;

    private $meet_conversion_discount_rate;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getIntroduceConversionDiscountRate()
    {
        return $this->introduce_conversion_discount_rate;
    }

    public function setIntroduceConversionDiscountRate($discountRate)
    {
        $this->introduce_conversion_discount_rate = $discountRate;

        return $this;
    }
    public function getMeetConversionDiscountRate()
    {
        return $this->meet_conversion_discount_rate;
    }

    public function setMeetConversionDiscountRate($discountRate)
    {
        $this->meet_conversion_discount_rate = $discountRate;

        return $this;
    }
}
