<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForumDoctrineORM\Mapper;

use PixPolDoctrineORM\Mapper\AbstractMapper;
use PixPolForum\Entity\Bookmark;
use PixPolForum\Mapper\BookmarkMapperInterface;

class BookmarkMapperDoctrineORM extends AbstractMapper implements BookmarkMapperInterface
{
    public function getClassName()
    {
        return 'PixPolForum\Entity\Bookmark';
    }

    public function persist(Bookmark $bookmark)
    {
        $this->em->persist($bookmark);
        $this->em->flush();
    }

    public function remove(Bookmark $bookmark)
    {
        $this->em->remove($bookmark);
        $this->em->flush();
    }
}
