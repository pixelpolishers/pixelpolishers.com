<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolDoctrineORM\Mapper;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Persistence\ObjectRepository;

abstract class AbstractMapper implements ObjectRepository
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function find($id)
    {
        $repository = $this->em->getRepository($this->getClassName());

        return $repository->find($id);
    }

    public function findAll()
    {
        $repository = $this->em->getRepository($this->getClassName());

        return $repository->findAll();
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        $repository = $this->em->getRepository($this->getClassName());

        return $repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findOneBy(array $criteria)
    {
        $repository = $this->em->getRepository($this->getClassName());

        return $repository->findOneBy($criteria);
    }
}
