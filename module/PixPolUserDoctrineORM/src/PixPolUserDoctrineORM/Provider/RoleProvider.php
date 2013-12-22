<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUserDoctrineORM\Provider;

use Doctrine\ORM\EntityManager;
use PixPolUser\Entity\Permission;
use PixPolUser\Provider\RoleProviderInterface;
use PixPolUser\Service\AccessService;

class RoleProvider implements RoleProviderInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function provide(AccessService $accessService)
    {
        $repository = $this->em->getRepository('PixPolUser\Entity\Role');

        foreach ($repository->findAll() as $role) {
            $rbacRole = $accessService->addRole($role->getName())->getRole($role->getName());

            $this->providePermissions($rbacRole, $role->getPermissions());
        }
    }

    private function providePermissions($role, $permissions)
    {
        foreach ($permissions as $permission) {
            if (is_array($permission)) {
                $this->providePermissions($role, $permission);
            } else {
                if ($permission instanceof Permission) {
                    $permission = $permission->getName();
                }

                $role->addPermission($permission);
            }
        }
    }
}
