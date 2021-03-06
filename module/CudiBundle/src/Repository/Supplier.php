<?php

namespace CudiBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Supplier
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Supplier extends EntityRepository
{
	public function findAll()
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('s')
			->from('CudiBundle\Entity\Supplier', 's')
			->orderBy('s.name', 'ASC')
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
}