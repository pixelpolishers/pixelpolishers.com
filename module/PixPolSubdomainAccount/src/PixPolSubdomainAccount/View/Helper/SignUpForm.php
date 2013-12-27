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

    public function __invoke($showCancel = false)
    {
        $result = '';

        $action = $this->view->url('account/signup');

        $this->signUpForm->setAttribute('action', $action);
        $this->signUpForm->prepare();

        $result .= $this->view->form()->openTag($this->signUpForm);

        $result .= $this->view->formLabel($this->signUpForm->get('name'));
        $result .= $this->view->formText($this->signUpForm->get('name'));
        $result .= $this->view->formElementErrors($this->signUpForm->get('name'), array(
            'class' => 'errors'
        ));

        $result .= $this->view->formLabel($this->signUpForm->get('surname'));
        $result .= $this->view->formText($this->signUpForm->get('surname'));
        $result .= $this->view->formElementErrors($this->signUpForm->get('surname'), array(
            'class' => 'errors'
        ));

        $result .= $this->view->formLabel($this->signUpForm->get('email'));
        $result .= $this->view->formText($this->signUpForm->get('email'));
        $result .= $this->view->formElementErrors($this->signUpForm->get('email'), array(
            'class' => 'errors'
        ));

        $result .= $this->view->formLabel($this->signUpForm->get('emailValidation'));
        $result .= $this->view->formText($this->signUpForm->get('emailValidation'));
        $result .= $this->view->formElementErrors($this->signUpForm->get('emailValidation'), array(
            'class' => 'errors'
        ));

        $result .= '<p>';
        $result .= 'Make sure you enter a valid e-mail address, your password will be e-mailed to
            this address.';
        $result .= '</p>';

        $result .= '<div class="agreement-box">';
        $result .= $this->view->formCheckbox($this->signUpForm->get('agree'));
        $result .= $this->view->formLabel($this->signUpForm->get('agree'));
        $result .= $this->view->formElementErrors($this->signUpForm->get('agree'), array(
            'class' => 'errors'
        ));
        $result .= '</div>';

        $result .= $this->view->formSubmit($this->signUpForm->get('signup'));
        if ($showCancel) {
            $result .= '&nbsp;<a href="' . $this->view->url('account/index') . '">Cancel</a>';
        }

        $result .= $this->view->form()->closeTag();

        return $result;
    }

}
