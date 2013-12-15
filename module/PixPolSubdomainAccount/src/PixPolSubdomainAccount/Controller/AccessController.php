<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AccessController extends AbstractActionController
{
    private function getUserService()
    {
        return $this->getServiceLocator()->get('PixPolUserService');
    }

    public function signinAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form = $this->getServiceLocator()->get('PixPolSubdomainAccount\Form\SignInForm');
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $identity = $form->get('identity')->getValue();
                $credential = $form->get('credential')->getValue();

                if ($this->ppUserAuth()->signIn($identity, $credential)) {
                    return $this->redirect()->toRoute('account/index');
                }
            }
        }
        return array();
    }

    public function signupAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form = $this->getServiceLocator()->get('PixPolSubdomainAccount\Form\SignUpForm');
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $userService = $this->getUserService();
                $userService->signUp($form->getData());
                return $this->redirect()->toRoute('account/signin');
            }
        }
        return array();
    }

    public function signoutAction()
    {
        $this->ppUserAuth()->signOut();
        return array();
    }
}
