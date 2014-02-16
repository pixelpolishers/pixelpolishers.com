<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Collection;

use ArrayIterator;
use PixPolUser\Entity\Role;

class RoleCollection implements \Countable, \IteratorAggregate
{
    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function add(Role $role)
    {
        $this->data[] = $role;
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
        return new ArrayIterator($this->data);
    }
}
