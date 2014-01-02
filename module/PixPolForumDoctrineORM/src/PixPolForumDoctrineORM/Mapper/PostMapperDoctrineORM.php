<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForumDoctrineORM\Mapper;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use PixPolDoctrineORM\Mapper\AbstractMapper;
use PixPolForum\Entity\Post;
use PixPolForum\Entity\Topic;
use PixPolForum\Mapper\PostMapperInterface;
use Zend\Paginator\Paginator;

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

    public function getPostPaginator(Topic $topic)
    {
        $query = $this->em->createQuery('SELECT p FROM PixPolForum\Entity\Post p WHERE p.topic = ?1');
        $query->setParameter(1, $topic);

        $adapter = new DoctrinePaginator(new ORMPaginator($query));

        return new Paginator($adapter);
    }

}
