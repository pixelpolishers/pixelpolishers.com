<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Service;

use PixPolUser\Entity\User;
use Zend\Permissions\Rbac\Rbac;

class AccessService extends Rbac
{
    private $currentUser;

    public function __construct(User $currentUser = null)
    {
        $this->currentUser = $currentUser;
    }

    public function canCurrentUser($permission, $assertion = null)
    {
        if (!$this->currentUser) {
            return false;
        }

        return $this->canUser($this->currentUser, $permission, $assertion);
    }

    public function canUser(User $user, $permission, $assertion = null)
    {
        foreach ($user->getRoles() as $role) {
            if ($this->isGranted($role->getName(), $permission, $assertion)) {
                return true;
            }
        }

        return false;
    }

    public function getCurrentUser()
    {
        return $this->currentUser;
    }
}
