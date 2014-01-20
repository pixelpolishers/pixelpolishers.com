<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolTagDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager;
use PixPolTag\Mapper\MapperInterface;
use PixPolTag\Entity\Tag;

class DoctrineORMMapper implements MapperInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function find($id)
    {
        return $this->em->find($id);
    }

    public function findAll()
    {
        return $this->em->findAll();
    }

    public function persist(Tag $tag)
    {
        return $this->em->persist($tag);
    }

    public function remove(Tag $tag)
    {
        return $this->em->remove($tag);
    }
}
