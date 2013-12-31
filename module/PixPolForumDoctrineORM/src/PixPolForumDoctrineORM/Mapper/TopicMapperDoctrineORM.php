<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForumDoctrineORM\Mapper;

use PixPolDoctrineORM\Mapper\AbstractMapper;
use PixPolForum\Entity\Topic;
use PixPolForum\Mapper\TopicMapperInterface;

class TopicMapperDoctrineORM extends AbstractMapper implements TopicMapperInterface
{
    public function getClassName()
    {
        return 'PixPolForum\Entity\Topic';
    }

    public function persist(Topic $topic)
    {
        $this->em->persist($topic);
        $this->em->flush();
    }

    public function remove(Topic $topic)
    {
        $this->em->remove($topic);
        $this->em->flush();
    }
}
