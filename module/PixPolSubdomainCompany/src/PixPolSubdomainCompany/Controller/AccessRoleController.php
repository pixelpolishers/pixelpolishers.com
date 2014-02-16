<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AccessRoleController extends AbstractActionController
{
    public function overviewAction()
    {
        $roleService = $this->getServiceLocator()->get('PixPolUser\Service\Role');
        $permissionService = $this->getServiceLocator()->get('PixPolPermissionService');

        return array(
            'roles' => $roleService->findAll(),
            'permissions' => $permissionService->findAll(),
        );
    }

    public function createAction()
    {
        $form = $this->getServiceLocator()->get('PixPolSubdomainCompany\Form\RoleForm');
        $form->setAttribute('action', $this->url()->fromRoute('company/access/role/create'));

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get('PixPolUser\Service\Role');
                $service->persist($form->getData());

                return $this->redirect()->toRoute('company/access');
            }
        }

        return array(
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $service = $this->getServiceLocator()->get('PixPolUser\Service\Role');
        $entity = $service->find($this->params('id'));

        if (!$entity) {
            return $this->redirect()->toRoute('company/access');
        }

        $form = $this->getServiceLocator()->get('PixPolSubdomainCompany\Form\SubmitForm');
        $form->setAttribute('action', $this->url()->fromRoute('company/access/role/delete', array(
            'id' => $entity->getId(),
        )));

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service->remove($entity);
                return $this->redirect()->toRoute('company/access');
            }
        }

        return array(
            'form' => $form,
            'role' => $entity,
        );
    }

    public function updateAction()
    {
        $service = $this->getServiceLocator()->get('PixPolUser\Service\Role');
        $entity = $service->find($this->params('id'));

        if (!$entity) {
            return $this->redirect()->toRoute('company/access');
        }

        $form = $this->getServiceLocator()->get('PixPolSubdomainCompany\Form\RoleForm');
        $form->setAttribute('action', $this->url()->fromRoute('company/access/role/update', array(
            'id' => $entity->getId(),
        )));
        $form->bind($entity);

        $request = $this->getRequest();

        if ($request->isPost()) {
            $entity->clearPermissions();
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service->persist($entity);

                return $this->redirect()->toRoute('company/access');
            }
        }

        return array(
            'form' => $form,
            'role' => $entity,
        );
    }
}
