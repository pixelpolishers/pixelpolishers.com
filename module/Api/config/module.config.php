<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Api;

return array(
    'api_auth' => array(
        'base_url' => 'http://www.pixelpolishers.' . $GLOBALS['extension'],
        'providers' => array(
            "LinkedIn" => array(
                "enabled" => true,
                "keys" => array('key' => '', 'secret' => '')
            ),
        ),
        'debug_mode' => false,
        'debug_file' => '',
    ),
    'router' => array(
        'routes' => array(
            'api' => include 'routes.config.php',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Api\Controller\IndexController' => 'Api\Controller\IndexController',
            'Api\Controller\AuthController' => 'Api\Controller\AuthController',
            'Api\Controller\WebsiteController' => 'Api\Controller\WebsiteController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
