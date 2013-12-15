<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Role
{
    private $id;
    private $name;
    private $permissions;

    public function __construct()
    {
        $this->clearPermissions();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function addPermission(Permission $permission)
    {
        $this->permissions->add($permission);
    }

    public function clearPermissions()
    {
        $this->permissions = new ArrayCollection();
    }

    public function getPermissions()
    {
        return $this->permissions;
    }

    public function setPermissions($permissions)
    {
        $this->clearPermissions();
        foreach ($permissions as $permission) {
            $this->addPermission($permission);
        }
    }

    public function removePermission(Permission $permission)
    {
        $this->permissions->removeElement($permission);
    }
}
