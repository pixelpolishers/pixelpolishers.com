<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Service;

use PixPolUser\Entity\User;
use PixPolUser\Provider\RoleProviderInterface;
use Zend\Permissions\Rbac\Rbac;

class AccessService extends Rbac
{
    private $currentUser;

    public function __construct(RoleProviderInterface $provider, User $currentUser = null)
    {
        $this->currentUser = $currentUser;

        $provider->provide($this);
    }

    public function canCurrentUser($permission, $user = null)
    {
        if (!$user) {
            $user = $this->currentUser;
        }

        if (!$user) {
            return false;
        }

        foreach ($user->getRoles() as $role) {
            $rbacRole = $this->getRole($role->getName());
            if ($rbacRole && $rbacRole->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }
}
