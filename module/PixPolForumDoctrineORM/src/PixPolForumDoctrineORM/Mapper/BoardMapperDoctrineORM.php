<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForumDoctrineORM\Mapper;

use PixPolDoctrineORM\Mapper\AbstractMapper;
use PixPolForum\Entity\Board;
use PixPolForum\Mapper\BoardMapperInterface;

class BoardMapperDoctrineORM extends AbstractMapper implements BoardMapperInterface
{
    public function getClassName()
    {
        return 'PixPolForum\Entity\Board';
    }

    public function persist(Board $board)
    {
        $this->em->persist($board);
        $this->em->flush();
    }

    public function remove(Board $board)
    {
        $this->em->remove($board);
        $this->em->flush();
    }
}
