<?php

namespace Litus\Entity\Br\Contracts;

/**
 * @Entity(repositoryClass="Litus\Repository\Br\Contracts\ContractComposition")
 * @Table(
 *      name="br.contract_composition",
 *      uniqueConstraints={
 *          @UniqueConstraint(name="contract_order_unique", columns={"contract", "order_no"}),
 *          @UniqueConstraint(name="contract_section_unique", columns={"contract", "section"})
 *      }
 * )
 */
class ContractComposition {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     *
     * @var int
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Litus\Entity\Br\Contracts\Contract", cascade={"all"}, fetch="EAGER", inversedBy="parts")
     * @JoinColumn(name="contract", referencedColumnName="id", onDelete="CASCADE", nullable="false")
     *
     * @var \Litus\Entity\Br\Contracts\Contract
     */
    private $contract;

    /**
     * @ManyToOne(targetEntity="Litus\Entity\Br\Contracts\Section", fetch="EAGER")
     * @JoinColumn(name="section", referencedColumnName="name", onDelete="CASCADE", nullable="false")
     *
     * @var \Litus\Entity\Br\Contracts\Section
     */
    private $section;

    /**
     * @Column(name="order_no", type="integer", nullable="false")
     *
     * @var int
     */
    private $order;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Contract
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * @throws \Exception
     * @param Contract $contract
     * @return void
     */
    public function setContract(Contract $contract)
    {
        if($contract === null)
            throw new \InvalidArgumentException('Contract cannot be null');
        $this->contract = $contract;
    }

    /**
     * @return Section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @throws \InvalidArgumentException if $section is null
     * @param Section $section
     * @return void
     */
    public function setSection(Section $section)
    {
        if($section === null)
            throw new \InvalidArgumentException('Contract cannot be null');
        $this->section = $section;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Sets the order to the given value.
     *
     * @throws \InvalidArgumentException If $order is not a positive integer
     * @param $order int
     * @return void
     */
    public function setOrder($order)
    {
        if(!is_numeric($order) || ($order <= 0))
            throw new \InvalidArgumentException("Order must be a positive number");
        $this->order = round($order);
    }

}