<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolTag\Collection;

use PixPolTag\Entity\Tag;

class TagCollection implements \Countable, \IteratorAggregate
{
    private $data;

    public function add(Tag $tag)
    {
        $this->data[] = $tag;
    }

    public function clear()
    {
        $this->data = array();
    }

    public function count()
    {
        return count($this->data);
    }

    public function getIterator()
    {
        return $this->data;
    }
}
