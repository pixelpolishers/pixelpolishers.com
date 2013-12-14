<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Application;

return array(
    'type' => 'Zend\Mvc\Router\Http\Hostname',
    'may_terminate' => false,
    'options' => array(
        'route' => ':subdomain.pixelpolishers.:extension',
        'constraints' => array(
            'subdomain' => 'www',
            'extension' => 'local|com',
        ),
        'defaults' => array(
            'subdomain' => 'www',
            'extension' => $GLOBALS['extension'],
        ),
    ),
    'child_routes' => array(
        'index' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'Application\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
        ),
        'company' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/company',
                'defaults' => array(
                    'controller' => 'Application\Controller\CompanyController',
                    'action' => 'index',
                ),
            ),
            'child_routes' => array(
                'about' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/about',
                        'defaults' => array(
                            'action' => 'about',
                        ),
                    ),
                ),
                'careers' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/careers',
                        'defaults' => array(
                            'action' => 'careers',
                        ),
                    ),
                ),
                'contact' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/contact',
                        'defaults' => array(
                            'action' => 'contact',
                        ),
                    ),
                ),
            ),
        ),
        'technologies' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/technologies',
                'defaults' => array(
                    'controller' => 'Application\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
        ),
        'services' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'may_terminate' => true,
            'options' => array(
                'route' => '/services',
                'defaults' => array(
                    'controller' => 'Application\Controller\ServicesController',
                    'action' => 'index',
                ),
            ),
            'child_routes' => array(
                'consulting' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/consulting',
                        'defaults' => array(
                            'action' => 'consulting',
                        ),
                    ),
                ),
                'training' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/training',
                        'defaults' => array(
                            'action' => 'training',
                        ),
                    ),
                ),
                'certification' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/certification',
                        'defaults' => array(
                            'action' => 'certification',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
