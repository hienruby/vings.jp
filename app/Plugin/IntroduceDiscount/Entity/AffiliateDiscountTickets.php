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


class AffiliateDiscountTickets extends \Eccube\Entity\AbstractEntity
{

    private $id;

    private $customer_id;

    private $used_order_id;

    private $del_flg;

    private $create_date;

    private $used_date;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getCustomerId()
    {
        return $this->customer_id;
    }

    public function setCustomerId($id)
    {
        $this->customer_id = $id;

        return $this;
    }

    public function getUsedOrderId()
    {
        return $this->used_order_id;
    }

    public function setUsedOrderId($id)
    {
        $this->used_order_id = $id;

        return $this;
    }
    public function getDelFlg()
    {
        return $this->del_flg;
    }

    public function setDelFlg($flg)
    {
        $this->del_flg = $flg;

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
    public function getUsedDate()
    {
        return $this->used_date;
    }

    public function setUsedDate($date)
    {
        $this->used_date = $date;

        return $this;
    }
}
