<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUserDoctrineORM\Mapper;

use PixPolDoctrineORM\Mapper\AbstractMapper;
use PixPolUser\Entity\User;
use PixPolUser\Mapper\UserMapperInterface;

class DoctrineORMUserMapper extends AbstractMapper implements UserMapperInterface
{
    public function getClassName()
    {
        return 'PixPolUser\Entity\User';
    }

    public function persist(User $user)
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    public function remove(User $user)
    {
        $this->em->remove($user);
        $this->em->flush();
    }

    public function getAZUsers($letter)
    {
        $query = $this->em->createQuery("
            SELECT u
            FROM PixPolUser\Entity\User u
            WHERE u.surname LIKE ?1
            ORDER BY u.surname ASC");

        $query->setParameter(1, $letter . '%');

        return $query->getResult();
    }
}
