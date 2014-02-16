<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ProfileController extends AbstractActionController
{
    public function indexAction()
    {
        $user = $this->ppUserAuth()->getIdentity();
        if (!$user) {
            return $this->redirect()->toRoute('account/signin');
        }

        $form = $this->getServiceLocator()->get('PixPolSubdomainAccount\Form\ProfileForm');
        $form->setAttribute('action', $this->url()->fromRoute('account/profile'));
        $form->bind($user);

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get('PixPolUser\Service\User');
                $service->persist($user);

                return $this->redirect()->toRoute('account/index');
            }
        }

        return array(
            'form' => $form,
            'user' => $user,
        );
    }

    public function viewAction()
    {
        $id = $this->params('user');

        $service = $this->getServiceLocator()->get('PixPolUser\Service\User');
        $user = $service->find($id);

        if (!$user) {
            return $this->notFoundAction();
        }

        return array(
            'user' => $this->ppUserAuth()->getIdentity(),
        );
    }
}
