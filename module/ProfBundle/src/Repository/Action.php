<?php

namespace ProfBundle\Repository;

use CommonBundle\Entity\Users\Person,
    Doctrine\ORM\EntityRepository,
    Doctrine\ORM\Query\Expr\Join;

/**
 * Action
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Action extends EntityRepository
{
    public function findAllByPerson(Person $person)
    {
        $query = $this->_em->createQueryBuilder();
        $resultSet = $query->select('a')
        	->from('ProfBundle\Entity\Action', 'a')
        	->where(
        	    $query->expr()->eq('a.person', ':person')
            )
        	->setParameter('person', $person->getId())
        	->orderBy('a.createTime', 'DESC')
        	->getQuery()
        	->getResult();
        
        return $resultSet;
    }
    
    public function findAllActionsBySubjectPerson(Person $person)
    {
        $query = $this->_em->createQueryBuilder();
        $subjects = $query->select('m')
            ->from('SyllabusBundle\Entity\SubjectProfMap', 'm')
            ->where(
                $query->expr()->eq('m.prof', ':prof')
            )
            ->setParameter('prof', $person->getId())
            ->getQuery()
            ->getResult();
        
        $subjectIds = array(0);
        foreach($subjects as $subject)
            $subjectIds[] = $subject->getSubject()->getId();
            
        $query = $this->_em->createQueryBuilder();
        $articles = $query->select('m')
            ->from('CudiBundle\Entity\ArticleSubjectMap', 'm')
            ->where(
                $query->expr()->in('m.subject', $subjectIds)
            )
            ->getQuery()
            ->getResult();
        
        $articleIds = array(0);
        foreach($articles as $article)
            $articleIds[] = $article->getArticle()->getId();
        
        $query = $this->_em->createQueryBuilder();
        $articleAdd = $query->select('a')
            ->from('ProfBundle\Entity\Action\Article\Add', 'a')
            ->where(
                $query->expr()->in('a.article', $articleIds)
            )
            ->getQuery()
            ->getResult();
        
        $actionIds = array(0);
        foreach($articleAdd as $action)
            $actionIds[] = $action->getId();
            
        $query = $this->_em->createQueryBuilder();
        $articleEdit = $query->select('a')
            ->from('ProfBundle\Entity\Action\Article\Edit', 'a')
            ->where(
                $query->expr()->in('a.article', $articleIds)
            )
            ->getQuery()
            ->getResult();
        
        foreach($articleEdit as $action)
            $actionIds[] = $action->getId();
            
        $query = $this->_em->createQueryBuilder();
        $fileAdd = $query->select('a')
            ->from('ProfBundle\Entity\Action\File\Add', 'a')
            ->innerJoin('a.file', 'f', Join::WITH, $query->expr()->in('f.internalArticle', $articleIds))
            ->getQuery()
            ->getResult();
        
        foreach($fileAdd as $action)
            $actionIds[] = $action->getId();
            
        $query = $this->_em->createQueryBuilder();
        $fileRemove = $query->select('a')
            ->from('ProfBundle\Entity\Action\File\Remove', 'a')
            ->innerJoin('a.file', 'f', Join::WITH, $query->expr()->in('f.internalArticle', $articleIds))
            ->getQuery()
            ->getResult();
        
        foreach($fileRemove as $action)
            $actionIds[] = $action->getId();
            
        $query = $this->_em->createQueryBuilder();
        $fileAdd = $query->select('a')
            ->from('ProfBundle\Entity\Action\Mapping\Add', 'a')
            ->innerJoin('a.mapping', 'm', Join::WITH, 
                $query->expr()->orX(
                    $query->expr()->in('m.article', $articleIds),
                    $query->expr()->in('m.subject', $subjectIds)
                )
            )
            ->getQuery()
            ->getResult();
        
        foreach($fileAdd as $action)
            $actionIds[] = $action->getId();
            
        $query = $this->_em->createQueryBuilder();
        $fileRemove = $query->select('a')
            ->from('ProfBundle\Entity\Action\Mapping\Remove', 'a')
            ->innerJoin('a.mapping', 'm', Join::WITH, 
                $query->expr()->orX(
                    $query->expr()->in('m.article', $articleIds),
                    $query->expr()->in('m.subject', $subjectIds)
                )
            )
            ->getQuery()
            ->getResult();
        
        foreach($fileRemove as $action)
            $actionIds[] = $action->getId();
        
        $query = $this->_em->createQueryBuilder();
        $resultSet = $query->select('a')
        	->from('ProfBundle\Entity\Action', 'a')
        	->where(
        	    $query->expr()->in('a.id', $actionIds)
            )
        	->orderBy('a.createTime', 'DESC')
        	->getQuery()
        	->getResult();

        return $resultSet;
    }
}