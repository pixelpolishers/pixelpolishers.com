<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Entity;

use DateTime;
use PixPolTag\Collection\TagCollection;
use PixPolTag\Entity\Tag;
use PixPolUser\Collection\RoleCollection;

class User
{
    private $id;
    private $email;
    private $password;
    private $name;
    private $surname;
    private $displayName;
    private $githubAccount;
    private $twitterAccount;
    private $facebookUrl;
    private $linkedInUrl;
    private $registrationDate;
    private $roles;
    private $tags;

    public function __construct()
    {
        $this->clearRoles();
        $this->clearTags();
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
        if (!$this->displayName) {
            return $this->name . ' ' . $this->surname;
        }

        return $this->displayName;
    }

    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    public function getGithubAccount()
    {
        return $this->githubAccount;
    }

    public function setGithubAccount($githubAccount)
    {
        $this->githubAccount = $githubAccount;
    }

    public function getTwitterAccount()
    {
        return $this->twitterAccount;
    }

    public function setTwitterAccount($twitterAccount)
    {
        $this->twitterAccount = $twitterAccount;
    }

    public function getFacebookUrl()
    {
        return $this->facebookUrl;
    }

    public function setFacebookUrl($facebookUrl)
    {
        $this->facebookUrl = $facebookUrl;
    }

    public function getLinkedInUrl()
    {
        return $this->linkedInUrl;
    }

    public function setLinkedInUrl($linkedInUrl)
    {
        $this->linkedInUrl = $linkedInUrl;
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
        $this->getRoles()->add($role);
    }

    public function clearRoles()
    {
        $this->getRoles()->clear();
    }

    public function getRoles()
    {
        if ($this->roles === null) {
            $this->roles = new RoleCollection();
        }
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
        $this->getRoles()->removeElement($role);
    }

    public function addTag(Tag $tag)
    {
        $this->getTags()->add($tag);
    }

    public function clearTags()
    {
        $this->getTags()->clear();
    }

    public function getTags()
    {
        if ($this->tags === null) {
            $this->tags = new TagCollection();
        }
        return $this->tags;
    }

    public function hasTag($tag)
    {
        foreach ($this->getTags() as $tagElement) {
            if ($tagElement->getTag() == $tag) {
                return true;
            }
        }
        return false;
    }

    public function setTags($tags)
    {
        $this->clearTags();
        foreach ($tags as $tag) {
            $this->addTag($tag);
        }
    }

    public function removeTag(Tag $tag)
    {
        $this->getTags()->removeElement($tag);
    }
}
