<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany\Form;

use Zend\Form\Element\Submit;
use Zend\Form\Form;

class SubmitForm extends Form
{
    public function __construct()
    {
        parent::__construct('submit_form');

        $this->addSubmitElement();
    }

    private function addSubmitElement($name = 'submit')
    {
        $submitElement = new Submit($name);
        $submitElement->setValue('Yes');
        $this->add($submitElement);
    }
}
