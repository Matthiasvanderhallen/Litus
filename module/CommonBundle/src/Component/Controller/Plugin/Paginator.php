<?php
/**
 * Litus is a project by a group of students from the K.U.Leuven. The goal is to create
 * various applications to support the IT needs of student unions.
 *
 * @author Karsten Daemen <karsten.daemen@litus.cc>
 * @author Bram Gotink <bram.gotink@litus.cc>
 * @author Pieter Maene <pieter.maene@litus.cc>
 * @author Kristof Mariën <kristof.marien@litus.cc>
 * @author Michiel Staessen <michiel.staessen@litus.cc>
 * @author Alan Szepieniec <alan.szepieniec@litus.cc>
 *
 * @license http://litus.cc/LICENSE
 */
 
 namespace CommonBundle\Component\Controller\Plugin;
 
 use Doctrine\ORM\EntityManager,
 	 Zend\Paginator\Paginator as ZendPaginator,
 	 Zend\Paginator\Adapter\ArrayAdapter;
 
 /**
  * A controller plugin containing some utility methods for pagination.
  *
  * @autor Pieter Maene <pieter.maene@litus.cc>
  */
 class Paginator extends \Zend\Mvc\Controller\Plugin\AbstractPlugin
 {
 	/**
 	 * @var \Doctrine\ORM\EntityManager The EntityManager instance
 	 */
 	private $_entityManager = null;
 	
 	/**
 	 * @var \Zend\Paginator\Paginator $paginator The paginator
 	 */
 	private $_paginator = null;
 	
 	/**
 	 * @var int The number of items on each page
 	 */
 	private $_itemsPerPage = 25;
 
	/**
	 * Injecting the EntityManager into the plugin.
	 *
	 * @param \Doctrine\ORM\EntityManager $entityManager The EntityManager instance
	 * @return void
	 */
	public function setEntityManager(EntityManager $entityManager)
	{
		$this->_entityManager = $entityManager;
	}
	
	/**
	 * Setting the number of items per page, defaults to 25.
	 *
	 * @param int $itemsPerPage The number of items per page
	 * @return void
	 */
	public function setItemsPerPage($itemsPerPage)
	{
		if (!is_int($itemsPerPage) || $itemsPerPage < 0)
			throw new Exception\InvalidArgumentException('The number of items per page has to be positive integer');
			
		$this->_itemsPerPage = $itemsPerPage;
	}
 
 	/**
	 * Create a paginator from a given array.
	 *
	 * @param array $records The array containing the paginated records
	 * @param int $currentPage The page we now are on
	 * @param int $itemsPerPage The number of items on each page
	 * @return \Zend\Paginator\Paginator
	 */
	public function createFromArray(array $records, $currentPage)
	{
	    $this->_paginator = new ZendPaginator(
	        new ArrayAdapter($records)
	    );
	    
		$this->_paginator->setCurrentPageNumber($currentPage);
	    $this->_paginator->setItemCountPerPage(
	    	$this->_itemsPerPage
	    );
	    
	    return $this->_paginator;
	}

    /**
     * Create a paginator for a given entity.
     *
     * @param string $entity The name of the entity that should be paginated
     * @param int $currentPage The page we now are on
     * @param array $conditions These conditions will be passed to the Repository call
     * @param array $oderBy An array containing constraints on how to order the results
     * @param int $itemsPerPage The number of items on each page
     * @return \Zend\Paginator\Paginator
     */
    public function createFromEntity($entity, $currentPage, array $conditions = array(), array $orderBy = null)
    {
    	if (null === $this->_entityManager)
    		throw new Exception\RuntimeException('No entity manager instance was provided');
    
		return $this->createFromArray(
			(0 == count($conditions)) ?
            	$this->_entityManager->getRepository($entity)->findBy(array(), $orderBy) :
            	$this->_entityManager->getRepository($entity)->findBy($conditions, $orderBy),
           	$currentPage      
        );
    }
    
    /**
     * A method to quickly create the array needed to build the pagination control.
     *
     * @param \Zend\Paginator\Paginator $paginator The paginator
     * @param bool $fullWidth Whether the paginationControl should be displayed using the full width or not
     * @return array
     */
    public function createControl($fullWidth = false)
    {
       	return array(
    		'pages' => $this->_paginator->getPages(),
    		'fullWidth' => $fullWidth
    	);
    }
 }