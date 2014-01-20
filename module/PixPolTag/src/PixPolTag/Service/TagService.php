<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolTag\Service;

use PixPolTag\Mapper\MapperInterface;
use PixPolTag\Entity\Tag;

class TagService
{
    private $mapper;

    public function __construct(MapperInterface $mapper)
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

    public function persist(Tag $tag)
    {
        return $this->mapper->persist($tag);
    }

    public function remove(Tag $tag)
    {
        return $this->mapper->remove($tag);
    }
}
