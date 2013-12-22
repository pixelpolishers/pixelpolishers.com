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
use PixPolTag\Entity\Tag;
use PixPolUser\Entity\User;
use PixPolUser\Service\UserPassword;

class DefaultUsers implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $employeeTag = new Tag();
        $employeeTag->setTag('employee');
        $manager->persist($employeeTag);

        $password = new UserPassword();

        $user = new User();
        $user->setEmail('no-reply@pixelpolishers.com');
        $user->setName('Walter');
        $user->setSurname('Tamboer');
        $user->setPassword($password->create('test'));
        $user->setRegistrationDate(new \DateTime());
        $user->addTag($employeeTag);

        $manager->persist($user);
        $manager->flush();
    }
}
