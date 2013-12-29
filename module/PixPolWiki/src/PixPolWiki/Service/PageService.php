<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolWiki\Service;

use PixPolWiki\Mapper\PageMapperInterface;

class PageService
{
    private $mapper;

    public function __construct(PageMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }
}
