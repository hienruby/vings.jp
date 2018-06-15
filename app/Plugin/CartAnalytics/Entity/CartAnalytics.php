<?php

namespace Plugin\CartAnalytics\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CartAnalytics
 */
class CartAnalytics extends \Eccube\Entity\AbstractEntity
{
    /**
     * @var string
     */
    private $cart_analytics_id;

    /**
     * @var integer
     */
    private $product_class_id;

    /**
     * @var integer
     */
    private $product_id;

    /**
     * @var string
     */
    private $quantity;

    /**
     * @var string
     */
    private $price;

    /**
     * @var integer
     */
    private $buy_flg = '0';

    /**
     * @var \DateTime
     */
    private $add_date;

    /**
     * @var \DateTime
     */
    private $create_date;

    /**
     * @var \DateTime
     */
    private $update_date;


    /**
     * Set cart_analytics_id
     *
     * @param string $cartAnalyticsId
     * @return CartAnalytics
     */
    public function setCartAnalyticsId($cartAnalyticsId)
    {
        $this->cart_analytics_id = $cartAnalyticsId;

        return $this;
    }

    /**
     * Get cart_analytics_id
     *
     * @return string 
     */
    public function getCartAnalyticsId()
    {
        return $this->cart_analytics_id;
    }

    /**
     * Set product_class_id
     *
     * @param integer $productClassId
     * @return CartAnalytics
     */
    public function setProductClassId($productClassId)
    {
        $this->product_class_id = $productClassId;

        return $this;
    }

    /**
     * Get product_class_id
     *
     * @return integer 
     */
    public function getProductClassId()
    {
        return $this->product_class_id;
    }

    /**
     * Set product_id
     *
     * @param integer $productId
     * @return CartAnalytics
     */
    public function setProductId($productId)
    {
        $this->product_id = $productId;

        return $this;
    }

    /**
     * Get product_id
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set quantity
     *
     * @param string $quantity
     * @return CartAnalytics
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return string 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return CartAnalytics
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set buy_flg
     *
     * @param integer $buyFlg
     * @return CartAnalytics
     */
    public function setBuyFlg($buyFlg)
    {
        $this->buy_flg = $buyFlg;

        return $this;
    }

    /**
     * Get buy_flg
     *
     * @return integer 
     */
    public function getBuyFlg()
    {
        return $this->buy_flg;
    }

    /**
     * Set add_date
     *
     * @param \DateTime $addDate
     * @return CartAnalytics
     */
    public function setAddDate($addDate)
    {
        $this->add_date = $addDate;

        return $this;
    }

    /**
     * Get add_date
     *
     * @return \DateTime 
     */
    public function getAddDate()
    {
        return $this->add_date;
    }

    /**
     * Set create_date
     *
     * @param \DateTime $createDate
     * @return CartAnalytics
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
     * @param \DateTime $updateDate
     * @return CartAnalytics
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
