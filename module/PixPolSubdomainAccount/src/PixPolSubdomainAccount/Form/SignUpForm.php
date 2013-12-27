<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Form;

use PixPolUser\Entity\User;
use Zend\Form\Form;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods;

class SignUpForm extends Form
{
    private $inputFilter;

    public function __construct()
    {
        parent::__construct('signup');

        $this->inputFilter = new InputFilter();

        $this->setObject(new User());
        $this->setHydrator(new ClassMethods(false));

        $this->addNameElement();
        $this->addSurnameElement();
        $this->addEmailElement();
        $this->addEmailValidationElement();
        $this->addAgreeElement();
        $this->addSubmitElement();
    }

    private function addNameElement()
    {
        $nameElement = new Text('name');
        $nameElement->setLabel('Name');
        $this->add($nameElement);

        $input = new Input('name');
        $input->getFilterChain()->attachByName('StripNewLines');
        $input->getFilterChain()->attachByName('StripTags');
        $this->inputFilter->add($input);
    }

    private function addSurnameElement()
    {
        $surnameElement = new Text('surname');
        $surnameElement->setLabel('Surname');
        $this->add($surnameElement);

        $input = new Input('surname');
        $input->getFilterChain()->attachByName('StripNewLines');
        $input->getFilterChain()->attachByName('StripTags');
        $this->inputFilter->add($input);
    }

    private function addEmailElement()
    {
        $emailElement = new Text('email');
        $emailElement->setLabel('E-mail address');
        $this->add($emailElement);

        $input = new Input('email');
        $input->getValidatorChain()->attachByName('EmailAddress');
        $this->inputFilter->add($input);
    }

    private function addEmailValidationElement()
    {
        $emailValidationElement = new Text('emailValidation');
        $emailValidationElement->setLabel('Re-enter e-mail address');
        $this->add($emailValidationElement);

        $input = new Input('emailValidation');
        $input->getValidatorChain()->attachByName('EmailAddress');
        $input->getValidatorChain()->attachByName('Identical', array(
            'token' => 'email',
        ));
        $this->inputFilter->add($input);
    }

    private function addAgreeElement($name = 'agree')
    {
        $agreeElement = new Checkbox($name);
        $agreeElement->setLabel('I agree to the Terms of Use and Privacy Policy.');
        $agreeElement->setCheckedValue('agreed');
        $agreeElement->setAttribute('id', $name);
        $this->add($agreeElement);

        $input = new Input($name);
        $input->getValidatorChain()->attachByName('Identical', array(
            'token' => 'agreed',
        ));
        $input->setErrorMessage('You must agree to the Terms of Use and Privacy Policy');
        $this->inputFilter->add($input);
    }

    private function addSubmitElement()
    {
        $submitElement = new Submit('signup');
        $submitElement->setValue('Sign Up');
        $this->add($submitElement);
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}
