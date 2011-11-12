<?php

namespace Litus\Repository\Cudi\Stock;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * DeliveryItem
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DeliveryItem extends EntityRepository
{
	public function getTotalByArticle($article)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('i')
			->from('Litus\Entity\Cudi\Stock\DeliveryItem', 'i')
			->where($query->expr()->eq('i.article', ':article'))
			->setParameter('article', $article->getId())
			->getQuery()
			->getResult();
			
		$total = 0;
		foreach($resultSet as $item)
			$total += $item->getNumber();
			
		return $total;
	}
	
	public function findLastNb($number)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('i')
			->from('Litus\Entity\Cudi\Stock\DeliveryItem', 'i')
			->orderBy('i.date', 'DESC')
			->setMaxResults($number)
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
	
	public function findAllBySupplier($supplier)
	{
		$query = $this->_em->createQueryBuilder();
		$internal = $query->select('a.id')
			->from('Litus\Entity\Cudi\Articles\StockArticles\Internal', 'a')
			->where($query->expr()->eq('a.supplier', ':supplier'))
			->setParameter('supplier', $supplier->getId())
			->getQuery()
			->getResult();
			
		$query = $this->_em->createQueryBuilder();
		$external = $query->select('a.id')
			->from('Litus\Entity\Cudi\Articles\StockArticles\External', 'a')
			->where($query->expr()->eq('a.supplier', ':supplier'))
			->setParameter('supplier', $supplier->getId())
			->getQuery()
			->getResult();
			
		$ids = array();
		foreach($external as $article)
			$ids[] = $article['id'];
		foreach($internal as $article)
			$ids[] = $article['id'];

		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('i')
			->from('Litus\Entity\Cudi\Stock\DeliveryItem', 'i')
			->where($query->expr()->in('i.article', $ids))
			->orderBy('i.date', 'DESC')
			->getQuery()
			->getResult();
			
		return $resultSet;
	}
}