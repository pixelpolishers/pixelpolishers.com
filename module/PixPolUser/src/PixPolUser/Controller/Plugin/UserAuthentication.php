<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Controller\Plugin;

use PixPolUser\Service\UserService;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class UserAuthentication extends AbstractPlugin implements ServiceManagerAwareInterface
{
    const AUTH_SERVICE_NAME = 'Zend\Authentication\AuthenticationService';
    const USER_SERVICE_NAME = 'PixPolUserService';

    protected $authAdapter;
    protected $authService;
    protected $userService;
    protected $serviceManager;
    protected $storage;

    public function hasIdentity()
    {
        return $this->getAuthService()->hasIdentity();
    }

    public function getId()
    {
        if ($this->getAuthService()->hasIdentity()) {
            return $this->getAuthService()->getIdentity()->getId();
        }
        return null;
    }

    public function getIdentity()
    {
        return $this->getAuthService()->getIdentity();
    }

    public function getAuthService()
    {
        if (null === $this->authService) {
            $authService = $this->getServiceManager()->get(self::AUTH_SERVICE_NAME);
            $this->setAuthService($authService);
        }
        return $this->authService;
    }

    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
        return $this;
    }

    public function getServiceManager()
    {
        return $this->serviceManager->getServiceLocator();
    }

    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    public function getUserService()
    {
        if (null === $this->userService) {
            $userService = $this->getServiceManager()->get(self::USER_SERVICE_NAME);
            $this->setUserService($userService);
        }
        return $this->userService;
    }

    public function setUserService(UserService $userService)
    {
        $this->userService = $userService;
        return $this;
    }

    public function signOut()
    {
        $this->getAuthService()->clearIdentity();
    }

    public function signIn($identity, $credential)
    {
        $self = $this;
        $result = false;
        $authService = $this->getAuthService();

        $adapter = $authService->getAdapter();
        $adapter->setIdentityValue($identity);
        $adapter->setCredentialValue($credential);
        $adapter->getOptions()->setCredentialCallable(function($identity, $credentialValue) use($self) {
            var_dump($self);exit;
            return $self->getUserService()->verifyPassword($identity, $credentialValue);
        });

        $authResult = $authService->authenticate($adapter);
        if ($authResult->isValid()) {
            $result = true;

            // Write the identity to the storage device:
            $authService->getStorage()->write($authResult->getIdentity());
        }

        return $result;
    }

}
