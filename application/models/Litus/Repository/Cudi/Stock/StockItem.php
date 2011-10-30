<?php

namespace Litus\Repository\Cudi\Stock;

use Doctrine\ORM\EntityRepository;

/**
 * StockItem
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StockItem extends EntityRepository
{
	public function findAll()
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('s')
			->from('Litus\Entity\Cudi\Stock\StockItem', 's')
			->innerJoin('s.article', 'a')
			->orderBy('a.title', 'ASC')
			->getQuery()
			->getResult();

        return $resultSet;
	}
}