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

namespace Plugin\GSFeed\Entity;

use Doctrine\ORM\Mapping as ORM;

class Config extends \Eccube\Entity\AbstractEntity
{
    private $id;

    private $brand;

    private $gcategory;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setGCategory($gcategory)
    {
        $this->gcategory = $gcategory;

        return $this;
    }

    public function getGCategory()
    {
        return $this->gcategory;
    }
}
