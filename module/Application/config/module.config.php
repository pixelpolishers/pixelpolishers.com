<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Application;

return array(
    'router' => array(
        'routes' => array(
            'www' => include 'routes.config.php',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\IndexController' => 'Application\Controller\IndexController',
            'Application\Controller\CompanyController' => 'Application\Controller\CompanyController',
            'Application\Controller\TechnologyController' => 'Application\Controller\TechnologyController',
            'Application\Controller\ServicesController' => 'Application\Controller\ServicesController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
