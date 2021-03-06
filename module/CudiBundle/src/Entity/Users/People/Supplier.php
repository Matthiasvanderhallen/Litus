<?php
/**
 * Litus is a project by a group of students from the K.U.Leuven. The goal is to create
 * various applications to support the IT needs of student unions.
 *
 * @author Karsten Daemen <karsten.daemen@litus.cc>
 * @author Bram Gotink <bram.gotink@litus.cc>
 * @author Pieter Maene <pieter.maene@litus.cc>
 * @author Kristof Mariën <kristof.marien@litus.cc>
 * @author Michiel Staessen <michiel.staessen@litus.cc>
 * @author Alan Szepieniec <alan.szepieniec@litus.cc>
 *
 * @license http://litus.cc/LICENSE
 */
 
namespace CudiBundle\Entity\Users\People;

use CommonBundle\Entity\Users\Credential,
	CudiBundle\Entity\Supplier as SupplierEntity;

/**
 * This is the entity for an supplier person.
 *
 * @Entity(repositoryClass="CudiBundle\Repository\Users\People\Supplier")
 * @Table(name="users.supplier_people")
 */
class Supplier extends \CommonBundle\Entity\Users\Person
{
    /**
     * @var \CudiBundle\Entity\Supplier The supplier associated with this person
     *
     * @ManyToOne(targetEntity="CudiBundle\Entity\Supplier")
     * @JoinColumn(name="supplier", referencedColumnName="id")
     */
    private $supplier;

    /**
     * @param string $username The user's username
     * @param \CommonBundle\Entity\Users\Credential $credential The user's credential
     * @param array $roles The user's roles
     * @param string $firstName The user's first name
     * @param string $lastName The user's last name
     * @param string $email The user's e-mail address
     * @param string $phoneNumber The user's phone number
     * @param $sex string The users sex
     */
    public function __construct($username, Credential $credential, array $roles, $firstName, $lastName, $email, $phoneNumber, $sex, SupplierEntity $supplier)
    {
        parent::__construct($username, $credential, $roles, $firstName, $lastName, $email, $phoneNumber, $sex);
        
        $this->supplier = $supplier;
    }
    
    /**
     * @return \CudiBundle\Entity\Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }
    
    /**
     * @param \CudiBundle\Entity\Supplier $supplier
     *
     * @return \CudiBundle\Entity\Users\People\Supplier
     */
    public function setSupplier($supplier)
    {
        $this->supplier = $supplier;
        return $this;
    }
}
