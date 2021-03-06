<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Service;

use PixPolUser\Entity\User;
use PixPolUser\Mapper\UserMapperInterface;

class UserService
{
    private $mapper;
    private $password;

    public function __construct(UserMapperInterface $mapper)
    {
        $this->mapper = $mapper;
        $this->password = new UserPassword();
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function find($id)
    {
        return $this->mapper->find($id);
    }

    public function findAll()
    {
        return $this->mapper->findAll();
    }

    public function findByEmail($email)
    {
        return $this->mapper->findOneBy(array(
            'email' => $email
        ));
    }

    public function getLatest($amount)
    {
        return $this->mapper->findBy(array(), array(
            'id' => 'DESC',
        ), $amount, 0);
    }

    public function persist(User $user)
    {
        // Store the user:
        $this->mapper->persist($user);
    }

    public function remove(User $user)
    {
        $this->mapper->remove($user);
    }

    public function signUp(User $user)
    {
        // Create a random password:
        $password = $this->getPassword()->createRandom();

        $user->setPassword($this->getPassword()->create($password));

        // Set the registration date:
        $user->setRegistrationDate(new \DateTime());

        // Persist the user:
        $this->mapper->persist($user);

        return $password;
    }

    public function resetPassword(User $user, $password = null)
    {
        // Create a random password:
        if ($password === null) {
            $password = $this->getPassword()->createRandom();
        }

        $user->setPassword($this->getPassword()->create($password));
        $this->mapper->persist($user);

        return $password;
    }

    public function getAZUsers($letter)
    {
        return $this->mapper->getAZUsers($letter);
    }
}
