<?php
/*
 * This file is part of the PostCarrier
 *
 * Copyright(c) 2016 IPLOGIC CO.,LTD. All Rights Reserved.
 * http://www.iplogic.co.jp
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\PostCarrier\Entity;

class PostCarrierGroupCustomer extends \Eccube\Entity\AbstractEntity
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $group_id;

    /**
     * @var text
     */
    private $email;

    /**
     * @var text
     */
    private $memo01 = "";

    /**
     * @var text
     */
    private $memo02 = "";

    /**
     * @var text
     */
    private $memo03 = "";

    /**
     * @var text
     */
    private $memo04 = "";

    /**
     * @var text
     */
    private $memo05 = "";

    /**
     * @var text
     */
    private $memo06 = "";

    /**
     * @var text
     */
    private $memo07 = "";

    /**
     * @var text
     */
    private $memo08 = "";

    /**
     * @var text
     */
    private $memo09 = "";

    /**
     * @var text
     */
    private $memo10 = "";

    /**
     * @var integer
     */
    private $status = 2; // XXX 何とかならんの?

    /**
     * @var text
     */
    private $secret_key;

    /**
     * @var \DateTime
     */
    private $create_date;

    /**
     * @var \DateTime
     */
    private $update_date;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Set template id
     *
     * @param  integer $id
     * @return PostCarrierTemplate
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get template_id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set customer id
     *
     * @param  string $id
     * @return MailmagaCustomer
     */
    public function setGroupId($groupId)
    {
        $this->group_id = $groupId;

        return $this;
    }

    /**
     * Get group_name
     *
     * @return integer
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * Set template email
     *
     * @param  integer $email
     * @return PostCarrierTemplate
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get template_email
     *
     * @return integer
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set memo01
     *
     * @param  integer $memo01
     * @return PostCarrierTemplate
     */
    public function setMemo01($memo01)
    {
        $this->memo01 = $memo01;

        return $this;
    }

    /**
     * Get template_memo01
     *
     * @return integer
     */
    public function getMemo01()
    {
        return $this->memo01;
    }

    /**
     * Set status
     *
     * @param  integer $status
     * @return Payment
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set secretKey
     *
     * @param  integer $secretKey
     * @return PostCarrierTemplate
     */
    public function setSecretKey($secretKey)
    {
        $this->secret_key = $secretKey;

        return $this;
    }

    /**
     * Get template_secretKey
     *
     * @return integer
     */
    public function getSecretKey()
    {
        return $this->secret_key;
    }

    /**
     * Set create_date
     *
     * @param  \DateTime $createDate
     * @return Payment
     */
    public function setCreateDate($createDate)
    {
        $this->create_date = $createDate;

        return $this;
    }

    /**
     * Get create_date
     *
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * Set update_date
     *
     * @param  \DateTime $updateDate
     * @return Payment
     */
    public function setUpdateDate($updateDate)
    {
        $this->update_date = $updateDate;

        return $this;
    }

    /**
     * Get update_date
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }

}
