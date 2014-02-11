<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainDevelopers;

return array(
    'type' => 'Zend\Mvc\Router\Http\Hostname',
    'may_terminate' => false,
    'options' => array(
        'route' => ':subdomain.pixelpolishers.:extension',
        'constraints' => array(
            'subdomain' => 'developers',
            'extension' => 'local|com',
        ),
        'defaults' => array(
            'subdomain' => 'developers',
            'extension' => empty($GLOBALS['extension']) ? 'com' : $GLOBALS['extension'],
        ),
    ),
    'child_routes' => array(
        'index' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainDevelopers\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
        ),
        'programs' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/programs',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainDevelopers\Controller\ProgramsController',
                    'action' => 'index',
                ),
            ),
        ),
        'connect' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/connect',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainDevelopers\Controller\ConnectController',
                    'action' => 'index',
                ),
            ),
        ),
        'wiki' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/docs/wiki',
                'defaults' => array(
                    'controller' => 'PixPolWiki\Controller\PageController',
                    'action' => 'index',
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'page' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/:page',
                        'defaults' => array(
                            'controller' => 'PixPolWiki\Controller\PageController',
                            'action' => 'page',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
