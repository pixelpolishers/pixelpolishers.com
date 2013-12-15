<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolLicense\Service;

use PixPolLicense\Mapper\MapperInterface;

class LicenseService
{
    private $mapper;

    public function __construct(MapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
}
