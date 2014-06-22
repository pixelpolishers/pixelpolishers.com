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
        'route' => '/website',
        'defaults' => array(
            'controller' => 'PixPolSubdomainCompany\Controller\WebsiteController',
            'action' => 'index',
        ),
    ),
    'may_terminate' => true,
    'child_routes' => array(
        'update' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/update',
                'defaults' => array(
                    'action' => 'update',
                ),
            ),
        ),
    ),
);
