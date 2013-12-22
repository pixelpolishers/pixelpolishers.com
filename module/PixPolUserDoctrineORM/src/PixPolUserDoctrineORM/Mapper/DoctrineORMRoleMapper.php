<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUserDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager;
use PixPolUser\Entity\Role;
use PixPolUser\Mapper\RoleMapperInterface;

class DoctrineORMRoleMapper implements RoleMapperInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function find($id)
    {
        $repository = $this->em->getRepository('PixPolUser\Entity\Role');

        return $repository->find($id);
    }

    public function findAll()
    {
        $repository = $this->em->getRepository('PixPolUser\Entity\Role');

        return $repository->findAll();
    }

    public function persist(Role $role)
    {
        $this->em->persist($role);
        $this->em->flush();
    }

    public function remove(Role $role)
    {
        $this->em->remove($role);
        $this->em->flush();
    }
}
