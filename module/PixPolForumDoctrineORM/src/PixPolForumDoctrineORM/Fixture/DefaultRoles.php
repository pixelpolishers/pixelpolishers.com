<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForumDoctrineORM\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use PixPolUser\Entity\Role;

class DefaultRoles extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 600;
    }

    public function load(ObjectManager $manager)
    {
        $this->createRole($manager, 'Forum Moderator');

        $manager->flush();
    }

    private function createRole(ObjectManager $manager, $name)
    {
        $role = new Role();
        $role->setName($name);
        $role->setDescription('');
        $manager->persist($role);
    }
}
