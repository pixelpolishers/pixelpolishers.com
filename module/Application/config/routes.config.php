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
    ),
    'child_routes' => array(
        'default' => array(
            'type' => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route' => '/[:controller[/:action]]',
                'constraints' => array(
                    'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                ),
                'defaults' => array(
                    'controller' => 'Application\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
        ),
    ),
);
