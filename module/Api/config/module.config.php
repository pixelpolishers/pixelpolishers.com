<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Api;

return array(
    'api_website' => array(
        'build' => array(
            'ip_range_from' => '192.30.252.0',
            'ip_range_till' => '192.30.252.255',
            'refs' => array(
                'refs/heads/master'
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'api' => include 'routes.config.php',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Api\Controller\IndexController' => 'Api\Controller\IndexController',
            'Api\Controller\WebsiteController' => 'Api\Controller\WebsiteController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
