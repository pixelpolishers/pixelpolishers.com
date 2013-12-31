<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForumDoctrineORM\Mapper;

use PixPolDoctrineORM\Mapper\AbstractMapper;
use PixPolForum\Entity\Post;
use PixPolForum\Mapper\PostMapperInterface;

class PostMapperDoctrineORM extends AbstractMapper implements PostMapperInterface
{
    public function getClassName()
    {
        return 'PixPolForum\Entity\Post';
    }

    public function persist(Post $post)
    {
        $this->em->persist($post);
        $this->em->flush();
    }

    public function remove(Post $post)
    {
        $this->em->remove($post);
        $this->em->flush();
    }
}
