<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Service;

use PixPolUser\Service\AccessService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AccessServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $authService = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        $roleService = $serviceLocator->get('PixPolRoleService');

        $instance = new AccessService($authService->getIdentity());

        foreach ($roleService->findAll() as $role) {
            $rbacRole = $instance->addRole($role->getName())->getRole($role->getName());

            foreach ($role->getPermissions() as $permission) {
                $rbacRole->addPermission($permission);
            }
        }

        return $instance;
    }
}
