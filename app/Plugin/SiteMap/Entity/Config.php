<?php
/*
* Plugin Name : SiteMap
*
* Copyright (C) BraTech Co., Ltd. All Rights Reserved.
* http://www.bratech.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\SiteMap\Entity;

use Doctrine\ORM\Mapping as ORM;

class Config extends \Eccube\Entity\AbstractEntity
{
    private $id;

    private $changefreq;

    private $priority;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setChangefreq($changefreq)
    {
        $this->changefreq = $changefreq;

        return $this;
    }

    public function getChangefreq()
    {
        return $this->changefreq;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority()
    {
        return $this->priority;
    }
}
