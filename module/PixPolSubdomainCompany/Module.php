<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany;

use PixPolUser\Entity\Permission;
use PixPolUser\Service\PermissionService;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap($e)
    {
        $eventManager = $e->getApplication()->getEventManager()->getSharedManager();
        $eventManager->attach('PixPolUser\Service\PermissionService', PermissionService::EVENT_FIND_PERMISSIONS, function($e) {
            $permissions = $e->getTarget();
            $permissions[] = new Permission(__NAMESPACE__, 'role_create');
            $permissions[] = new Permission(__NAMESPACE__, 'role_update');
            $permissions[] = new Permission(__NAMESPACE__, 'role_delete');
        });
        $eventManager->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
            $controller = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));

            if ($moduleNamespace == 'PixPolSubdomainCompany') {
                $controller->layout('layout/company');
            }
        }, 100);
    }
}