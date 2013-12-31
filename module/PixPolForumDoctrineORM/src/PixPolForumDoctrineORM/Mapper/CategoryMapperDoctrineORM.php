<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForumDoctrineORM\Mapper;

use PixPolDoctrineORM\Mapper\AbstractMapper;
use PixPolForum\Entity\Category;
use PixPolForum\Mapper\CategoryMapperInterface;

class CategoryMapperDoctrineORM extends AbstractMapper implements CategoryMapperInterface
{
    public function getClassName()
    {
        return 'PixPolForum\Entity\Category';
    }

    public function persist(Category $category)
    {
        $this->em->persist($category);
        $this->em->flush();
    }

    public function remove(Category $category)
    {
        $this->em->remove($category);
        $this->em->flush();
    }
}
