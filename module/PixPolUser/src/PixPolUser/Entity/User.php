<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

class User
{
    private $id;
    private $email;
    private $password;
    private $name;
    private $surname;
    private $registrationDate;
    private $roles;

    public function __construct()
    {
        $this->clearRoles();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getDisplayName()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate($registrationDate)
    {
        if (!($registrationDate instanceof DateTime)) {
            $registrationDate = new DateTime($registrationDate);
        }
        $this->registrationDate = $registrationDate;
    }

    public function addRole(Role $role)
    {
        $this->roles->add($role);
    }

    public function clearRoles()
    {
        $this->roles = new ArrayCollection();
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->clearRoles();
        foreach ($roles as $role) {
            $this->addRole($role);
        }
    }

    public function removeRole(Role $role)
    {
        $this->roles->removeElement($role);
    }
}
