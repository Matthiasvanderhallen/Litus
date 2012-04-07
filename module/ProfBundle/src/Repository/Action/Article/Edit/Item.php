<?php

namespace ProfBundle\Repository\Action\Article\Edit;

use CudiBundle\Entity\Article,
    Doctrine\ORM\EntityRepository,
    Doctrine\ORM\Query\Expr\Join;

/**
 * Item
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Item extends EntityRepository
{
    public function findAllByArticle(Article $article)
    {
        $query = $this->_em->createQueryBuilder();
        $resultSet = $query->select('i')
        	->from('ProfBundle\Entity\Action\Article\Edit\Item', 'i')
        	->innerJoin('i.action', 'a', Join::WITH, $query->expr()->eq('a.article', ':article'))
        	->setParameter('article', $article->getId())
        	->orderBy('a.createTime', 'ASC')
        	->getQuery()
        	->getResult();
        
        return $resultSet;
    }
}