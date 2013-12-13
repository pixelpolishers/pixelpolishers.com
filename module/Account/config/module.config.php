<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Account;

return array(
    'router' => array(
        'routes' => array(
            'account' => include 'routes.config.php',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Account\Controller\IndexController' => 'Account\Controller\IndexController',
            'Account\Controller\AccessController' => 'Account\Controller\AccessController',
            'Account\Controller\ProfileController' => 'Account\Controller\ProfileController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
