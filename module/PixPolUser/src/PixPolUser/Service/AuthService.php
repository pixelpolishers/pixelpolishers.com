<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Service;

use PixPolUser\Service\UserService;
use Zend\Authentication\AuthenticationService;

class AuthService extends AuthenticationService
{
    private $cachedIdentity;

    private $userService;

    public function setUserService(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getIdentity()
    {
        $identity = parent::getIdentity();

        if ($this->cachedIdentity == null && $identity) {
            $this->cachedIdentity = $this->userService->find($identity);
        }

        return $this->cachedIdentity;
    }
}
