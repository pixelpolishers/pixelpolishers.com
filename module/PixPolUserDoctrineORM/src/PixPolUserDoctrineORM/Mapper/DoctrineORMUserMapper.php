<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUserDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager;
use PixPolDoctrineORM\Mapper\AbstractMapper;
use PixPolUser\Entity\User;
use PixPolUser\Mapper\UserMapperInterface;

class DoctrineORMUserMapper extends AbstractMapper implements UserMapperInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

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
}
