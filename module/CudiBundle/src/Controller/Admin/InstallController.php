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

use CommonBundle\Entity\General\Bank\BankDevice,
	CommonBundle\Entity\General\Bank\MoneyUnit,
	CudiBundle\Entity\Articles\Discount\Type as DiscountType,
	CudiBundle\Entity\Articles\StockArticles\Binding,
	CudiBundle\Entity\Articles\StockArticles\Color,
	CudiBundle\Entity\Sales\ServingQueueStatus,
	CudiBundle\Entity\Supplier,
	Exception;

/**
 * InstallController
 *
 * @author Kristof Mariën <kristof.marien@litus.cc>
 */
class InstallController extends \CommonBundle\Component\Controller\ActionController\InstallController
{
	protected function _initConfig()
	{
		$this->_installConfig(
	        array(
				array(
					'key'         => 'cudi.mail',
					'value'       => 'cudi@vtk.be',
					'description' => 'The mail address of cudi',
				),
				array(
					'key'         => 'cudi.mail_name',
					'value'       => 'VTK Cursusdienst',
					'description' => 'The name of the mail sender',
				),
				array(
					'key'         => 'cudi.union_short_name',
					'value'       => 'VTK',
					'description' => 'The short name of this union',
				),
				array(
					'key'         => 'cudi.union_name',
					'value'       => 'VTK vzw',
					'description' => 'The full name of this union',
				),
				array(
					'key'         => 'cudi.union_logo',
					'value'       => 'data/images/logo/logo.jpg',
					'description' => 'The path to the logo of the union',
				),
				array(
					'key'         => 'cudi.union_url',
					'value'       => 'http://www.vtk.be',
					'description' => 'The URL of the union',
				),
				array(
					'key'         => 'cudi.name',
					'value'       => 'Cudi',
					'description' => 'The name of the cudi',
				),
				array(
					'key'         => 'cudi.person',
					'value'       => '1',
					'description' => 'The ID of the person responsible for the cudi',
				),
				array(
					'key'         => 'cudi.delivery_address_name',
					'value'       => 'VTK Cursusdienst',
					'description' => 'The name of the delivery address of the cudi',
				),
				array(
					'key'         => 'cudi.delivery_address_street',
					'value'       => 'Kasteelpark Arenberg 41',
					'description' => 'The street of the delivery address of the cudi',
				),
				array(
					'key'         => 'cudi.delivery_address_city',
					'value'       => '3001 Heverlee',
					'description' => 'The city of the delivery address of the cudi',
				),
				array(
					'key'         => 'cudi.delivery_address_extra',
					'value'       => '(inrit via Celestijnenlaan)',
					'description' => 'The extra information of the delivery address of the cudi',
				),
				array(
					'key'         => 'cudi.billing_address_name',
					'value'       => 'VTK vzw',
					'description' => 'The name of the billing organisation of the cudi',
				),
				array(
					'key'         => 'cudi.billing_address_street',
					'value'       => 'Studentenwijk Arenberg 6/0',
					'description' => 'The street of the billing organisation of the cudi',
				),
				array(
					'key'         => 'cudi.billing_address_city',
					'value'       => '3001 Heverlee',
					'description' => 'The city of the billing organisation of the cudi',
				),
				array(
					'key'         => 'cudi.booking_assigned_mail_subject',
					'value'       => 'New Assignments',
					'description' => 'The subject of the mail sent by new assignments',
				),
				array(
					'key'         => 'cudi.booking_assigned_mail',
					'value'       => 'Dear,
				
	The following bookings are assigned to you:
	{{ bookings }}',
					'description' => 'The mail sent when a booking is assigned'
				),
				array(
					'key'         => 'cudi.reservation_expire_time',
					'value'       => 'P2W',
					'description' => 'The time after which a reservation expires',
				),
				array(
					'key'         => 'cudi.file_path',
					'value'       => 'data/cudi/files',
					'description' => 'The path to the cudi article files',
				),
				array(
					'key'         => 'cudi.pdf_generator_path',
					'value'       => 'data/cudi/pdf_generator',
					'description' => 'The path to the PDF generator files',
				),
				array(
					'key'         => 'cudi.queue_socket_port',
					'value'       => '8899',
					'description' => 'The port used for the websocket of the queue',
				),
				array(
					'key'         => 'cudi.queue_socket_remote_host',
					'value'       => '127.0.0.1',
					'description' => 'The remote host for the websocket of the queue',
				),
				array(
					'key'         => 'cudi.queue_socket_host',
					'value'       => '127.0.0.1',
					'description' => 'The host used for the websocket of the queue',
				),
				array(
					'key'         => 'fop_command',
					'value'       => '/usr/local/bin/fop',
					'description' => 'The command to call Apache FOP',
				),
				array(
					'key'         => 'cudi.serving_queue_barcode_prefix',
					'value'       => '988000000000',
					'description' => 'The start for a serving queue item barcode',
				),
				array(
					'key'         => 'search_max_results',
					'value'       => '30',
					'description' => 'The maximum number of search results shown',
				),
			)
		);
		
		$this->_installMoneyUnit();
		$this->_installBankDevice();
		$this->_installSupplier();
		$this->_installBinding();
		$this->_installColor();
		$this->_installDiscount();
	}
	
