<?php

namespace DoctrineProxy\__CG__\Plugin\ProductOption\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Option extends \Plugin\ProductOption\Entity\Option implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'optionCategories', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'id', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'name', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'manage_name', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'description', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'Type', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'pricedisp_flg', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'description_flg', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'is_required', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'rank', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'del_flg', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'create_date', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'update_date', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'OptionCategories', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'ProductOptions', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'Creator', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'defaultCategory', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'disableCategory');
        }

        return array('__isInitialized__', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'optionCategories', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'id', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'name', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'manage_name', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'description', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'Type', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'pricedisp_flg', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'description_flg', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'is_required', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'rank', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'del_flg', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'create_date', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'update_date', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'OptionCategories', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'ProductOptions', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'Creator', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'defaultCategory', '' . "\0" . 'Plugin\\ProductOption\\Entity\\Option' . "\0" . 'disableCategory');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Option $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function getOptionCategoriesSelect()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOptionCategoriesSelect', array());

        return parent::getOptionCategoriesSelect();
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDefaultCategory', array());

        return parent::getDefaultCategory();
    }

    /**
     * {@inheritDoc}
     */
    public function getDisableCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDisableCategory', array());

        return parent::getDisableCategory();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', array($name));

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', array());

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function setManageName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setManageName', array($name));

        return parent::setManageName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getManageName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getManageName', array());

        return parent::getManageName();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescription', array($description));

        return parent::setDescription($description);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescription', array());

        return parent::getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreateDate($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreateDate', array($date));

        return parent::setCreateDate($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreateDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreateDate', array());

        return parent::getCreateDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdateDate($date)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdateDate', array($date));

        return parent::setUpdateDate($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdateDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdateDate', array());

        return parent::getUpdateDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setRank($rank)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRank', array($rank));

        return parent::setRank($rank);
    }

    /**
     * {@inheritDoc}
     */
    public function getRank()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRank', array());

        return parent::getRank();
    }

    /**
     * {@inheritDoc}
     */
    public function setDelFlg($delFlg)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDelFlg', array($delFlg));

        return parent::setDelFlg($delFlg);
    }

    /**
     * {@inheritDoc}
     */
    public function getDelFlg()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDelFlg', array());

        return parent::getDelFlg();
    }

    /**
     * {@inheritDoc}
     */
    public function setType(\Plugin\ProductOption\Entity\Master\Type $type = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setType', array($type));

        return parent::setType($type);
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getType', array());

        return parent::getType();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescriptionFlg($flg)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescriptionFlg', array($flg));

        return parent::setDescriptionFlg($flg);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescriptionFlg()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescriptionFlg', array());

        return parent::getDescriptionFlg();
    }

    /**
     * {@inheritDoc}
     */
    public function setPricedispFlg($flg)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPricedispFlg', array($flg));

        return parent::setPricedispFlg($flg);
    }

    /**
     * {@inheritDoc}
     */
    public function getPricedispFlg()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPricedispFlg', array());

        return parent::getPricedispFlg();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsRequired($flg)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsRequired', array($flg));

        return parent::setIsRequired($flg);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsRequired()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsRequired', array());

        return parent::getIsRequired();
    }

    /**
     * {@inheritDoc}
     */
    public function addOptionCategory(\Plugin\ProductOption\Entity\OptionCategory $optionCategories)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addOptionCategory', array($optionCategories));

        return parent::addOptionCategory($optionCategories);
    }

    /**
     * {@inheritDoc}
     */
    public function removeOptionCategory(\Plugin\ProductOption\Entity\OptionCategory $optionCategories)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeOptionCategory', array($optionCategories));

        return parent::removeOptionCategory($optionCategories);
    }

    /**
     * {@inheritDoc}
     */
    public function getOptionCategories()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOptionCategories', array());

        return parent::getOptionCategories();
    }

    /**
     * {@inheritDoc}
     */
    public function addProductOption(\Plugin\ProductOption\Entity\ProductOption $productOptions)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addProductOption', array($productOptions));

        return parent::addProductOption($productOptions);
    }

    /**
     * {@inheritDoc}
     */
    public function removeProductOption(\Plugin\ProductOption\Entity\ProductOption $productOptions)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeProductOption', array($productOptions));

        return parent::removeProductOption($productOptions);
    }

    /**
     * {@inheritDoc}
     */
    public function getProductOptions()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProductOptions', array());

        return parent::getProductOptions();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreator(\Eccube\Entity\Member $creator)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreator', array($creator));

        return parent::setCreator($creator);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreator()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreator', array());

        return parent::getCreator();
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'offsetExists', array($offset));

        return parent::offsetExists($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'offsetSet', array($offset, $value));

        return parent::offsetSet($offset, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'offsetGet', array($offset));

        return parent::offsetGet($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'offsetUnset', array($offset));

        return parent::offsetUnset($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function setPropertiesFromArray(array $arrProps, array $excludeAttribute = array (
), \ReflectionClass $parentClass = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPropertiesFromArray', array($arrProps, $excludeAttribute, $parentClass));

        return parent::setPropertiesFromArray($arrProps, $excludeAttribute, $parentClass);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(array $excludeAttribute = array (
), \ReflectionClass $parentClass = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toArray', array($excludeAttribute, $parentClass));

        return parent::toArray($excludeAttribute, $parentClass);
    }

    /**
     * {@inheritDoc}
     */
    public function copyProperties($srcObject, array $excludeAttribute = array (
))
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'copyProperties', array($srcObject, $excludeAttribute));

        return parent::copyProperties($srcObject, $excludeAttribute);
    }

}