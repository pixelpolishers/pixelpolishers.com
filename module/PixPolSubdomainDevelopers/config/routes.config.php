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
    ),
);