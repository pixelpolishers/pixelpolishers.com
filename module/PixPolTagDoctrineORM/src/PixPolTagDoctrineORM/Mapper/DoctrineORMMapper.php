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

class DoctrineORMMapper implements MapperInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}
