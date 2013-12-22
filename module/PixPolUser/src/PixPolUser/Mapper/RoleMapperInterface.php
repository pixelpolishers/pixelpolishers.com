<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Mapper;

use PixPolUser\Entity\Role;

interface RoleMapperInterface
{
    public function find($id);
    public function findAll();

    public function persist(Role $role);
    public function remove(Role $role);
}
