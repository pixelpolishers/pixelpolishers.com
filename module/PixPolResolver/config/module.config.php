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
            'PixPolResolver\Controller\VendorController' => 'PixPolResolver\Controller\VendorController',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'PixPolResolver\Service\Package' => 'PixPolResolver\Service\PackageServiceFactory',
            'PixPolResolver\Service\Vendor' => 'PixPolResolver\Service\VendorServiceFactory',
            'PixPolResolver\Service\Submit' => 'PixPolResolver\Service\SubmitServiceFactory',
            'PixPolResolver\Service\Update' => 'PixPolResolver\Service\UpdateServiceFactory',
            'PixPolResolver\GitHubImporter' => function($sm) {
                $config = $sm->get('Config');
                if (!array_key_exists('github', $config)) {
                    throw new \RuntimeException('No GitHub configuration present.');
                }
                $importer = new \PixelPolishers\Resolver\Importer\GitHubImporter();
                $importer->setClientId($config['github']['client_id']);
                $importer->setClientSecret($config['github']['client_secret']);
                return $importer;
            },
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'ppResolverReferenceButton' => 'PixPolResolver\View\Helper\ReferenceButton',
            'ppResolverReferenceUrl' => 'PixPolResolver\View\Helper\ReferenceUrl',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
