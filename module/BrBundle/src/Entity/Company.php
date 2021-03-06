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
 
namespace BrBundle\Entity;

use BrBundle\Entity\Users\People\Corporate,
	Doctrine\Common\Collections\ArrayCollection;

/**
 * This is the entity for a company.
 *
 * @Entity(repositoryClass="BrBundle\Repository\Company")
 * @Table(name="br.companies")
 */
class Company
{
	/**
	 * @var string The company's ID
	 *
	 * @Id
	 * @Column(type="bigint")
	 * @GeneratedValue
	 */
	private $id;
	
	/**
	 * @var string The company's name
	 *
	 * @Column(type="string", length=50)
	 */
	private $name;
	
	/**
	 * @var string The company's VAT number
	 *
	 * @Column(type="string", length=14)
	 */
	private $vatNumber;
	
	/**
	 * @var bool Whether or not this is an active company
	 *
	 * @Column(type="boolean")
	 */
	private $active;
	
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection The company's contacts
	 *
	 * @ManyToMany(targetEntity="BrBundle\Entity\Users\People\Corporate", cascade={"persist"})
	 * @JoinTable(name="br.companies_contacts",
	 *      joinColumns={@JoinColumn(name="company_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@JoinColumn(name="contact_id", referencedColumnName="id", unique=true)}
	 * )
	 */
	private $contacts;
	
	/**
	 * @param string $name The company's name
	 * @param string $vatNumber The company's VAT number
	 * @param array $contacts The company's contacts
	 */
	public function __construct($name, $vatNumber, array $contacts)
	{
		$this->setName($name);
		$this->setVatNumber($vatNumber);
		
		$this->active = true;
		
		$this->contacts = new ArrayCollection(
			$contacts
		);
	}
	
	/**
	 * @return string
	 */
	public function getId()
	{
	    return $this->id;
	}
	
	/**
	 * @param string $name
	 * @return \BrBundle\Entity\Company
	 */
	public function setName($name)
	{
		if ((null === $name) || !is_string($name))
			throw new \InvalidArgumentException('Invalid name');
			
		$this->name = $name;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
	    return $this->name;
	}
	
	/**
	 * @param string $vatNumber
	 * @return \BrBundle\Entity\Company
	 */
	public function setVatNumber($vatNumber)
	{
		if ((null === $vatNumber) || !is_string($vatNumber))
			throw new \InvalidArgumentException('Invalid VAT number');
			
	    $this->vatNumber = $vatNumber;
	    
	    return $this;
	}
	
	/**
	 * @return string
	 */
	public function getVatNumber()
	{
	    return $this->vatNumber;
	}
	
	/**
	 * @return bool
	 */
	public function getActive()
	{
		return $this->active;
	}
	
	/**
	 * Deactivates the given company.
	 *
	 * @return \BrBundle\Entity\Company
	 */
	public function deactivate()
	{
		$this->active = false;
		
		return $this;		
	}
	
	/**
	 * @return array
	 */
	public function getContacts()
	{
	    return $this->contacts->toArray();
	}
	
	/**
	 * @param array $contact The contacts that should be added
	 * @return \BrBundle\Entity\Company
	 * @throws \InvalidArugmentException
	 */
	public function addContact(Corporate $contact)
	{	
	    if ((null === $contact) || $this->contacts->contains($contact))
	    	throw new \InvalidArgumentException('Invalid contact');
	    	
	    $this->contacts->add($contact);	
	    	
	    return $this;
	}
}
