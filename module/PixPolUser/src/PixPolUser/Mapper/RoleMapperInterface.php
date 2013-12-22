<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Mapper;

use Doctrine\Common\Persistence\ObjectRepository;
use PixPolUser\Entity\Role;

interface RoleMapperInterface extends ObjectRepository
{
    public function persist(Role $role);
    public function remove(Role $role);
}
