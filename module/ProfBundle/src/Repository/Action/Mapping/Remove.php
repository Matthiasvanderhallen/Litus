<?php

namespace ProfBundle\Repository\Action\Mapping;

use CudiBundle\Entity\ArticleSubjectMap,
    Doctrine\ORM\EntityRepository,
    Doctrine\ORM\Query\Expr\Join,
    SyllabusBundle\Entity\Subject;

/**
 * Remove
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Remove extends EntityRepository
{
    public function findOneByMapping(ArticleSubjectMap $mapping)
    {
        $query = $this->_em->createQueryBuilder();
        $resultSet = $query->select('r')
        	->from('ProfBundle\Entity\Action\Mapping\Remove', 'r')
        	->where(
        	    $query->expr()->andX(
        	        $query->expr()->eq('r.mapping', ':mapping'),
        	        $query->expr()->isNull('r.completeTime')
        	    )
        	)
        	->setParameter('mapping', $mapping->getId())
        	->setMaxResults(1)
        	->getQuery()
        	->getResult();
        
        if (isset($resultSet[0]))
        	return $resultSet[0];
        
        return null;
    }
    
    public function findAllBySubject(Subject $subject)
    {
        $query = $this->_em->createQueryBuilder();
        $resultSet = $query->select('r')
        	->from('ProfBundle\Entity\Action\Mapping\Remove', 'r')
        	->innerJoin('r.mapping', 'm', Join::WITH, $query->expr()->eq('m.subject', ':subject'))
        	->setParameter('subject', $subject->getId())
        	->getQuery()
        	->getResult();
        
        return $resultSet;
    }
}