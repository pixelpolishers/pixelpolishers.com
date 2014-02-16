<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Service;

use PixPolForum\Entity\Topic;
use PixPolForum\Mapper\BookmarkMapperInterface;
use PixPolUser\Entity\User;

class BookmarkService
{
    private $mapper;

    public function __construct(BookmarkMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function doesUserHaveTopic(Topic $topic, User $user = null)
    {
        if (!$user) {
            return false;
        }

        $bookmark = $this->mapper->find(array(
            'topic' => $topic->getId(),
            'user' => $user->getId(),
        ));

        return $bookmark != null;
    }

    public function getLatest($amount, User $user)
    {
        return $this->mapper->findBy(array(
            'user' => $user->getId(),
        ), null, $amount);
    }
}
