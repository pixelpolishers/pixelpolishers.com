<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany\Form;

use PixPolSubdomainCompany\HydratorStrategy\PermissionStrategy;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RoleFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $permissions = array();

        $permissionService = $serviceLocator->get('PixPolPermissionService');
        foreach ($permissionService->findAll() as $permission) {
            $permissions[$permission->getName()] = $permission->getName();
        }

        $form = new RoleForm($permissions);

        $strategy = new PermissionStrategy($permissionService);
        $form->getHydrator()->addStrategy('permissions', $strategy);

        return $form;
    }
}
