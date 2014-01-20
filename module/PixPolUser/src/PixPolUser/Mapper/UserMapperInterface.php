<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Mapper;

use Doctrine\Common\Persistence\ObjectRepository;
use PixPolUser\Entity\User;

interface UserMapperInterface extends ObjectRepository
{
    public function persist(User $user);
    public function remove(User $user);

    public function getAZUsers($letter);
}
