<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany\Form;

use PixPolUser\Entity\Role;
use Zend\Form\Form;
use Zend\Form\Element\MultiCheckbox;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods;

class RoleForm extends Form
{
    private $inputFilter;
    private $permissions;

    public function __construct(array $permissions)
    {
        parent::__construct('access_role');

        $this->inputFilter = new InputFilter();
        $this->permissions = $permissions;

        $this->setHydrator(new ClassMethods(false));
        $this->setObject(new Role());

        $this->addNameElement();
        $this->addDescriptionElement();
        $this->addPermissionsElement();
        $this->addSubmitElement();
    }

    private function addNameElement($name = 'name')
    {
        $element = new Text($name);
        $element->setLabel('Name');
        $this->add($element);

        $input = new Input($name);
        $input->setRequired(true);
        $this->inputFilter->add($input);
    }

    private function addDescriptionElement($name = 'description')
    {
        $element = new Textarea($name);
        $element->setLabel('Description');
        $this->add($element);

        $input = new Input($name);
        $input->setRequired(false);
        $this->inputFilter->add($input);
    }

    private function addPermissionsElement($name = 'permissions')
    {
        $element = new MultiCheckbox($name);
        $element->setLabel('Permissions');
        $element->setValueOptions($this->permissions);
        $this->add($element);

        $input = new Input($name);
        $input->setRequired(false);
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
