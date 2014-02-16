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
use Zend\Mvc\MvcEvent;

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

    public function onBootstrap(MvcEvent $e)
    {
        $events = $e->getApplication()->getEventManager();
        $events->attach(MvcEvent::EVENT_ROUTE, array($this, 'onRoute'), -1000);
        $events->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), -1000);

        $eventManager = $events->getSharedManager();
        $eventManager->attach('PixPolUser\Service\PermissionService', PermissionService::EVENT_FIND_PERMISSIONS, function($e) {
            $permissions = $e->getTarget();

            $permissions[] = new Permission(__NAMESPACE__, 'LicenseCreate');
            $permissions[] = new Permission(__NAMESPACE__, 'LicenseUpdate');
            $permissions[] = new Permission(__NAMESPACE__, 'LicenseDelete');

            $permissions[] = new Permission(__NAMESPACE__, 'RoleCreate');
            $permissions[] = new Permission(__NAMESPACE__, 'RoleUpdate');
            $permissions[] = new Permission(__NAMESPACE__, 'RoleDelete');

            $permissions[] = new Permission(__NAMESPACE__, 'PermissionView');
        });
    }

    public function onDispatch(MvcEvent $e)
    {
        $controller = $e->getTarget();
        $controllerClass = get_class($controller);
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));

        if ($moduleNamespace == 'PixPolSubdomainCompany') {
            $controller->layout('layout/company');
        }
    }

    public function onRoute(MvcEvent $e)
    {
        $match = $e->getRouteMatch();
        if (strpos($match->getParam('controller'), __NAMESPACE__) !== 0) {
            return;
        }

        $application = $e->getApplication();
        $accessService = $application->getServiceManager()->get('PixPolUser\Service\Access');

        $currentUser = $accessService->getCurrentUser();
        if ($currentUser && $currentUser->hasTag('employee')) {
            return;
        }

        $e->setError('no-access');
        $e->setParam('exception', new \RuntimeException('You are not authorized to access this page.'));

        $application->getEventManager()->trigger(MvcEvent::EVENT_DISPATCH_ERROR, $e);
    }
}