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
            'type' => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'Application\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
        ),
        'company' => array(
            'type' => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route' => '/company',
                'defaults' => array(
                    'controller' => 'Application\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
        ),
        'technologies' => array(
            'type' => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route' => '/technologies',
                'defaults' => array(
                    'controller' => 'Application\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
        ),
    ),
);
