<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolLicenseDoctrineORM\Mapper;

use PixPolDoctrineORM\Mapper\AbstractMapper;
use PixPolLicense\Entity\License;
use PixPolLicense\Mapper\MapperInterface;

class DoctrineORMMapper extends AbstractMapper implements MapperInterface
{
    public function getClassName()
    {
        return 'PixPolLicense\Entity\License';
    }

    public function persist(License $license)
    {
        $this->em->persist($license);
        $this->em->flush();
    }

    public function remove(License $license)
    {
        $this->em->remove($license);
        $this->em->flush();
    }
}
