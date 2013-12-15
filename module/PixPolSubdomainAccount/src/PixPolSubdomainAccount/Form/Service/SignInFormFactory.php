<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Form\Service;

use PixPolSubdomainAccount\Form\SignInForm;
use PixPolUser\Validator\UserExists;
use PixPolUser\Validator\VerifyPassword;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SignInFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new SignInForm();

//        $emailField = $form->getInputFilter()->get('email');
//        $passwordField = $form->getInputFilter()->get('password');
//
//        $userValidator = new UserExists($serviceLocator->get('PixPolUserMapper'));
//        $validatorChain = $emailField->getValidatorChain();
//        $validatorChain->attach($userValidator);
//
//        $passwordValidator = new VerifyPassword($serviceLocator->get('PixPolUserService'), $emailField);
//        $validatorChain = $passwordField->getValidatorChain();
//        $validatorChain->attach($passwordValidator);

        return $form;
    }
}
