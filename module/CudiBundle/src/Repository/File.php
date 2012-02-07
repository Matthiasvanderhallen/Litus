<?php

namespace CudiBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * File
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class File extends EntityRepository
{
	public function findAllByArticle($article)
	{
		$query = $this->_em->createQueryBuilder();
		$resultSet = $query->select('f')
			->from('CudiBundle\Entity\File', 'f')
			->where($query->expr()->eq('f.internalArticle', ':article'))
			->setParameter('article', $article->getId())
			->getQuery()
			->getResult();

        return $resultSet;
	}
}