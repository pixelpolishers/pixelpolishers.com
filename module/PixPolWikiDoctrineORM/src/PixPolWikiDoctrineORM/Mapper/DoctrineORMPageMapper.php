<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolWikiDoctrineORM\Mapper;

use PixPolDoctrineORM\Mapper\AbstractMapper;
use PixPolWiki\Entity\Page;
use PixPolWiki\Mapper\PageMapperInterface;

class DoctrineORMPageMapper extends AbstractMapper implements PageMapperInterface
{
    public function getClassName()
    {
        return 'PixPolWiki\Entity\Page';
    }

    public function persist(Page $role)
    {
        $this->em->persist($role);
        $this->em->flush();
    }

    public function remove(Page $role)
    {
        $this->em->remove($role);
        $this->em->flush();
    }
}
