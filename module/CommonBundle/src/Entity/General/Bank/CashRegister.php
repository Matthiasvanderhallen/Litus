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
 
namespace CommonBundle\Entity\General\Bank;

use CommonBundle\Entity\General\Bank\BankDevice,
	CommonBundle\Entity\General\Bank\MoneyUnit;

/**
 * A class that is used to store the contents of a counted register
 *
 * @Entity(repositoryClass="CommonBundle\Repository\General\Bank\CashRegister")
 * @Table(name="general.bank_cash_register")
 */
class CashRegister
{
    /**
     * @var string This register's ID
     *
     * @Id
     * @GeneratedValue
     * @Column(type="bigint")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection The amounts of each money unit
     *
	 * @OneToMany(
	 *		targetEntity="CommonBundle\Entity\General\Bank\MoneyUnit\Amount", mappedBy="cashRegister", cascade={"remove"}
	 * )
	 */
	private $moneyUnitAmounts;
	
	/**
     * @var \Doctrine\Common\Collections\ArrayCollection The amounts of each bank device
     *
	 * @OneToMany(
	 *		targetEntity="CommonBundle\Entity\General\Bank\BankDevice\Amount", mappedBy="cashRegister", cascade={"remove"}
	 * )
	 */
	private $bankDeviceAmounts;
	
	/**
	 * @return integer
	 */
    public function getId()
	{
        return $this->id;
    }

	/**
	 * @return array
	 */
	public function getMoneyUnitAmounts()
	{
		return $this->moneyUnitAmounts->toArray();
	}

  	/**
	 * @return array
	 */
	public function getBankDeviceAmounts()
	{
		return $this->bankDeviceAmounts->toArray();
	}

	/**
	 * Get the register's total amount.
	 *
	 * @return int
	 */
	public function getTotalAmount()
    {
        $amount = 0;

		foreach($this->bankDeviceAmounts as $device)
			$amount += $device->getAmount();
		
		foreach($this->moneyUnitAmounts as $number)
			$amount += $number->getAmount() * $number->getUnit()->getUnit();
		
		return $amount;
    }

	/**
	 * Get the amount object for a unit.
	 *
	 * @param \CommonBundle\Entity\General\Bank\MoneyUnit $unit The unit for which we want to get the amount
	 * @return \CommonBundle\Entity\General\Bank\MoneyUnit\Amount
	 */
	public function getAmountForUnit(MoneyUnit $unit)
	{
		foreach($this->moneyUnitAmounts as $amount) {
			if ($amount->getUnit() == $unit)
				return $amount;
		}
	}
	
	/**
	 * Get amount object for a bank device.
	 *
	 * @param \CommonBundle\Entity\General\Bank\BankDevice $device The device for which we want to get the amount
	 * @return \CommonBundle\Entity\General\Bank\BankDevice\Amount
	 */
	public function getAmountForDevice(BankDevice $device)
	{
		foreach($this->bankDeviceAmounts as $amount) {
			if ($amount->getDevice() == $device)
				return $amount;
		}
	}
}