	protected function _initAcl()
	{
	    $this->installAcl(
	        array(
	            'cudibundle' => array(
	                'admin_article' => array(
	                	'add', 'delete', 'edit', 'manage', 'newVersion', 'search'
	                ),
	                'admin_article_subject' => array(
	                    'delete', 'manage'
	                ),
	                'admin_booking' => array(
	                	'add', 'assign', 'assignAll', 'delete', 'inactive', 'manage', 'search', 'unassign'
	                ),
	                'admin_comment' => array(
	                	'delete', 'manage'
	                ),
	                'admin_delivery' => array(
	                	'add', 'delete', 'manage', 'supplier'
	                ),
	                'admin_discount' => array(
	                	'delete', 'manage'
	                ),
	                'admin_file' => array(
	                	'delete', 'download', 'manage', 'progress', 'upload'
	                ),
	                'admin_financial' => array(
	                	'sales', 'stock', 'supplier', 'manage'
	                ),
	                'admin_order' => array(
	                	'add', 'delete', 'edit', 'export', 'manage', 'pdf', 'supplier'
	                ),
	                'admin_period' => array(
	                    'manage', 'new', 'search', 'view'
	                ),
	                'admin_sale' => array(
	                	'add', 'close', 'edit', 'editRegister', 'manage'
	                ),
	                'admin_stock' => array(
	                	'edit', 'manage', 'search', 'delta'
	                ),
	                'admin_supplier' => array(
	                	'add', 'addUser', 'deleteUser', 'edit', 'editUser', 'manage', 'search', 'view'
	                ),
	                'sale_queue' => array(
	                	'overview', 'signin'
	                ),
	                'sale_sale' => array(
	                	'return', 'sale'
	                ),
	                'supplier' => array(
	                	'index'
	                ),
	                'supplier_auth' => array(
	                	'login', 'logout'
	                ),
	                'supplier_article' => array(
	                	'manage'
	                ),
	            )
	        )
	    );
	    
	    $this->installRoles(
	        array(
    	        'supplier' => array(
    	        	'system' => true,
    	            'parents' => array(
    	                'guest',
    	            ),
    	            'actions' => array(
    	                'supplier_auth' => array(
    	                	'logout'
    	                ),
    	                'supplier_article' => array(
    	                	'manage'
    	                ),
    	            )
    	        ),
    	        'guest' => array(
    	        	'system' => true,
    	            'parents' => array(),
    	            'actions' => array(
    	                'supplier' => array(
    	                    'index'
    	                ),
    	                'supplier_auth' => array(
    	                    'login'
    	                ),
    	            )
    	        ),
    	    )
    	);
	}
		
	private function _installMoneyUnit()
	{
		$units = array(500, 200, 100, 50, 20, 10, 5, 2, 1, 0.50, 0.20, 0.10, 0.05, 0.02, 0.01);
		
		foreach($units as $item) {
			$unit = $this->getEntityManager()
				->getRepository('CommonBundle\Entity\General\Bank\MoneyUnit')
				->findOneByUnit($item);
			if (null == $unit) {
				$unit = new MoneyUnit($item);
				$this->getEntityManager()->persist($unit);
			}
		}
		$this->getEntityManager()->flush();
	}
	
	private function _installBankDevice()
	{
		$bankdevices = array('Device 1', 'Device 2');
		
		foreach($bankdevices as $item) {
			$bankdevice = $this->getEntityManager()
				->getRepository('CommonBundle\Entity\General\Bank\BankDevice')
				->findOneByName($item);
			if (null == $bankdevice) {
				$bankdevice = new BankDevice($item);
				$this->getEntityManager()->persist($bankdevice);
			}
		}
		$this->getEntityManager()->flush();
	}
	
	private function _installSupplier()
	{
		$suppliers = array(
			array(
				'name'    => 'Acco',
				'phone'   => '+3212345678',
				'address' => 'Street 1 1111 City',
				'VAT'     => '1234556',
			),
		);
		
		foreach($suppliers as $item) {
			$supplier = $this->getEntityManager()
				->getRepository('CudiBundle\Entity\Supplier')
				->findOneByName($item['name']);
			if (null == $supplier) {
				$supplier = new Supplier($item['name'], $item['phone'], $item['address'], $item['VAT']);
				$this->getEntityManager()->persist($supplier);
			}
		}
		$this->getEntityManager()->flush();
	}
	
	private function _installBinding()
	{
		$bindings = array('Binded');
		
		foreach($bindings as $item) {
			$binding = $this->getEntityManager()
				->getRepository('CudiBundle\Entity\Articles\StockArticles\Binding')
				->findOneByName($item);
			if (null == $binding) {
				$binding = new Binding($item);
				$this->getEntityManager()->persist($binding);
			}
		}
		$this->getEntityManager()->flush();
	}
	
	private function _installColor()
	{
		$colors = array('Red', 'Yellow');
		
		foreach($colors as $item) {
			$color = $this->getEntityManager()
				->getRepository('CudiBundle\Entity\Articles\StockArticles\Color')
				->findOneByName($item);
			if (null == $color) {
				$color = new Color($item);
				$this->getEntityManager()->persist($color);
			}
		}
		$this->getEntityManager()->flush();
	}
	
	private function _installDiscount()
	{
		$types = array('member');
		
		foreach($types as $name) {
			$type = $this->getEntityManager()
				->getRepository('CudiBundle\Entity\Articles\Discount\Type')
				->findOneByName($name);
			if (null == $type) {
				$type = new DiscountType($name);
				$this->getEntityManager()->persist($type);
			}
		}
		$this->getEntityManager()->flush();
	}
}