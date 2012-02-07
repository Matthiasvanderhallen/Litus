<?php

namespace Litus\Entity\Br\Contract;

use \Litus\Entity\Users\Person;
use \Litus\Util\AcademicYear;

use \Zend\Registry;
use \Litus\Application\Resource\Doctrine as DoctrineResource;

/**
 * A section represents a part of a Contract.
 *
 * @Entity(repositoryClass="Litus\Repository\Br\Contracts\Section")
 * @Table(name="br.contract_section")
 */
class Section
{
    const VAT_CONFIG_PREFIX = 'br.invoice.vat';

    /**
     * @var int A generated ID
     *
     * @Id
     * @Column(type="bigint")
     * @GeneratedValue
     */
    private $id;

    /**
     * @var string The name of this section
     *
     * @Column(type="string", unique=true)
     */
    private $name;

    /**
     * @var string The content of this section
     *
     * @Column(type="text")
     */
    private $content;

    /**
     * @var \Litus\Entity\Users\Person The author of this section
     *
     * @ManyToOne(targetEntity="Litus\Entity\Users\Person")
     * @JoinColumn(name="author", referencedColumnName="id")
     */
    private $author;

    /**
     * @var string The academic year in which this section was written
     *
     * @Column(type="string", length=9)
     */
    private $year;

    /**
     * @var int The price (VAT excluded!) a company has to pay when they agree to this section of the contract.
     *
     * @Column(type="integer")
     */
    private $price;

    /**
     * @var string The VAT type (example: in Belgium: 6%, 12%, 21% ...). The values are 'A','B' ... A value is valid if the configuration entry 'br.invoice.vat.<value>' exists.
     *
     * @Column(name="vat_type", type="string", length=1)
     */
    private $vatType;

    /**
     * @var string The short description of this Section shown in invoices
     *
     * @Column(name="invoice_description", type="string", nullable=true)
     */
    private $invoiceDescription;

    /**
     * @param string $name The name of this section
     * @param string $content The content of this section
     * @param \Litus\Entity\Users\Person $author The author of this section
     * @param int $price
     * @param string $vatType see setVatType($vatType)
     * @return \Litus\Entity\Br\Contracts\Section
     *
     */
    public function __construct($name, $content, Person $author, $price, $vatType)
    {
        $this->name = $name;
        $this->content = $content;
        $this->author = $author;
        $this->price = $price;
        $this->setVatType($vatType);

        $this->setInvoiceDescription();

        $this->year = AcademicYear::getAcademicYear();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name The name of this section
     * @return \Litus\Entity\Br\Contracts\Section
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \Litus\Entity\Users\Person
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param \Litus\Entity\Users\Person $author The author of this section
     * @return \Litus\Entity\Br\Contracts\Section
     */
    public function setAuthor(Person $author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content The content of this section
     * @return \Litus\Entity\Br\Contracts\Section
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param string $vatType The VAT type (example: in Belgium: 6%, 12%, 21% ...). The values are 'A', 'B'...
     *                        A value is valid if the configuration entry 'br.invoice.vat.<value>' exists.
     * @throws \InvalidArgumentException
     * @return \Litus\Entity\Br\Contracts\Section
     */
    public function setVatType($vatType)
    {
        try {
            Registry::get(DoctrineResource::REGISTRY_KEY)
            	->getRepository('Litus\Entity\General\Config')
                ->getConfigValue(self::VAT_CONFIG_PREFIX . '.' . $vatType);
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException($vatType . ' is not a valid VAT type.');
        }
        $this->vatType = $vatType;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getVatType()
    {
        return $this->vatType;
    }

    /**
     * @return int the percentage VAT to be paid
     */
    public function getVat()
    {
        return intval(
			Registry::get(DoctrineResource::REGISTRY_KEY)
            	->getRepository('Litus\Entity\General\Config')
                ->getConfigValue(self::VAT_CONFIG_PREFIX . '.' . $this->getVatType())
		);
    }

    /**
     * @param int $price
     * @return \Litus\Entity\Br\Contracts\Section
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getInvoiceDescription()
    {
        return $this->invoiceDescription;
    }

    /**
     * @param string|null $description
     * @return \Litus\Entity\Br\Contracts\Section
     */
    public function setInvoiceDescription($description = null)
    {
        $this->invoiceDescription = $description;
        return $this;
    }
}