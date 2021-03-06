<?php

namespace CalendarBundle\Repository\Nodes;

use Doctrine\ORM\EntityRepository;

/**
 * Event
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Event extends EntityRepository
{
    public function findAllActive()
    {
        $query = $this->_em->createQueryBuilder();
        $resultSet = $query->select('e')
        	->from('CalendarBundle\Entity\Nodes\Event', 'e')
        	->where(
        	    $query->expr()->gt('e.endDate', ':now')
        	)
        	->orderBy('e.startDate', 'ASC')
        	->setParameter('now', new \DateTime())
        	->getQuery()
        	->getResult();
        
        return $resultSet;
    }
}