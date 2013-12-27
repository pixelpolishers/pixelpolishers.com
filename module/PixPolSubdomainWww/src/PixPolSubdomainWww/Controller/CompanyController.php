<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainWww\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CompanyController extends AbstractActionController
{
    public function aboutAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function careersAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function contactAction()
    {
        $form = $this->getServiceLocator()->get('PixPolSubdomainWww\Form\ContactForm');

        $identity = $this->ppUserAuth()->getIdentity();
        if ($identity) {
            $form->get('name')->setValue($identity->getDisplayName());
            $form->get('email')->setValue($identity->getEmail());
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $config = $this->getServiceLocator()->get('Config');

                $subject = $form->get('subject')->getValue();
                $message = wordwrap($form->get('message')->getValue(), 70, "\r\n");
                $headers = 'From: webmaster@example.com' . "\r\n" .
                        'Reply-To: webmaster@example.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                if (@mail($config['contact']['address'], $subject, $message, $headers)) {
                    $this->flashMessenger()->addMessage('Your message has been sent.');
                } else {
                    $this->flashMessenger()->addErrorMessage('Your message was not sent. Please try to contact us via one of the social network channels.');
                }

                return $this->redirect()->toRoute('www/company/contact');
            }
        }

        return array(
            'form' => $form,
        );
    }

}
