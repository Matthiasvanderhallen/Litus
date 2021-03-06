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
 
namespace CudiBundle\Controller\Admin;

use CommonBundle\Component\FlashMessenger\FlashMessage,
	CudiBundle\Entity\Stock\DeliveryItem,
	CudiBundle\Entity\Stock\ReturnItem,
	CudiBundle\Form\Admin\Delivery\Add as AddForm,
	CudiBundle\Form\Admin\Delivery\Retour as RetourForm;

/**
 * DeliveryController
 * 
 * @author Kristof Mariën <kristof.marien@litus.cc>
 */
class DeliveryController extends \CommonBundle\Component\Controller\ActionController
{

	public function manageAction()
	{
		$paginator = $this->paginator()->createFromEntity(
		    'CudiBundle\Entity\Supplier',
		    $this->getParam('page')
		);
		
		return array(
			'paginator' => $paginator,
			'paginationControl' => $this->paginator()->createControl(true)
		);
	}
	
	public function supplierAction()
	{
		if (!($supplier = $this->_getSupplier()))
		    return;
		    
		$paginator = $this->paginator()->createFromArray(
			$this->getEntityManager()
			    ->getRepository('CudiBundle\Entity\Stock\DeliveryItem')
			    ->findAllBySupplier($supplier),
		    $this->getParam('page')
		);
		
		return array(
			'supplier' => $supplier,
			'paginator' => $paginator,
			'paginationControl' => $this->paginator()->createControl(),
			'suppliers' => $this->getEntityManager()
				->getRepository('CudiBundle\Entity\Supplier')
				->findAll(),
		);
	}	
	
	public function addAction()
	{
		$form = new AddForm($this->getEntityManager());
		
		if($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->post()->toArray();

            if($form->isValid($formData)) {
				$article = $this->getEntityManager()
					->getRepository('CudiBundle\Entity\Stock\StockItem')
					->findOneByBarcode($formData['stockArticle']);
				
			    $item = new DeliveryItem($article, $formData['number']);
				$this->getEntityManager()->persist($item);
				$this->getEntityManager()->flush();
				
				$this->flashMessenger()->addMessage(
                    new FlashMessage(
                        FlashMessage::SUCCESS,
                        'SUCCESS',
                        'The delivery was successfully added!'
                    )
				);
				
				$this->redirect()->toRoute(
					'admin_delivery',
					array(
						'action' => 'supplier',
						'id'     => $article->getSupplier()->getId(),
					)
				);
			}
        }
        
        return array(
        	'form' => $form,
        	'deliveries' => $this->getEntityManager()
        		->getRepository('CudiBundle\Entity\Stock\DeliveryItem')
        		->findLastNb(25),
        );
	}
	
	public function returnAction()
	{
		$form = new RetourForm($this->getEntityManager());
		
		if($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->post()->toArray();

            if($form->isValid($formData)) {
				$article = $this->getEntityManager()
					->getRepository('CudiBundle\Entity\Stock\StockItem')
					->findOneByBarcode($formData['stockArticle']);
				
			    $item = new ReturnItem($article, $formData['number']);
				$this->getEntityManager()->persist($item);
				$this->getEntityManager()->flush();
				
				$this->flashMessenger()->addMessage(
                    new FlashMessage(
                        FlashMessage::SUCCESS,
                        'SUCCESS',
                        'The delivery was successfully added!'
                    )
				);
				
				$this->redirect()->toRoute(
					'admin_delivery',
					array(
						'action' => 'supplier',
						'id'     => $article->getSupplier()->getId(),
					)
				);
			}
        }
        
        return array(
        	'form' => $form,
        	'deliveries' => $this->getEntityManager()
        		->getRepository('CudiBundle\Entity\Stock\ReturnItem')
        		->findLastNb(25),
        );
	}
	
	public function deleteAction()
	{
		$this->initAjax();
		
		if (!($delivery = $this->_getDeliveryItem()))
		    return;
		
		$delivery->getArticle()->getStockItem()->addNumber(-$delivery->getNumber());
		$this->getEntityManager()->remove($delivery);
		$this->getEntityManager()->flush();
		
		return array(
		    'result' => (object) array("status" => "success")
		);
	}
	
	private function _getDeliveryItem()
	{
		if (null === $this->getParam('id')) {
			$this->flashMessenger()->addMessage(
			    new FlashMessage(
			        FlashMessage::ERROR,
			        'Error',
			        'No id was given to identify the delivery!'
			    )
			);
			
			$this->redirect()->toRoute(
				'admin_order',
				array(
					'action' => 'manage'
				)
			);
			
			return;
		}
	
	    $delivery = $this->getEntityManager()
	        ->getRepository('CudiBundle\Entity\Stock\DeliveryItem')
	        ->findOneById($this->getParam('id'));
		
		if (null === $delivery) {
			$this->flashMessenger()->addMessage(
			    new FlashMessage(
			        FlashMessage::ERROR,
			        'Error',
			        'No delivery with the given id was found!'
			    )
			);
			
			$this->redirect()->toRoute(
				'admin_order',
				array(
					'action' => 'manage'
				)
			);
			
			return;
		}
		
		return $delivery;
	}
	
	private function _getSupplier()
	{
		if (null === $this->getParam('id')) {
			$this->flashMessenger()->addMessage(
			    new FlashMessage(
			        FlashMessage::ERROR,
			        'Error',
			        'No id was given to identify the supplier!'
			    )
			);
			
			$this->redirect()->toRoute(
				'admin_order',
				array(
					'action' => 'manage'
				)
			);
			
			return;
		}
	
	    $supplier = $this->getEntityManager()
	        ->getRepository('CudiBundle\Entity\Supplier')
	        ->findOneById($this->getParam('id'));
		
		if (null === $supplier) {
			$this->flashMessenger()->addMessage(
			    new FlashMessage(
			        FlashMessage::ERROR,
			        'Error',
			        'No supplier with the given id was found!'
			    )
			);
			
			$this->redirect()->toRoute(
				'admin_order',
				array(
					'action' => 'manage'
				)
			);
			
			return;
		}
		
		return $supplier;
	}
}
