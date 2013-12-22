<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Service;

use PixPolUser\Service\AccessService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AccessServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $authService = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        $provider = $serviceLocator->get('PixPolUserRoleProvider');

        return new AccessService($provider, $authService->getIdentity());
    }
}
