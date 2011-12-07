<?php

namespace Litus\Repository\Cudi\Stock;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

use \Zend\Mail\Mail;

/**
 * StockItem
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StockItem extends EntityRepository
{
	public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
	{
		if (sizeof($criteria) == 0) {
			$query = $this->_em->createQueryBuilder();
			return $query->select('i')
				->from('Litus\Entity\Cudi\Stock\StockItem', 'i')
				->innerJoin('i.article', 'a', Join::WITH, $query->expr()->eq('a.removed', 'false'))
				->getQuery()
				->getResult();
			
		}
		return parent::findBy($criteria, $orderBy, $limit, $offset);
	}
	
	public function findOneByBarcode($barcode)
    {
        $article = $this->getEntityManager()
			->getRepository('Litus\Entity\Cudi\Articles\StockArticles\External')
			->findOneByBarcode($barcode);
		if (null == $article) {
			$article = $this->getEntityManager()
				->getRepository('Litus\Entity\Cudi\Articles\StockArticles\Internal')
				->findOneByBarcode($barcode);
		}
		
        return $article;
    }

	public function findAllInStock()
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('i')
			->from('Litus\Entity\Cudi\Stock\StockItem', 'i')
			->where($query->expr()->gt('i.numberInStock', 0))
			->getQuery()
			->getResult();
			
		return $resultSet;
	}

	public function findAllByArticleTitle($title)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('i')
			->from('Litus\Entity\Cudi\Stock\StockItem', 'i')
			->innerJoin('i.article', 'a', Join::WITH, $query->expr()->andX(
					$query->expr()->like($query->expr()->lower('a.title'), ':title'),
					$query->expr()->eq('a.removed', 'false')
				)
			)
			->setParameter('title', '%'.strtolower($title).'%')
			->orderBy('a.title', 'ASC')
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
	
	public function findAllByArticleBarcode($barcode)
	{
		$query = $this->_em->createQueryBuilder();
		$internal = $query->select('a.id')
			->from('Litus\Entity\Cudi\Articles\StockArticles\Internal', 'a')
			->where($query->expr()->andX(
					$query->expr()->like($query->expr()->concat('a.barcode', '\'\''), ':barcode'),
					$query->expr()->eq('a.removed', 'false')
				)
			)
			->setParameter('barcode', $barcode.'%')
			->getQuery()
			->getResult();
			
		$query = $this->_em->createQueryBuilder();
		$external = $query->select('a.id')
			->from('Litus\Entity\Cudi\Articles\StockArticles\External', 'a')
			->where($query->expr()->andX(
					$query->expr()->like($query->expr()->concat('a.barcode', '\'\''), ':barcode'),
					$query->expr()->eq('a.removed', 'false')
				)
			)
			->setParameter('barcode', $barcode.'%')
			->getQuery()
			->getResult();
			
		$ids = array();
		foreach($external as $article)
			$ids[] = $article['id'];
		foreach($internal as $article)
			$ids[] = $article['id'];

		if (sizeof($ids) === 0)
			return array();

		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('i')
			->from('Litus\Entity\Cudi\Stock\StockItem', 'i')
			->innerJoin('i.article', 'a')
			->where($query->expr()->in('a.id', $ids))
			->orderBy('a.title', 'ASC')
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
	
	public function findAllByArticleSupplier($supplier)
	{
		$query = $this->_em->createQueryBuilder();
		$internal = $query->select('a.id')
			->from('Litus\Entity\Cudi\Articles\StockArticles\Internal', 'a')
			->innerJoin('a.supplier', 's', Join::WITH, $query->expr()->like($query->expr()->lower('s.name'), ':supplier'))
			->where($query->expr()->eq('a.removed', 'false'))
			->setParameter('supplier', '%'.strtolower($supplier).'%')
			->getQuery()
			->getResult();
			
		$query = $this->_em->createQueryBuilder();
		$external = $query->select('a.id')
			->from('Litus\Entity\Cudi\Articles\StockArticles\External', 'a')
			->innerJoin('a.supplier', 's', Join::WITH, $query->expr()->like($query->expr()->lower('s.name'), ':supplier'))
			->where($query->expr()->eq('a.removed', 'false'))
			->setParameter('supplier', '%'.strtolower($supplier).'%')
			->getQuery()
			->getResult();
			
		$ids = array();
		foreach($external as $article)
			$ids[] = $article['id'];
		foreach($internal as $article)
			$ids[] = $article['id'];

		if (sizeof($ids) === 0)
			return array();

		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('i')
			->from('Litus\Entity\Cudi\Stock\StockItem', 'i')
			->innerJoin('i.article', 'a')
			->where($query->expr()->in('a.id', $ids))
			->orderBy('a.title', 'ASC')
			->getQuery()
			->getResult();
			
		return $resultSet;
	}

	public function assignAll()
	{
		$this->getEntityManager()
			->getRepository('Litus\Entity\Cudi\Sales\Booking')
			->expireBookings();
		$this->getEntityManager()->flush();
	
		$items = $this->getEntityManager()
			->getRepository('Litus\Entity\Cudi\Stock\StockItem')
			->findAllInStock();
		$counter = 0;
		
		$persons = array();
		
		foreach($items as $item) {
			$bookings = $this->getEntityManager()
				->getRepository('Litus\Entity\Cudi\Sales\Booking')
				->findAllBookedByArticle($item->getArticle(), 'ASC');
			
			$now = new \DateTime();
			foreach($bookings as $booking) {
				if ($item->getNumberAvailable() <= 0)
					break;
				
				if ($item->getNumberAvailable() < $booking->getNumber())
					continue;
				
				$counter++;
				$booking->setStatus('assigned');
				
				if (!isset($persons[$booking->getPerson()->getId()]))
					$persons[$booking->getPerson()->getId()] = array('person' => $booking->getPerson(), 'bookings' => array());
				
				$persons[$booking->getPerson()->getId()]['bookings'][] = $booking;
			}
		}
		
		$email = $this->_em
			->getRepository('Litus\Entity\General\Config')
			->getConfigValue('cudi.booking_assigned_mail');
			
		$subject = $this->_em
			->getRepository('Litus\Entity\General\Config')
			->getConfigValue('cudi.booking_assigned_mail_subject');
			
		$mailaddress = $this->_em
			->getRepository('Litus\Entity\General\Config')
			->getConfigValue('cudi.mail');
			
		$mailname = $this->_em
			->getRepository('Litus\Entity\General\Config')
			->getConfigValue('cudi.mail_name');
		
		foreach($persons as $person) {
			$bookings = '';
			foreach($person['bookings'] as $booking)
				$bookings .= '* ' . $booking->getArticle()->getTitle() . "\r\n";
		
			$mail = new Mail();
			$mail->setBodyText(str_replace('{{bookings}}', $bookings, $email))
				->setFrom($mailaddress, $mailname)
				->addTo($person['person']->getEmail(), $person['person']->getFullName())
				->setSubject($subject)
				->send();
		}
		
		return $counter;
	}
}