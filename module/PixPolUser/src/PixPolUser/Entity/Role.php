<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Entity;

class Role
{
    private $id;
    private $name;
    private $description;
    private $permissions;

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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function addPermission($permission)
    {
        if ($permission instanceof Permission) {
            $permission = $permission->getName();
        }
        $this->permissions[] = $permission;
    }

    public function clearPermissions()
    {
        $this->permissions = array();
    }

    public function getPermissions()
    {
        return (array)$this->permissions;
    }

    public function setPermissions($permissions)
    {
        $this->clearPermissions();
        foreach ($permissions as $permission) {
            $this->addPermission($permission);
        }
    }

    public function removePermission($permission)
    {
        if ($permission instanceof Permission) {
            $permission = $permission->getName();
        }

        $key = array_search($permission, $this->permissions);

        unset($this->permissions[$key]);
    }
}
