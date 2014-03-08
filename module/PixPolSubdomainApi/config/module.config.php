<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainApi;

return array(
    'router' => array(
        'routes' => array(
            'api' => include 'routes.config.php',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'PixPolSubdomainApi\Controller\IndexController' => 'PixPolSubdomainApi\Controller\IndexController',
            'PixPolSubdomainApi\Controller\ResolverController' => 'PixPolSubdomainApi\Controller\ResolverController',
            'PixPolSubdomainApi\Controller\WebsiteController' => 'PixPolSubdomainApi\Controller\WebsiteController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
