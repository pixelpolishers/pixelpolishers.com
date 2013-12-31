<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Form;

use PixPolForum\Entity\Post;
use Zend\Form\Form;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods;

class ReplyForm extends Form
{
    private $inputFilter;

    public function __construct()
    {
        parent::__construct('reply');

        $this->setObject(new Post());
        $this->setHydrator(new ClassMethods(false));

        $this->inputFilter = new InputFilter();

        $this->createContentElement();
        $this->createSubmitElement();
    }

    private function createContentElement($name = 'content')
    {
        $element = new Textarea($name);
        $element->setLabel('Content');
        $this->add($element);

        $input = new Input($name);
        $this->inputFilter->add($input);
    }

    private function createSubmitElement($name = 'reply')
    {
        $element = new Submit($name);
        $element->setValue('Reply');
        $this->add($element);
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}
