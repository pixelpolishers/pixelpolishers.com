<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolResolver;

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
        'resolver' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/resolver',
                'defaults' => array(
                    'controller' => 'PixPolResolver\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'delete' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/delete/:vendor/:name',
                        'defaults' => array(
                            'controller' => 'PixPolResolver\Controller\PackageController',
                            'action' => 'delete',
                        ),
                    ),
                ),
                'delete-version' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/delete/:vendor/:name/:version',
                        'defaults' => array(
                            'controller' => 'PixPolResolver\Controller\PackageController',
                            'action' => 'deleteVersion',
                        ),
                    ),
                ),
                'force-update' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/force-update/:vendor/:name',
                        'defaults' => array(
                            'controller' => 'PixPolResolver\Controller\PackageController',
                            'action' => 'forceUpdate',
                        ),
                    ),
                ),
                'submit' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/submit',
                        'defaults' => array(
                            'controller' => 'PixPolResolver\Controller\PackageController',
                            'action' => 'submit',
                        ),
                    ),
                ),
                'view' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/package/:vendor/:name',
                        'defaults' => array(
                            'controller' => 'PixPolResolver\Controller\PackageController',
                            'action' => 'view',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
