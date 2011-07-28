<?php

namespace Litus\Entities\Br\Contracts;

/**
 * @Entity(repositoryClass="Litus\Repositories\Br\Contracts\ContractCompositionRepository")
 * @Table(name="br.contract_composition", uniqueConstraints={@UniqueConstraint(name="contract_order_unique", columns={"contract", "order_no"}), @UniqueConstraint(name="contract_section_unique", columns={"contract", "section"})})
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
     * @ManyToOne(targetEntity="Litus\Entities\Br\Contracts\Contract", cascade={"all"}, fetch="EAGER", inversedBy="parts")
     * @JoinColumn(name="contract", referencedColumnName="id", onDelete="CASCADE", nullable="false")
     *
     * @var \Litus\Entities\Br\Contracts\Contract
     */
    private $contract;

    /**
     * @ManyToOne(targetEntity="Litus\Entities\Br\Contracts\Section", fetch="EAGER")
     * @JoinColumn(name="section", referencedColumnName="name", onDelete="CASCADE", nullable="false")
     *
     * @var \Litus\Entities\Br\Contracts\Section
     */
    // ManyToOne without a corresponding OneToMany requires a JoinColumn
    private $section;

    /**
     * @Column(name="order_no", type="integer", nullable="false")
     *
     * @var int
     */
    // order is a reserved name in postgres
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
            throw new \Exception('Contract cannot be null');
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
     * @throws \Exception if $section is null
     * @param Section $section
     * @return void
     */
    public function setSection(Section $section)
    {
        if($section === null)
            throw new \Exception('Contract cannot be null.');
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
     * @throws \Exception if $order is not a positive integer
     * @param $order int
     * @return void
     */
    public function setOrder($order)
    {
        if(!is_numeric($order) || ($order <= 0))
            throw new \Exception("Order must be a positive number");
        $this->order = round($order);
    }

}
