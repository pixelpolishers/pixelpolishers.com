<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolDocs;

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
        'docs' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/docs',
                'defaults' => array(
                    'controller' => 'PixPolDocs\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'manual' => array(
                    'type' => 'Zend\Mvc\Router\Http\Regex',
                    'options' => array(
                        'regex' => '/manual/(?<project>[a-zA-Z0-9_-]+)/(?<version>[\.a-zA-Z0-9_-]+)(/(?<page>.*))?',
                        'spec' => '/manual/%project%/%version%/%page%',
                        'defaults' => array(
                            'controller' => 'PixPolDocs\Controller\ManualController',
                            'action' => 'index',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
