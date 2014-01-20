<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany;

return array(
    'type' => 'Zend\Mvc\Router\Http\Literal',
    'options' => array(
        'route' => '/access',
        'defaults' => array(
            'controller' => 'PixPolSubdomainCompany\Controller\AccessController',
            'action' => 'index',
        ),
    ),
    'may_terminate' => true,
    'child_routes' => array(
        'user' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/user',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainCompany\Controller\AccessUserController',
                ),
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'overview' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/overview[/:letter]',
                        'defaults' => array(
                            'action' => 'overview',
                        ),
                    ),
                ),
                'view' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/view/:id',
                        'defaults' => array(
                            'action' => 'view',
                        ),
                    ),
                ),
            ),
        ),
        'role' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/role',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainCompany\Controller\AccessRoleController',
                ),
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'create' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/create',
                        'defaults' => array(
                            'action' => 'create',
                        ),
                    ),
                ),
                'delete' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/delete/:id',
                        'defaults' => array(
                            'action' => 'delete',
                        ),
                    ),
                ),
                'overview' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/overview',
                        'defaults' => array(
                            'action' => 'overview',
                        ),
                    ),
                ),
                'update' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/update/:id',
                        'defaults' => array(
                            'action' => 'update',
                        ),
                    ),
                ),
            ),
        ),
        'permission' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/permission',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainCompany\Controller\AccessPermissionController',
                ),
            ),
            'may_terminate' => false,
            'child_routes' => array(
                'overview' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/overview',
                        'defaults' => array(
                            'action' => 'overview',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
