<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class LicenseController extends AbstractActionController
{
    public function indexAction()
    {
        $licenseService = $this->getServiceLocator()->get('PixPolLicenseService');

        return array(
            'licenses' => $licenseService->findAll(),
        );
    }

    public function createAction()
    {
        $form = $this->getServiceLocator()->get('PixPolSubdomainCompany\Form\LicenseForm');
        $form->setAttribute('action', $this->url()->fromRoute('company/license/create'));

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get('PixPolLicenseService');
                $service->persist($form->getData());

                return $this->redirect()->toRoute('company/license');
            }
        }

        return array(
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $service = $this->getServiceLocator()->get('PixPolLicenseService');
        $entity = $service->find($this->params('id'));

        if (!$entity) {
            return $this->redirect()->toRoute('company/license');
        }

        $form = $this->getServiceLocator()->get('PixPolSubdomainCompany\Form\SubmitForm');
        $form->setAttribute('action', $this->url()->fromRoute('company/license/delete', array(
            'id' => $entity->getId(),
        )));

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service->remove($entity);
                return $this->redirect()->toRoute('company/license');
            }
        }

        return array(
            'form' => $form,
            'license' => $entity,
        );
    }

    public function updateAction()
    {
        $service = $this->getServiceLocator()->get('PixPolLicenseService');
        $entity = $service->find($this->params('id'));

        if (!$entity) {
            return $this->redirect()->toRoute('company/license');
        }

        $form = $this->getServiceLocator()->get('PixPolSubdomainCompany\Form\LicenseForm');
        $form->setAttribute('action', $this->url()->fromRoute('company/license/update', array(
            'id' => $entity->getId(),
        )));
        $form->bind($entity);

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service->persist($entity);

                return $this->redirect()->toRoute('company/license');
            }
        }

        return array(
            'form' => $form,
            'license' => $entity,
        );
    }
}
