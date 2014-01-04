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
use PixPolForum\Entity\Board;
use PixPolForum\Entity\Topic;
use PixPolForum\Mapper\TopicMapperInterface;
use Zend\Paginator\Paginator;

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

    public function getTopicPaginator(Board $board)
    {
        $query = $this->em->createQuery('
            SELECT t
            FROM PixPolForum\Entity\Topic t
            LEFT JOIN t.lastPost p
            WHERE t.board = ?1
            ORDER BY t.sticky DESC, p.createdOn DESC');
        $query->setParameter(1, $board);

        $adapter = new DoctrinePaginator(new ORMPaginator($query));

        return new Paginator($adapter);
    }
}
