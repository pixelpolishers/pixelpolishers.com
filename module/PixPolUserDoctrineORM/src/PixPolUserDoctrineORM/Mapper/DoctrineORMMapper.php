<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUserDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager;
use PixPolUser\Entity\User;
use PixPolUser\Mapper\MapperInterface;

class DoctrineORMMapper implements MapperInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function findByEmail($email)
    {
        $repository = $this->em->getRepository('PixPolUser\Entity\User');

        return $repository->findOneBy(array(
            'email' => $email,
        ));
    }

    public function persist(User $user)
    {
        $this->em->persist($user);
        $this->em->flush();
    }
}
