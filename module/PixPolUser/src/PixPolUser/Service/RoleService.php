<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Service;

use PixPolUser\Entity\Role;
use PixPolUser\Mapper\RoleMapperInterface;

class RoleService
{
    private $mapper;

    public function __construct(RoleMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function find($id)
    {
        return $this->mapper->find($id);
    }

    public function findAll()
    {
        return $this->mapper->findAll();
    }

    public function persist(Role $role)
    {
        return $this->mapper->persist($role);
    }

    public function remove(Role $role)
    {
        return $this->mapper->remove($role);
    }
}
