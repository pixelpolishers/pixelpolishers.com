<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Entity;

class Topic
{
    private $id;
    private $board;
    private $sticky;
    private $locked;
    private $title;
    private $posts;
    private $createdOn;
    private $createdBy;
    private $tags;
    private $postCount;
    private $lastPost;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getBoard()
    {
        return $this->board;
    }

    public function setBoard($board)
    {
        $this->board = $board;
    }

    public function getSticky()
    {
        return $this->sticky;
    }

    public function isSticky()
    {
        return $this->getSticky();
    }

    public function setSticky($sticky)
    {
        $this->sticky = $sticky;
    }

    public function getLocked()
    {
        return $this->locked;
    }

    public function isLocked()
    {
        return $this->getLocked();
    }

    public function setLocked($locked)
    {
        $this->locked = $locked;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getPost($index)
    {
        $posts = $this->getPosts();

        return $posts[$index];
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getPostCount()
    {
        return $this->postCount;
    }

    public function setPostCount($postCount)
    {
        $this->postCount = $postCount;
    }

    public function getLastPost()
    {
        return $this->lastPost;
    }

    public function setLastPost($lastPost)
    {
        $this->lastPost = $lastPost;
    }
}
