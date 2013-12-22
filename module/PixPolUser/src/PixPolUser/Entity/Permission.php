<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Entity;

class Permission
{
    private $module;
    private $name;

    public function __construct($module, $name)
    {
        $this->module = $module;
        $this->name = $name;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getName()
    {
        return $this->name;
    }
}
