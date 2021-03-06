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
 
$asseticConfig = include __DIR__ . '/../../../../../config/assetic.config.php';

return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'install_news'  => 'NewsBundle\Controller\Admin\InstallController',
                'admin_news'   => 'NewsBundle\Controller\Admin\NewsController',

                'common_news'   => 'NewsBundle\Controller\NewsController',
            ),
            
            'doctrine_config' => array(
                'parameters' => array(
                	'entityPaths' => array(
                		'newsbundle' => __DIR__ . '/../../Entity',
                	),
                ),
            ),
            
            'translator' => array(
            	'parameters' => array(
        		    'adapter' => 'ArrayAdapter',
        			'translations' => array(
        				'news_admin_en' => array(
                			'content' => __DIR__ . '/../translations/admin.en.php',
                			'locale' => 'en',
                		),
                		'news_admin_nl' => array(
                			'content' => __DIR__ . '/../translations/admin.nl.php',
                			'locale' => 'nl',
                		),
                		'news_common_en' => array(
                			'content' => __DIR__ . '/../translations/common.en.php',
                			'locale' => 'en',
                		),
                		'news_common_nl' => array(
                			'content' => __DIR__ . '/../translations/common.nl.php',
                			'locale' => 'nl',
                		),
            		),
            	),
            ),
        ),
    ),
    'routes' => array(
        'install_news' => array(
            'type'    => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route'    => '/admin/install/news',
                'constraints' => array(
                ),
                'defaults' => array(
                    'controller' => 'install_news',
                    'action'     => 'index',
                ),
            ),
        ),
        'admin_news' => array(
            'type'    => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route'    => '/admin/content/news[/:action[/:id]]',
                'constraints' => array(
                	'action'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                	'id'      => '[0-9]*',
                ),
                'defaults' => array(
                    'controller' => 'admin_news',
                    'action'     => 'manage',
                ),
            ),
        ),
        /*'common_news' => array(
            'type'    => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route'    => '[/:language]/news[/:action[/:name]]',
                'constraints' => array(
                	'action'  => '[a-zA-Z][a-zA-Z0-9_-]*',
                	'name'  => '[a-zA-Z0-9_-]*',
                    'language' => '[a-zA-Z][a-zA-Z_-]*',
                ),
                'defaults' => array(
                    'controller' => 'common_news',
                    'action'     => 'overview',
                ),
            ),
        ),*/
	),
);
