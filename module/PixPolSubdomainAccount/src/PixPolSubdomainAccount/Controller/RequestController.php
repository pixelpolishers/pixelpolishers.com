<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Controller;

use PixPolSubdomainAccount\Email\RequestPasswordEmail;
use Zend\Mvc\Controller\AbstractActionController;

class RequestController extends AbstractActionController
{
    public function passwordAction()
    {
        $user = $this->ppUserAuth()->getIdentity();
        if ($user) {
            return $this->redirect()->toRoute('account/index');
        }

        $form = $this->getServiceLocator()->get('PixPolSubdomainAccount\Form\RequestPasswordForm');
        $form->setAttribute('action', $this->url()->fromRoute('account/request-password'));

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get('PixPolUserService');
                $user = $service->findByEmail($form->get('email')->getValue());

                if ($user) {
                    $password = $this->ppUserService()->resetPassword($user);

                    $email = new RequestPasswordEmail($user, $password);
                    $email->setTopBarColor('#008000');
                    $email->setSubBarColor('#70BA4F');
                    $email->send();
                }

                return $this->redirect()->toRoute('account/index');
            }
        }

        return array(
            'form' => $form,
            'user' => $user,
        );
    }
}
