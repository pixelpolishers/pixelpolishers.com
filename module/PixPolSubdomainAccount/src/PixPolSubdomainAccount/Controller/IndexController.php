<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        if ($this->ppUserAuth()->hasIdentity()) {
            $this->redirect()->toRoute('account/dashboard');
        }

        return array();
    }

    public function dashboardAction()
    {
        return array(
            'user' => $this->ppUserAuth()->getIdentity(),
        );
    }

    public function passwordAction()
    {
        $user = $this->ppUserAuth()->getIdentity();
        if (!$user) {
            return $this->redirect()->toRoute('account/signin');
        }

        $form = $this->getServiceLocator()->get('PixPolSubdomainAccount\Form\PasswordForm');
        $form->setAttribute('action', $this->url()->fromRoute('account/password'));

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get('PixPolUserService');
                $password = $service->getPassword()->create($form->get('password')->getValue());
                $user->setPassword($password);
                $service->persist($user);

                return $this->redirect()->toRoute('account/index');
            }
        }

        return array(
            'form' => $form,
            'user' => $user,
        );
    }

}
