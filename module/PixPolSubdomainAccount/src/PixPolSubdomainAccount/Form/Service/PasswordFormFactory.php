<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Form\Service;

use PixPolSubdomainAccount\Form\PasswordForm;
use PixPolUser\Validator\VerifyPassword;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PasswordFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $form = new PasswordForm();

        $userAuthService = $serviceLocator->get('PixPolAccessService');
        $identity = $userAuthService->getCurrentUser();

        $passwordValidator = new VerifyPassword($serviceLocator->get('PixPolUserService'), $identity->getEmail());

        $passwordField = $form->getInputFilter()->get('currentPassword');
        $validatorChain = $passwordField->getValidatorChain();
        $validatorChain->attach($passwordValidator);

        return $form;
    }
}
