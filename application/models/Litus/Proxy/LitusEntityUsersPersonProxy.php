<?php

namespace Litus\Proxy;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class LitusEntityUsersPersonProxy extends \Litus\Entity\Users\Person implements \Doctrine\ORM\Proxy\Proxy
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
        $this->__load();
        return parent::getId();
    }

    public function setUsername($username)
    {
        $this->__load();
        return parent::setUsername($username);
    }

    public function getUsername()
    {
        $this->__load();
        return parent::getUsername();
    }

    public function setCredential(\Litus\Entity\Users\Credential $credential)
    {
        $this->__load();
        return parent::setCredential($credential);
    }

    public function getCredential()
    {
        $this->__load();
        return parent::getCredential();
    }

    public function validateCredential($credential)
    {
        $this->__load();
        return parent::validateCredential($credential);
    }

    public function getRoles()
    {
        $this->__load();
        return parent::getRoles();
    }

    public function addRoles(array $roles)
    {
        $this->__load();
        return parent::addRoles($roles);
    }

    public function updateRoles(array $roles)
    {
        $this->__load();
        return parent::updateRoles($roles);
    }

    public function setFirstName($firstName)
    {
        $this->__load();
        return parent::setFirstName($firstName);
    }

    public function getFirstName()
    {
        $this->__load();
        return parent::getFirstName();
    }

    public function setLastName($lastName)
    {
        $this->__load();
        return parent::setLastName($lastName);
    }

    public function getLastName()
    {
        $this->__load();
        return parent::getLastName();
    }

    public function getFullName()
    {
        $this->__load();
        return parent::getFullName();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function setAddress($address)
    {
        $this->__load();
        return parent::setAddress($address);
    }

    public function getAddress()
    {
        $this->__load();
        return parent::getAddress();
    }

    public function setTelephone($telephone)
    {
        $this->__load();
        return parent::setTelephone($telephone);
    }

    public function getTelephone()
    {
        $this->__load();
        return parent::getTelephone();
    }

    public function setSex($sex)
    {
        $this->__load();
        return parent::setSex($sex);
    }

    public function getSex()
    {
        $this->__load();
        return parent::getSex();
    }

    public function canLogin()
    {
        $this->__load();
        return parent::canLogin();
    }

    public function disableLogin()
    {
        $this->__load();
        return parent::disableLogin();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'username', 'credential', 'roles', 'firstName', 'lastName', 'email', 'address', 'telephone', 'sex', 'canLogin');
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