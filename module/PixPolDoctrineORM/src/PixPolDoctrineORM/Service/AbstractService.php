<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolDoctrineORM\Service;

abstract class AbstractService
{
    protected $mapper;

    public function __construct($mapper)
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

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->mapper->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria)
    {
        return $this->mapper->findOneBy($criteria);
    }

    public function persist($instance)
    {
        $this->mapper->persist($instance);
    }

    public function remove($instance)
    {
        $this->mapper->remove($instance);
    }
}
