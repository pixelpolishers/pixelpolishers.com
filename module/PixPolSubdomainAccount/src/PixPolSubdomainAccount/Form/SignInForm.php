<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Form;

use Zend\Form\Form;
use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class SignInForm extends Form
{
    private $inputFilter;

    public function __construct()
    {
        parent::__construct('signin');

        $this->inputFilter = new InputFilter();

        $this->addIdentityElement();
        $this->addCredentialElement();
        $this->addSubmitElement();
    }

    private function addIdentityElement()
    {
        $element = new Text('identity');
        $element->setLabel('E-mail address');
        $this->add($element);

        $input = new Input('identity');
        $input->getValidatorChain()->attachByName('EmailAddress');
        $this->inputFilter->add($input);
    }

    private function addCredentialElement()
    {
        $element = new Password('credential');
        $element->setLabel('Password');
        $this->add($element);

        $input = new Input('credential');
        $this->inputFilter->add($input);
    }

    private function addSubmitElement()
    {
        $submitElement = new Submit('signin');
        $submitElement->setValue('Sign In');
        $this->add($submitElement);
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}
