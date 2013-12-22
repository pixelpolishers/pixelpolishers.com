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
use Zend\Crypt\Password\Bcrypt;

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
        $this->mapper->persist($user);
    }

    public function remove(User $user)
    {
        $this->mapper->remove($user);
    }

    public function signUp(User $user)
    {
        // Create a random password:
        $password = 'test'; //$this->getPassword()->generateRandomPassword();
        // TODO: Send a welcome e-mail to the user.
        $user->setPassword($this->getPassword()->create($password));

        // Set the registration date:
        $user->setRegistrationDate(new \DateTime());

        // Persist the user:
        $this->mapper->persist($user);
    }

}
