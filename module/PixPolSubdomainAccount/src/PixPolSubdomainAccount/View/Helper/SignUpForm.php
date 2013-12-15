<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\View\Helper;

use PixPolSubdomainAccount\Form;
use Zend\View\Helper\AbstractHelper;

class SignUpForm extends AbstractHelper
{
    private $signUpForm;

    public function __construct(Form\SignUpForm $form)
    {
        $this->signUpForm = $form;
    }

    public function __invoke()
    {
        $result = '';

        $action = $this->view->url('account/signup');

        $this->signUpForm->setAttribute('action', $action);
        $this->signUpForm->prepare();

        $result .= $this->view->form()->openTag($this->signUpForm);

        $result .= $this->view->formRow($this->signUpForm->get('name'));
        $result .= $this->view->formRow($this->signUpForm->get('surname'));
        $result .= $this->view->formRow($this->signUpForm->get('email'));
        $result .= $this->view->formRow($this->signUpForm->get('emailValidation'));
        $result .= 'Make sure you enter a valid e-mail address, your password will be e-mailed to this address.';
        $result .= $this->view->formRow($this->signUpForm->get('agree'), \Zend\Form\View\Helper\FormRow::LABEL_APPEND);
        $result .= $this->view->formRow($this->signUpForm->get('signup'));

        $result .= $this->view->form()->closeTag();

        return $result;
    }
}
