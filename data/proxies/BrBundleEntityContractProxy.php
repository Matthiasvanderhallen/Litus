<?php

namespace MistDoctrine\Proxy;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class BrBundleEntityContractProxy extends \BrBundle\Entity\Contract implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function getDate()
    {
        $this->__load();
        return parent::getDate();
    }

    public function setDate()
    {
        $this->__load();
        return parent::setDate();
    }

    public function getAuthor()
    {
        $this->__load();
        return parent::getAuthor();
    }

    public function setAuthor(\CommonBundle\Entity\Users\Person $author)
    {
        $this->__load();
        return parent::setAuthor($author);
    }

    public function getCompany()
    {
        $this->__load();
        return parent::getCompany();
    }

    public function setCompany(\BrBundle\Entity\Company $company)
    {
        $this->__load();
        return parent::setCompany($company);
    }

    public function getComposition()
    {
        $this->__load();
        return parent::getComposition();
    }

    public function resetComposition()
    {
        $this->__load();
        return parent::resetComposition();
    }

    public function addSection(\BrBundle\Entity\Contracts\Section $section, $position)
    {
        $this->__load();
        return parent::addSection($section, $position);
    }

    public function addSections(array $sections)
    {
        $this->__load();
        return parent::addSections($sections);
    }

    public function setDiscount($discount)
    {
        $this->__load();
        return parent::setDiscount($discount);
    }

    public function getDiscount()
    {
        $this->__load();
        return parent::getDiscount();
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

    public function isDirty()
    {
        $this->__load();
        return parent::isDirty();
    }

    public function setDirty($dirty = true)
    {
        $this->__load();
        return parent::setDirty($dirty);
    }

    public function isSigned()
    {
        $this->__load();
        return parent::isSigned();
    }

    public function getInvoiceNb()
    {
        $this->__load();
        return parent::getInvoiceNb();
    }

    public function setInvoiceNb($invoiceNb = -1)
    {
        $this->__load();
        return parent::setInvoiceNb($invoiceNb);
    }

    public function getContractNb()
    {
        $this->__load();
        return parent::getContractNb();
    }

    public function setContractNb($contractNb)
    {
        $this->__load();
        return parent::setContractNb($contractNb);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'date', 'discount', 'title', 'invoiceNb', 'contractNb', 'dirty', 'author', 'company', 'composition');
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