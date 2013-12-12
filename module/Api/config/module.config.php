<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Api;

return array(
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
