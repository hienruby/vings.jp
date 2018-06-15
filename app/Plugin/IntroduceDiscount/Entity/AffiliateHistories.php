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


class AffiliateHistories extends \Eccube\Entity\AbstractEntity
{

    private $id;

    private $introduce_customer_id;

    private $meet_customer_id;

    private $order_id;

    private $create_date;

    private $conversion_date;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getIntroduceCustomerId()
    {
        return $this->introduce_customer_id;
    }

    public function setIntroduceCustomerId($id)
    {
        $this->introduce_customer_id = $id;

        return $this;
    }

    public function getMeetCustomerId()
    {
        return $this->meet_customer_id;
    }

    public function setMeetCustomerId($id)
    {
        $this->meet_customer_id = $id;

        return $this;
    }
    public function getOrderId()
    {
        return $this->order_id;
    }

    public function setOrderId($id)
    {
        $this->order_id = $id;

        return $this;
    }
    public function getCreateDate()
    {
        return $this->create_date;
    }

    public function setCreateDate($date)
    {
        $this->create_date = $date;

        return $this;
    }
    public function getConversionDate()
    {
        return $this->conversion_date;
    }

    public function setConversionDate($date)
    {
        $this->conversion_date = $date;

        return $this;
    }
}
