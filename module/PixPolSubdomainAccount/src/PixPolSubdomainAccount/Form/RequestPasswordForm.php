<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Submit;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

class RequestPasswordForm extends Form
{
    private $inputFilter;

    public function __construct()
    {
        parent::__construct('request-password');

        $this->inputFilter = new InputFilter();

        $this->addEmailElement();
        $this->addSubmitElement();
    }

    private function addEmailElement($name = 'email')
    {
        $element = new Text($name);
        $element->setLabel('E-mail');
        $this->add($element);

        $input = new Input($name);
        $this->inputFilter->add($input);
    }

    private function addSubmitElement($name = 'request')
    {
        $submitElement = new Submit($name);
        $submitElement->setValue('Request');
        $this->add($submitElement);
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}
