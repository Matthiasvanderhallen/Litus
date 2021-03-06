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
 
namespace CudiBundle\Entity\Sales;

use CommonBundle\Entity\Users\Person,
	CudiBundle\Entity\Article,
	CudiBundle\Entity\Sales\BookingStatus,
	Doctrine\ORM\EntityManager;

/**
 * @Entity(repositoryClass="CudiBundle\Repository\Sales\Booking")
 * @Table(name="cudi.sales_booking")
 */
class Booking
{
	/**
	 * @var integer The ID of the booking
	 *
	 * @Id
	 * @GeneratedValue
	 * @Column(type="bigint")
	 */
	private $id;
	
	/**
	 * @var \CommonBundle\Entity\Users\Person The person of this booking
	 *
	 * @ManyToOne(targetEntity="CommonBundle\Entity\Users\Person")
	 * @JoinColumn(name="person_id", referencedColumnName="id")
	 */
	private $person;
	
	/**
	 * @var \CudiBundle\Entity\Article The booked article
	 *
	 * @ManyToOne(targetEntity="CudiBundle\Entity\Article")
	 * @JoinColumn(name="article_id", referencedColumnName="id")
	 */
	private $article;
	
	/**
	 * @var integer The number of articles booked
	 *
	 * @Column(type="smallint")
	 */
	private $number;
	
	/**
	 * @var string The status of this booking
	 *
	 * @Column(type="string", length=50)
	 */
	private $status;
	
	/**
	 * @var \DateTime The time this booking will expire
	 *
	 * @Column(type="datetime", nullable=true)
	 */
	private $expirationDate;
	
	/**
	 * @var \DateTime The time this booking was assigned
	 *
	 * @Column(type="datetime", nullable=true)
	 */
	private $assignmentDate;
	
	/**
	 * @var \DateTime The time this booking was made
	 *
	 * @Column(type="datetime")
	 */
	private $bookDate;
	
	/**
	 * @var \DateTime The time this booking was sold
	 *
	 * @Column(type="datetime", nullable=true)
	 */
	private $saleDate;
	
	/**
	 * @var \DateTime The time this booking was canceled
	 *
	 * @Column(type="datetime", nullable=true)
	 */
	private $cancelationDate;
	
	/**
	 * @var array The possible states of a booking
	 */
	private static $POSSIBLE_STATUSES = array(
		'booked', 'assigned', 'sold', 'expired', 'canceled'
	);
	
	/**
	 * @param \Doctrine\ORM\EntityManager $entityManager
	 * @param \CommonBundle\Entity\Users\Person $person
	 * @param \CudiBundle\Entity\Article $article
	 * @param string $status
	 * @param integer $number
	 */
	public function __construct(EntityManager $entityManager, Person $person, Article $article, $status, $number = 1)
	{
		if (!$article->isBookable())
			throw new \InvalidArgumentException('The Stock Article cannot be booked.');
		
		$this->person = $person;
		$this->setArticle($article);
		$this->number = $number;
		$this->setStatus($status);
		$this->bookDate = new \DateTime();
		
		if ($article->canExpire()) {
			$expireTime = $entityManager
	            ->getRepository('CommonBundle\Entity\General\Config')
	            ->getConfigValue('cudi.reservation_expire_time');
	
			$now = new \DateTime();
			$this->expirationDate = $now->add(new \DateInterval($expireTime));
			
		}
	}
	
	/**
	 * @return boolean
	 */
	public static function isValidBookingStatus($status)
	{
		return in_array($status, self::$POSSIBLE_STATUSES);
	}
	
	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @return \CommonBundle\Entity\Users\Person
	 */
	public function getPerson()
	{
		return $this->person;
	}
	
	/**
	 * @return \CudiBundle\Entity\Article
	 */
	public function getArticle()
	{
		return $this->article;
	}
	
	/**
	 * @param \CudiBundle\Entity\Article $article The new article of this booking
	 * 
	 * @return \CudiBundle\Entity\Sales\Booking
	 */
	public function setArticle($article)
	{
		$this->article = $article;
		return $this;
	}
	
	/**
	 * @return integer
	 */
	public function getNumber()
	{
		return $this->number;
	}
	
	/**
	 * @param integer $number
	 * 
	 * @return \CudiBundle\Entity\Sales\Booking
	 */
	public function setNumber($number)
	{
		$this->number = $number;
		return $this;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getBookDate()
	{
		return $this->bookDate;
	}
	
	/**
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getExpirationDate()
	{
		return $this->expirationDate;
	}
	
	/**
	 * @param string $status The new status of this booking.
	 *
	 * @return \CudiBundle\Entity\Sales\Booking
	 */
	public function setStatus($status)
	{
		if (!self::isValidBookingStatus($status))
			throw new \InvalidArgumentException('The BookingStatus is not valid.');
		
		if ($status == 'booked') {
		    $this->bookDate = new \DateTime();
		    $this->assignmentDate = null;
		    $this->saleDate = null;
		    $this->cancelationDate = null;
		} elseif ($status == 'assigned') {
			$this->assignmentDate = new \DateTime();
			$this->saleDate = null;
			$this->cancelationDate = null;
		} elseif ($status == 'sold') {
			$this->saleDate = new \DateTime();
			$this->cancelationDate = null;
		} elseif ($status == 'expired') {
		    $this->saleDate = null;
		    $this->cancelationDate = null;
		} elseif ($status == 'canceled') {
		    $this->saleDate = null;
		    $this->cancelationDate = new \DateTime();
		}
		
		$this->status = $status;
		return $this;
	}
	
	/**
	 * @return boolean
	 */
	public function isExpired()
	{
		return $this->expirationDate < new \DateTime();
	}
}
