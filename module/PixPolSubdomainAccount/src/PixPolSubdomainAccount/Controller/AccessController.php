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
    public function signinAction()
    {
        if ($this->ppUserAuth()->hasIdentity()) {
            return $this->redirect()->toRoute('account/index');
        }

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
        if ($this->ppUserAuth()->hasIdentity()) {
            return $this->redirect()->toRoute('account/index');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form = $this->getServiceLocator()->get('PixPolSubdomainAccount\Form\SignUpForm');
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->ppUserService()->signUp($form->getData());
                return $this->redirect()->toRoute('account/signin');
            }
        }
        return array();
    }

    public function signoutAction()
    {
        if (!$this->ppUserAuth()->hasIdentity()) {
            return $this->redirect()->toRoute('account/index');
        }

        $this->ppUserAuth()->signOut();
        return array();
    }
}
