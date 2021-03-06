<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Account;

return array(
    'type' => 'Zend\Mvc\Router\Http\Hostname',
    'may_terminate' => false,
    'options' => array(
        'route' => ':subdomain.pixelpolishers.:extension',
        'constraints' => array(
            'subdomain' => 'account',
            'extension' => 'local|com',
        ),
        'defaults' => array(
            'subdomain' => 'account',
            'extension' => empty($GLOBALS['extension']) ? 'com' : $GLOBALS['extension'],
        ),
    ),
    'child_routes' => array(
        'index' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainAccount\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
        ),
        'dashboard' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/dashboard',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainAccount\Controller\IndexController',
                    'action' => 'dashboard',
                ),
            ),
        ),
        'profile' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/profile',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainAccount\Controller\ProfileController',
                    'action' => 'index',
                ),
            ),
        ),
        'view-profile' => array(
            'type' => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route' => '/profile/:user',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainAccount\Controller\ProfileController',
                    'action' => 'view',
                ),
            ),
        ),
        'password' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/password',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainAccount\Controller\IndexController',
                    'action' => 'password',
                ),
            ),
        ),
        'request-password' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/request/password',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainAccount\Controller\RequestController',
                    'action' => 'password',
                ),
            ),
        ),
        'signin' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/sign-in',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainAccount\Controller\AccessController',
                    'action' => 'signin',
                ),
            ),
        ),
        'signout' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/sign-out',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainAccount\Controller\AccessController',
                    'action' => 'signout',
                ),
            ),
        ),
        'signup' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/sign-up',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainAccount\Controller\AccessController',
                    'action' => 'signup',
                ),
            ),
        ),
    ),
);
