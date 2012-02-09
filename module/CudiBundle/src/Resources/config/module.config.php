<?php
return array(
    'display_exceptions'    => true,
    'di'                    => array(
        'instance' => array(
            'alias' => array(
                'admin_article' => 'CudiBundle\Controller\Admin\ArticleController',
            ),
            'doctrine_config' => array(
                'parameters' => array(
                	'entityPaths' => array(
                		'cudibundle' => __DIR__ . '/../../Entity',
                	),
                ),
            ), 
        ),
    ),
    'routes' => array(
        'admin_article' => array(
            'type'    => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route'    => '/admin/article[/:action[/:id[/:confirm]]]',
                'constraints' => array(
                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'id'     => '[0-9]*',
    	        	'confirm' => '[01]',
                ),
                'defaults' => array(
                    'controller' => 'admin_article',
                    'action'     => 'add',
                ),
            ),
        ),
        'admin_article_search' => array(
            'type'    => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route'    => '/admin/article/search/[/:field[/:string]]',
                'constraints' => array(
                    'field' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'string' => '[a-zA-Z][a-zA-Z0-9_-]*',
                ),
                'defaults' => array(
                    'controller' => 'admin_article',
                    'action'     => 'search',
                ),
            ),
         ),
    ),
);