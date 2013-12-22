<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AccessController extends AbstractActionController
{
    public function indexAction()
    {
        $roleService = $this->getServiceLocator()->get('PixPolRoleService');
        $permissionService = $this->getServiceLocator()->get('PixPolPermissionService');

        return array(
            'permissions' => $permissionService->findAll(),
            'roles' => $roleService->findAll(),
        );
    }
}
