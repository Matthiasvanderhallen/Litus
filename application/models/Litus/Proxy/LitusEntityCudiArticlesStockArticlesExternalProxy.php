<?php

namespace Litus\Proxy;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class LitusEntityCudiArticlesStockArticlesExternalProxy extends \Litus\Entity\Cudi\Articles\StockArticles\External implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    
    public function isInternal()
    {
        $this->__load();
        return parent::isInternal();
    }

    public function getPurchasePrice()
    {
        $this->__load();
        return parent::getPurchasePrice();
    }

    public function setPurchasePrice($purchasePrice)
    {
        $this->__load();
        return parent::setPurchasePrice($purchasePrice);
    }

    public function getSellPrice()
    {
        $this->__load();
        return parent::getSellPrice();
    }

    public function setSellPrice($sellPrice)
    {
        $this->__load();
        return parent::setSellPrice($sellPrice);
    }

    public function getSellPriceMembers()
    {
        $this->__load();
        return parent::getSellPriceMembers();
    }

    public function setSellPriceMembers($sellPriceMembers)
    {
        $this->__load();
        return parent::setSellPriceMembers($sellPriceMembers);
    }

    public function getBarcode()
    {
        $this->__load();
        return parent::getBarcode();
    }

    public function setBarcode($barcode)
    {
        $this->__load();
        return parent::setBarcode($barcode);
    }

    public function getSupplier()
    {
        $this->__load();
        return parent::getSupplier();
    }

    public function setSupplier($supplier)
    {
        $this->__load();
        return parent::setSupplier($supplier);
    }

    public function canExpire()
    {
        $this->__load();
        return parent::canExpire();
    }

    public function setCanExpire($canExpire)
    {
        $this->__load();
        return parent::setCanExpire($canExpire);
    }

    public function isBookable()
    {
        $this->__load();
        return parent::isBookable();
    }

    public function setIsBookable($bookable)
    {
        $this->__load();
        return parent::setIsBookable($bookable);
    }

    public function isUnbookable()
    {
        $this->__load();
        return parent::isUnbookable();
    }

    public function setIsUnbookable($unbookable)
    {
        $this->__load();
        return parent::setIsUnbookable($unbookable);
    }

    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function getTitle()
    {
        $this->__load();
        return parent::getTitle();
    }

    public function setTitle($title)
    {
        $this->__load();
        return parent::setTitle($title);
    }

    public function getMetaInfo()
    {
        $this->__load();
        return parent::getMetaInfo();
    }

    public function getTimestamp()
    {
        $this->__load();
        return parent::getTimestamp();
    }

    public function setRemoved($removed)
    {
        $this->__load();
        return parent::setRemoved($removed);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'title', 'metaInfo', 'timestamp', 'removed', 'purchasePrice', 'sellPrice', 'sellPriceMembers', 'barcode', 'bookable', 'unbookable', 'supplier', 'canExpire');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}