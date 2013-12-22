<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Developers;

return array(
    'pixpoluser_guards' => array(
        'PixPolUser\Guard\RouteGuard' => array(
            'developers/index' => array(
                'permission1', 'permission2', 'permission3',
            ),
        ),
    ),
    'router' => array(
        'routes' => array(
            'developers' => include 'routes.config.php',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'PixPolSubdomainDevelopers\Controller\IndexController' => 'PixPolSubdomainDevelopers\Controller\IndexController',
            'PixPolSubdomainDevelopers\Controller\ConnectController' => 'PixPolSubdomainDevelopers\Controller\ConnectController',
            'PixPolSubdomainDevelopers\Controller\DocsController' => 'PixPolSubdomainDevelopers\Controller\DocsController',
            'PixPolSubdomainDevelopers\Controller\ProgramsController' => 'PixPolSubdomainDevelopers\Controller\ProgramsController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
