<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainWww\Form;

use Zend\Form\Form;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class ContactForm extends Form
{
    private $inputFilter;

    public function __construct()
    {
        parent::__construct('contact');

        $this->inputFilter = new InputFilter();

        $this->addSubjectElement();
        $this->addNameElement();
        $this->addEmailElement();
        $this->addMessageElement();
        $this->addSubmitElement();
    }

    private function addSubjectElement($name = 'subject')
    {
        $element = new Text($name);
        $element->setLabel('Subject');
        $element->setAttribute('id', $name);
        $this->add($element);

        $input = new Input($name);
        $input->getFilterChain()->attachByName('StripTags');
        $this->inputFilter->add($input);
    }

    private function addNameElement($name = 'name')
    {
        $element = new Text($name);
        $element->setLabel('Name');
        $element->setAttribute('id', $name);
        $this->add($element);

        $input = new Input($name);
        $input->getFilterChain()->attachByName('StripTags');
        $this->inputFilter->add($input);
    }

    private function addEmailElement($name = 'email')
    {
        $element = new Text($name);
        $element->setLabel('E-mail');
        $element->setAttribute('id', $name);
        $this->add($element);

        $input = new Input($name);
        $input->getValidatorChain()->attachByName('EmailAddress');
        $this->inputFilter->add($input);
    }

    private function addMessageElement($name = 'message')
    {
        $element = new Textarea($name);
        $element->setLabel('Message');
        $element->setAttribute('id', $name);
        $this->add($element);

        $input = new Input($name);
        $input->getFilterChain()->attachByName('StripTags');
        $this->inputFilter->add($input);
    }

    private function addSubmitElement($name = 'send')
    {
        $submitElement = new Submit($name);
        $submitElement->setValue('Send');
        $this->add($submitElement);
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}
