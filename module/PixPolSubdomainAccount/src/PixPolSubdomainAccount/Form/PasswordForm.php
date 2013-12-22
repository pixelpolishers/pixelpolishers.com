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
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class PasswordForm extends Form
{
    private $inputFilter;

    public function __construct()
    {
        parent::__construct('password');

        $this->inputFilter = new InputFilter();

        $this->addPasswordElement();
        $this->addPasswordValidationElement();
        $this->addSubmitElement();
    }

    private function addPasswordElement($name = 'password')
    {
        $element = new Password($name);
        $element->setLabel('Password');
        $this->add($element);

        $input = new Input($name);
        $this->inputFilter->add($input);
    }

    private function addPasswordValidationElement($name = 'passwordValidation')
    {
        $element = new Password($name);
        $element->setLabel('Password validation');
        $this->add($element);

        $input = new Input($name);
        $input->getValidatorChain()->attachByName('Identical', array(
            'token' => 'password',
        ));
        $this->inputFilter->add($input);
    }

    private function addSubmitElement($name = 'save')
    {
        $submitElement = new Submit($name);
        $submitElement->setValue('Save');
        $this->add($submitElement);
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}
