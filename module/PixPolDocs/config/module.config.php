<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolDocs;

return array(
    'router' => array(
        'routes' => array(
            'developers' => include 'routes.config.php',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'PixPolDocs\Controller\IndexController' => 'PixPolDocs\Controller\IndexController',
            'PixPolDocs\Controller\ManualController' => 'PixPolDocs\Controller\ManualController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
