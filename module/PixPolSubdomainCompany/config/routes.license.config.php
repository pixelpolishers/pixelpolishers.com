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
        'route' => '/license',
        'defaults' => array(
            'controller' => 'PixPolSubdomainCompany\Controller\LicenseController',
            'action' => 'index',
        ),
    ),
    'may_terminate' => true,
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
);
