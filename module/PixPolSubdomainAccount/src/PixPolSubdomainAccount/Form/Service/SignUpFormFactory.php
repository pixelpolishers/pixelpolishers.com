<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Form\Service;

use PixPolSubdomainAccount\Form\SignUpForm;
use PixPolUser\Validator\NoUserExists;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SignUpFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new SignUpForm();

        $mapper = $serviceLocator->get('PixPolUserMapper');
        $validator = new NoUserExists($mapper);
        $form->getInputFilter()->get('email')->getValidatorChain()->attach($validator);

        return $form;
    }
}
