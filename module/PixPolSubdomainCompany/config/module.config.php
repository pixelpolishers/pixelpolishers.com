<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany;

return array(
    'router' => array(
        'routes' => array(
            'company' => include 'routes.config.php',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'PixPolSubdomainCompany\Controller\IndexController' => 'PixPolSubdomainCompany\Controller\IndexController',
            'PixPolSubdomainCompany\Controller\AccessController' => 'PixPolSubdomainCompany\Controller\AccessController',
            'PixPolSubdomainCompany\Controller\AccessPermissionController' => 'PixPolSubdomainCompany\Controller\AccessPermissionController',
            'PixPolSubdomainCompany\Controller\AccessRoleController' => 'PixPolSubdomainCompany\Controller\AccessRoleController',
            'PixPolSubdomainCompany\Controller\AccessUserController' => 'PixPolSubdomainCompany\Controller\AccessUserController',
            'PixPolSubdomainCompany\Controller\LicenseController' => 'PixPolSubdomainCompany\Controller\LicenseController',
            'PixPolSubdomainCompany\Controller\WebsiteController' => 'PixPolSubdomainCompany\Controller\WebsiteController',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'PixPolSubdomainCompany\Form\SubmitForm' => 'PixPolSubdomainCompany\Form\SubmitForm',
        ),
        'factories' => array(
            'PixPolSubdomainCompany\Form\LicenseForm' => 'PixPolSubdomainCompany\Form\LicenseFormFactory',
            'PixPolSubdomainCompany\Form\RoleForm' => 'PixPolSubdomainCompany\Form\RoleFormFactory',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
