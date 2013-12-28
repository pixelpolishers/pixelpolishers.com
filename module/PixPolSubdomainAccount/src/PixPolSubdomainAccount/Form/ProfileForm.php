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
use Zend\Stdlib\Hydrator\ClassMethods;

class ProfileForm extends Form
{
    private $inputFilter;

    public function __construct()
    {
        parent::__construct('profile');

        $this->inputFilter = new InputFilter();

        $this->setHydrator(new ClassMethods(false));

        $this->addNameElement();
        $this->addSurnameElement();
        $this->addEmailElement();
        $this->addEmailValidationElement();
        $this->addCurrentPassword();
        $this->addSubmitElement();
    }

    private function addNameElement($name = 'name')
    {
        $element = new Text($name);
        $element->setLabel('Name');
        $this->add($element);

        $input = new Input($name);
        $this->inputFilter->add($input);
    }

    private function addSurnameElement($name = 'surname')
    {
        $element = new Text($name);
        $element->setLabel('Surname');
        $this->add($element);

        $input = new Input($name);
        $this->inputFilter->add($input);
    }

    private function addEmailElement($name = 'email')
    {
        $element = new Text($name);
        $element->setLabel('E-mail');
        $this->add($element);

        $input = new Input($name);
        $input->getValidatorChain()->attachByName('EmailAddress');
        $this->inputFilter->add($input);
    }

    private function addEmailValidationElement($name = 'emailValidation')
    {
        $element = new Text($name);
        $element->setLabel('E-mail validation');
        $this->add($element);

        $input = new Input($name);
        $input->getValidatorChain()->attachByName('EmailAddress');
        $input->getValidatorChain()->attachByName('Identical', array(
            'token' => 'email',
        ));
        $this->inputFilter->add($input);
    }

    private function addCurrentPassword($name = 'currentPassword')
    {
        $element = new Password($name);
        $element->setLabel('Current password');
        $this->add($element);

        $input = new Input($name);
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
