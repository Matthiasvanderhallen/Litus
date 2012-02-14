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
	CommonBundle\Component\Util\File as FileUtil,
	CommonBundle\Component\Util\TmpFile,
	CommonBundle\Component\Util\Xml\XmlGenerator,
	CommonBundle\Component\Util\Xml\XmlObject,
	CudiBundle\Component\Generator\OrderPdfGenerator,
	CudiBundle\Component\Generator\OrderXmlGenerator,
	CudiBundle\Entity\Stock\Order,
	CudiBundle\Entity\Stock\OrderItem,
	CudiBundle\Form\Admin\Order\Add as AddForm,
	CudiBundle\Form\Admin\Order\AddItem as AddItemForm,
	CudiBundle\Form\Admin\Order\Edit as EditForm,
	Zend\Pdf\Page as PdfPage,
	Zend\Pdf\PdfDocument;

/**
 * This class controls management of the stock.
 * 
 * @author Kristof Mariën <kristof.marien@litus.cc>
 */
class OrderController extends \CommonBundle\Component\Controller\ActionController
{
    public function init()
    {
        parent::init();

		$contextSwitch = $this->broker('contextSwitch');
        $contextSwitch->setContext(
	            'pdf',
	            array(
	                 'headers' => array(
	                     'Content-type' => 'application/pdf',
	                     'Pragma' => 'public',
	                     'Cache-Control' => 'private, max-age=0, must-revalidate'
	                 )
	            )
	        )->setContext(
                'zip',
                array(
                     'headers' => array(
                         'Content-type' => 'application/zip',
                         'Pragma' => 'public',
                         'Cache-Control' => 'private, max-age=0, must-revalidate'
                     )
                )
            );

        $contextSwitch->setActionContext('pdf', 'pdf')
        	->setActionContext('export', 'zip')
            ->initContext();
    }
    
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
		$supplier = $this->getEntityManager()
            ->getRepository('CudiBundle\Entity\Supplier')
            ->findOneById($this->getRequest()->getParam('id'));
		
		if (null == $supplier)
			throw new \Zend\Controller\Action\Exception('Page Not Found', 404);
			
		$this->view->supplier = $supplier;
		$this->view->orders = $this->_createPaginator(
            'CudiBundle\Entity\Stock\Order',
			array('supplier' => $supplier->getId())
        );
	}
	
	public function editAction()
	{
		$this->view->inlineScript()->appendFile($this->view->baseUrl('/_admin/js/downloadFile.js'));
		
		$order = $this->getEntityManager()
            ->getRepository('CudiBundle\Entity\Stock\Order')
            ->findOneById($this->getRequest()->getParam('id'));
		
		if (null == $order)
			throw new \Zend\Controller\Action\Exception('Page Not Found', 404);

		$this->view->order = $order;
	}
	
	public function addAction()
	{
		$form = new AddItemForm();
		
		$this->view->form = $form;
		
		if($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();

            if($form->isValid($formData)) {
				$article = $this->getEntityManager()
					->getRepository('CudiBundle\Entity\Stock\StockItem')
					->findOneByBarcode($formData['stockArticle']);
				
				$item = $this->getEntityManager()
					->getRepository('CudiBundle\Entity\Stock\OrderItem')
					->addNumberByArticle($article, $formData['number']);
				$this->broker('flashmessenger')->addMessage(
                    new FlashMessage(
                        FlashMessage::SUCCESS,
                        'SUCCESS',
                        'The order item was successfully added!'
                    )
				);
				
				$this->_redirect('edit', null, null, array('id' => $item->getOrder()->getId()));
			}
        }
	}
	
	public function deleteitemAction()
	{
		$item = $this->getEntityManager()
	        ->getRepository('CudiBundle\Entity\Stock\OrderItem')
	    	->findOneById($this->getRequest()->getParam('id'));
	
		if (null == $item || $item->getOrder()->isPlaced())
			throw new \Zend\Controller\Action\Exception('Page Not Found', 404);
			
		$this->view->item = $item;
		
		if (null !== $this->getRequest()->getParam('confirm')) {
			if (1 == $this->getRequest()->getParam('confirm')) {
				$this->getEntityManager()->remove($item);

				$this->broker('flashmessenger')->addMessage(
            		new FlashMessage(
                		FlashMessage::SUCCESS,
                    	'SUCCESS',
                    	'The article was successfully removed!'
                	)
            	);
			};
            
			$this->_redirect('edit', null, null, array('id' => $item->getOrder()->getId()));
        }
	}
	
	public function placeAction()
	{
		$order = $this->getEntityManager()
	        ->getRepository('CudiBundle\Entity\Stock\Order')
	    	->findOneById($this->getRequest()->getParam('id'));
	
		if (null == $order || $order->isPlaced())
			throw new \Zend\Controller\Action\Exception('Page Not Found', 404);
			
		$order->setDate(new \DateTime());
				
		$this->_redirect('edit', null, null, array('id' => $order->getId()));
	}
	
	public function pdfAction()
	{
		$this->broker('layout')->disableLayout(); 
		$this->broker('viewRenderer')->setNoRender();
		
		$order = $this->getEntityManager()
	        ->getRepository('CudiBundle\Entity\Stock\Order')
	    	->findOneById($this->getRequest()->getParam('id'));
	
		if (null == $order || !$order->isPlaced())
			throw new \Zend\Controller\Action\Exception('Page Not Found', 404);
		
		$document = new OrderPdfGenerator($order);
		$document->generate();

		// TODO: remove content type (must be in init)
		$this->getResponse()->setHeader(
			'Content-Disposition', 'inline; filename="order.pdf"'
		)->setHeader(
			'Content-type', 'application/pdf'
		);
		
		$this->getResponse()->setHeader('Content-Length', filesize($file));

		readfile($file);
	}
	
	public function exportAction()
	{
		$this->broker('layout')->disableLayout(); 
		$this->broker('viewRenderer')->setNoRender();
		
		$order = $this->getEntityManager()
			->getRepository('CudiBundle\Entity\Stock\Order')
			->findOneById($this->getRequest()->getParam('id'));
			
		if (null == $order || !$order->isPlaced())
			throw new \Zend\Controller\Action\Exception('Page Not Found', 404);
		
		$document = new OrderXmlGenerator($order);
		
		
		// TODO: remove content type (must be in init)
		$this->getResponse()->setHeader(
			'Content-Disposition', 'inline; filename="order.zip"'
		)->setHeader(
			'Content-type', 'application/zip'
		);
		
		$archive = new TmpFile();
		$document->generateArchive($archive);
		readfile($archive->getFileName());
	}
}