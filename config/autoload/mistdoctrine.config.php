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
 
return array(
    'di' => array(
        'instance' => array(
            'doctrine_em' => array(
                'parameters' => array(
                    'conn' => array(
                        'driver'   => 'pdo_pgsql',
                        'host'     => 'localhost',
                        'port'     => '5432', 
                        'user'     => 'litus',
                        'password' => 'huQeyU8te3aXusaz',
                        'dbname'   => 'litus',
                    ),
                ),
            ),
            'doctrine_config' => array(
                'parameters' => array(
                	'autoGenerateProxyClasses' => ('development' == getenv('APPLICATION_ENV')),
                	'proxyDir'                 => realpath('data/proxies'),
                	'entityPaths'              => array(),
                ),
            ), 
        ),
    ),
);