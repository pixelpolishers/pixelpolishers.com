<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolResolver;

return array(
    'router' => array(
        'routes' => array(
            'developers' => include 'routes.config.php',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'PixPolResolver\Controller\IndexController' => 'PixPolResolver\Controller\IndexController',
            'PixPolResolver\Controller\PackageController' => 'PixPolResolver\Controller\PackageController',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'PixPolResolver\Service\Package' => 'PixPolResolver\Service\PackageServiceFactory',
            'PixPolResolver\Service\Submit' => 'PixPolResolver\Service\SubmitServiceFactory',
            'PixPolResolver\Service\Update' => 'PixPolResolver\Service\UpdateServiceFactory',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
