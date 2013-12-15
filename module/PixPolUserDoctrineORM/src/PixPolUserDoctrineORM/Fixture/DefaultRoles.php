<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUserDoctrineORM\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use PixPolUser\Entity\Role;

class DefaultRoles implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
//        $this->createRole($manager, 'owner', array(
//            'create'
//        ));
//
//        $manager->persist($role);
//        $manager->flush();
    }

    private function createRole(ObjectManager $manager, $name, array $permissions)
    {
        $permission = new Role();
        $permission->setName($name);
        $manager->persist($permission);
    }

    private function createPermission(ObjectManager $manager, $name)
    {
        $permission = new Permission();
        $permission->setName($name);
        $manager->persist($permission);
    }
}
