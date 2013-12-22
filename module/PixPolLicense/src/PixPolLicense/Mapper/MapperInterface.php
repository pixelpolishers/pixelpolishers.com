<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolLicense\Mapper;

use Doctrine\Common\Persistence\ObjectRepository;
use PixPolLicense\Entity\License;

interface MapperInterface extends ObjectRepository
{
    public function persist(License $license);
    public function remove(License $license);
}
