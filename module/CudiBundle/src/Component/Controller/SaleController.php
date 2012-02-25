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
 
namespace CudiBundle\Component\Controller;

use CommonBundle\Component\Acl\Acl,
	CommonBundle\Component\Acl\Driver\HasAccess,
	CommonBundle\Component\Util\File,
	Exception,
	Zend\Cache\StorageFactory,
	Zend\Mvc\MvcEvent,
	Zend\Paginator\Paginator,
	Zend\Paginator\Adapter\ArrayAdapter;

/**
 * We extend the CommonBundle controller to check a sale session is selected.
 *
 * @author Kristof Mariën <kristof.marien@litus.cc>
 */
class SaleController extends \CommonBundle\Component\Controller\ActionController
{
	
	/**
     * Execute the request
     * 
     * @param \Zend\Mvc\MvcEvent $e The MVC event
     * @return array
     * @throws \CommonBundle\Component\Controller\Exception\HasNoAccessException The user does not have permissions to access this resource
     */
    public function execute(MvcEvent $e)
    {
		$session = $this->getEntityManager()
		    ->getRepository('CudiBundle\Entity\Sales\Session')
		    ->findOneById($this->getParam('session'));
		
		if (null == $session || !$session->isOpen()) {
			$session = $this->getEntityManager()
			    ->getRepository('CudiBundle\Entity\Sales\Session')
			    ->findOpenSession();

			if (null == $session)
				throw new Exception('No open session could be found');

			$this->redirect()->toRoute('sale', array(
				'controller' => $this->getParam('controller'),
				'action' => $this->getParam('action'),
				'session' => $session->getId(),
			));
		}
		
		$result = parent::execute($e);
		
		$result['session'] = $session;
  		
        $e->setResult($result);
        return $result;
    }
}
