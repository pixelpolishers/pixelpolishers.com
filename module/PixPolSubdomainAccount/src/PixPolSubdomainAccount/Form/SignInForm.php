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

    private function addIdentityElement($name = 'identity')
    {
        $element = new Text($name);
        $element->setLabel('E-mail address');
        $element->setAttribute('id', $name);
        $this->add($element);

        $input = new Input($name);
        $input->getValidatorChain()->attachByName('EmailAddress');
        $this->inputFilter->add($input);
    }

    private function addCredentialElement($name = 'credential')
    {
        $element = new Password($name);
        $element->setLabel('Password');
        $element->setAttribute('id', $name);
        $this->add($element);

        $input = new Input($name);
        $this->inputFilter->add($input);
    }

    private function addSubmitElement($name = 'signin')
    {
        $submitElement = new Submit($name);
        $submitElement->setValue('Sign In');
        $this->add($submitElement);
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}
