<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainApi;

return array(
    'type' => 'Zend\Mvc\Router\Http\Hostname',
    'may_terminate' => false,
    'options' => array(
        'route' => ':subdomain.pixelpolishers.:extension',
        'constraints' => array(
            'subdomain' => 'api',
            'extension' => 'local|com',
        ),
        'defaults' => array(
            'subdomain' => 'api',
            'extension' => empty($GLOBALS['extension']) ? 'com' : $GLOBALS['extension'],
        ),
    ),
    'child_routes' => array(
        'index' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainApi\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
        ),
        'website' => array(
            'type' => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route' => '/website/build',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainApi\Controller\WebsiteController',
                    'action' => 'build',
                ),
            ),
        ),
    ),
);
