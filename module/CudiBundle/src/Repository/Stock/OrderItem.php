<?php

namespace CudiBundle\Repository\Stock;

use Doctrine\ORM\EntityRepository,
	Doctrine\ORM\Query\Expr\Join;

/**
 * OrderItem
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrderItem extends EntityRepository
{
	public function findOneByArticleAndOrder($article, $order)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('i')
			->from('CudiBundle\Entity\Stock\OrderItem', 'i')
			->where($query->expr()->andX(
				$query->expr()->eq('i.article', ':article'),
				$query->expr()->eq('i.order', ':order')
			))
			->setParameter('article', $article->getId())
			->setParameter('order', $order->getId())
			->setMaxResults(1)
			->getQuery()
			->getResult();
		
		if (isset($resultSet[0]))
            return $resultSet[0];

        return null;
	}
	
	public function findOneOpenByArticle($article)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('i')
			->from('CudiBundle\Entity\Stock\OrderItem', 'i')
			->where($query->expr()->andX(
				$query->expr()->eq('i.article', ':article')
			))
			->innerJoin('i.order', 'o', Join::WITH, $query->expr()->isNull('o.date'))
			->setParameter('article', $article->getId())
			->setMaxResults(1)
			->getQuery()
			->getResult();
		
		if (isset($resultSet[0]))
            return $resultSet[0];

        return null;
	}
	
	public function addNumberByArticle($article, $number)
	{
		$item = $this->findOneOpenByArticle($article);
		
		if (isset($item)) {
			$item->setNumber($item->getNumber()+$number);
		} else {
			$order = $this->_em
				->getRepository('CudiBundle\Entity\Stock\Order')
				->findOneOpenBySupplier($article->getSupplier());
			if (null === $order) {
				$order = new \CudiBundle\Entity\Stock\Order($article->getSupplier());
                $this->_em->persist($order);
			}
			
			$item = new \CudiBundle\Entity\Stock\OrderItem($article, $order, $number);
            $this->_em->persist($item);
		}
		
		return $item;
	}
}