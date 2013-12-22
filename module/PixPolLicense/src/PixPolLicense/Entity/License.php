<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolLicense\Entity;

use PixPolUser\Entity\User;

class License
{
    private $id;
    private $name;
    private $description;
    private $users;

    public function __construct()
    {
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function addUser(User $user)
    {
        $this->getUsers()->add($user);
    }

    public function clearUsers()
    {
        $this->getUsers()->clear();
    }

    public function getUsers()
    {
        if ($this->users === null) {
            $this->users = new ArrayCollection();
        }
        return $this->users;
    }

    public function setUsers($users)
    {
        $this->clearUsers();
        foreach ($users as $user) {
            $this->addUser($user);
        }
    }

    public function removeUser(User $user)
    {
        $this->getUsers()->removeElement($user);
    }
}
