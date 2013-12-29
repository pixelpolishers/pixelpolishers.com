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
        'docs' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/docs',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainDevelopers\Controller\DocsController',
                    'action' => 'index',
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'manual' => array(
                    'type' => 'Zend\Mvc\Router\Http\Regex',
                    'options' => array(
                        'regex' => '/manual/(?<project>[a-zA-Z0-9_-]+)/(?<version>[\.a-zA-Z0-9_-]+)(/(?<page>.*))?',
                        'spec' => '/manual/%project%/%version%/%page%',
                        'defaults' => array(
                            'controller' => 'PixPolSubdomainDevelopers\Controller\DocsController',
                            'action' => 'manual',
                        ),
                    ),
                ),
                'wiki' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/wiki',
                        'defaults' => array(
                            'controller' => 'PixPolWiki\Controller\PageController',
                            'action' => 'index',
                        ),
                    ),
                ),
                'wiki_page' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/wiki/:page',
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
