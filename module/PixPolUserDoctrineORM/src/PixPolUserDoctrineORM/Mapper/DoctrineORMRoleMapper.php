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
use PixPolUser\Entity\Role;
use PixPolUser\Mapper\RoleMapperInterface;

class DoctrineORMRoleMapper extends AbstractMapper implements RoleMapperInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getClassName()
    {
        return 'PixPolUser\Entity\Role';
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
