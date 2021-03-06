<?php

namespace CudiBundle\Repository\Sales;

use CommonBundle\Entity\Users\Person,
	CudiBundle\Entity\Article,
	Doctrine\ORM\EntityRepository,
	Doctrine\ORM\Query\Expr\Join;

/**
 * Booking
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Booking extends EntityRepository
{
	public function findAll()
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('b')
			->from('CudiBundle\Entity\Sales\Booking', 'b')
			->orderBy('b.bookDate', 'DESC')
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
	
	public function findAllActive()
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('b')
			->from('CudiBundle\Entity\Sales\Booking', 'b')
			->where(
			    $query->expr()->orX(
			        $query->expr()->eq('b.status', '\'booked\''),
			        $query->expr()->eq('b.status', '\'assigned\'')
			    )
			)
			->orderBy('b.bookDate', 'DESC')
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
	
	public function findAllInactive()
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('b')
			->from('CudiBundle\Entity\Sales\Booking', 'b')
			->where(
			    $query->expr()->not(
    			    $query->expr()->orX(
    			        $query->expr()->eq('b.status', '\'booked\''),
    			        $query->expr()->eq('b.status', '\'assigned\'')
    			    )
    			)
			)
			->orderBy('b.bookDate', 'DESC')
			->getQuery()
			->getResult();
			
		return $resultSet;
	}

	public function findAllBooked($order = 'DESC')
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('b')
			->from('CudiBundle\Entity\Sales\Booking', 'b')
			->where($query->expr()->eq('b.status', '\'booked\''))
			->orderBy('b.bookDate', $order)
			->getQuery()
			->getResult();
			
		return $resultSet;
	}

	public function findAllBookedByArticle(Article $article, $order = 'DESC')
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('b')
			->from('CudiBundle\Entity\Sales\Booking', 'b')
			->where($query->expr()->andX(
					$query->expr()->eq('b.article', ':article'),
					$query->expr()->eq('b.status', '\'booked\'')
				)
			)
			->orderBy('b.bookDate', $order)
			->setParameter('article', $article->getId())
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
	
	public function expireBookings()
	{
		$bookings = $this->getEntityManager()
			->getRepository('CudiBundle\Entity\Sales\Booking')
			->findAllBooked();
		
		foreach($bookings as $booking) {
			if ($booking->isExpired())
				$booking->setStatus('expired');
		}
	}
	
	public function findAllByPerson(Person $person)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('b')
			->from('CudiBundle\Entity\Sales\Booking', 'b')
			->where($query->expr()->eq('b.person', ':person'))
			->setParameter(':person', $person->getId())
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
	
	public function findAllAssignedByPerson(Person $person)
	{
    	$query = $this->_em->createQueryBuilder();
    	$resultSet = $query->select('b')
    		->from('CudiBundle\Entity\Sales\Booking', 'b')
    		->where($query->expr()->andX(
    				$query->expr()->eq('b.person', ':person'),
    				$query->expr()->eq('b.status', '\'assigned\'')
    			))
    		->setParameter(':person', $person->getId())
    		->getQuery()
    		->getResult();
    		
    	return $resultSet;
	}
	
	public function findAllOpenByPerson(Person $person)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('b')
			->from('CudiBundle\Entity\Sales\Booking', 'b')
			->where($query->expr()->andX(
					$query->expr()->eq('b.person', ':person'),
					$query->expr()->neq('b.status', '\'sold\''),
					$query->expr()->neq('b.status', '\'expired\'')
				)
			)
			->setParameter(':person', $person->getId())
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
	
	public function findAllByPersonName($name, $active)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('b')
			->from('CudiBundle\Entity\Sales\Booking', 'b')
			->innerJoin('b.person', 'p', Join::WITH, $query->expr()->orX(
					$query->expr()->like(
						$query->expr()->concat(
							$query->expr()->lower($query->expr()->concat('p.firstName', "' '")),
							$query->expr()->lower('p.lastName')
						),
						':name'
					),
					$query->expr()->like(
						$query->expr()->concat(
							$query->expr()->lower($query->expr()->concat('p.lastName', "' '")),
							$query->expr()->lower('p.firstName')
						),
						':name'
					)
				))
			->where(
			    $active ? $query->expr()->orX(
			        $query->expr()->eq('b.status', '\'booked\''),
			        $query->expr()->eq('b.status', '\'assigned\'')
			    ) : $query->expr()->not(
    			    $query->expr()->orX(
    			        $query->expr()->eq('b.status', '\'booked\''),
    			        $query->expr()->eq('b.status', '\'assigned\'')
    			    )
    			)
			)
			->setParameter('name', '%'.strtolower($name).'%')
			->orderBy('b.bookDate', 'DESC')
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
	
	public function findAllByArticle($title, $active)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('b')
			->from('CudiBundle\Entity\Sales\Booking', 'b')
			->innerJoin('b.article', 'a', Join::WITH, $query->expr()->like($query->expr()->lower('a.title'), ':title'))
			->setParameter('title', '%'.strtolower($title).'%')
			->where(
			    $active ? $query->expr()->orX(
			        $query->expr()->eq('b.status', '\'booked\''),
			        $query->expr()->eq('b.status', '\'assigned\'')
			    ) : $query->expr()->not(
				    $query->expr()->orX(
				        $query->expr()->eq('b.status', '\'booked\''),
				        $query->expr()->eq('b.status', '\'assigned\'')
				    )
				)
			)
			->orderBy('b.bookDate', 'DESC')
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
	
	public function findAllByStatus($status, $active)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('b')
			->from('CudiBundle\Entity\Sales\Booking', 'b')
			->where(
			    $query->expr()->andX(
    			    $query->expr()->like($query->expr()->lower('b.status'), ':status'),
			        $active ? $query->expr()->orX(
			            $query->expr()->eq('b.status', '\'booked\''),
			            $query->expr()->eq('b.status', '\'assigned\'')
			        ) : $query->expr()->not(
			    	    $query->expr()->orX(
			    	        $query->expr()->eq('b.status', '\'booked\''),
			    	        $query->expr()->eq('b.status', '\'assigned\'')
			    	    )
			    	)
			    )
			)
			->setParameter('status', '%'.strtolower($status).'%')
			->orderBy('b.bookDate', 'DESC')
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
	
	public function findOneSoldByPersonAndArticle(Person $person, Article $article)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('b')
			->from('CudiBundle\Entity\Sales\Booking', 'b')
			->where($query->expr()->andX(
					$query->expr()->eq('b.person', ':person'),
					$query->expr()->eq('b.article', ':article'),
					$query->expr()->eq('b.status', '\'sold\'')
				)
			)
			->setParameter('person', $person->getId())
			->setParameter('article', $article->getId())
			->setMaxResults(1)
			->getQuery()
			->getResult();
		
		if (isset($resultSet[0]))
			return $resultSet[0];
		
		return null;
	}
}