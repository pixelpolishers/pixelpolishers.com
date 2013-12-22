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
        $this->password = new Bcrypt();
    }

    private function generateRandomPassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= substr($chars, $index, 1);
        }

        return $result;
    }

    public function verifyPassword($user, $password)
    {
        if ($user instanceof User) {
            $hash = $user->getPassword();
        } else {
            $hash = $user;
        }

        return $this->password->verify($password, $hash);
    }

    public function findByEmail($email)
    {
        return $this->mapper->findByEmail($email);
    }

    public function signUp(User $user)
    {
        // Create a random password:
        $password = 'test'; //$this->generateRandomPassword();
        // TODO: Send a welcome e-mail to the user.
        $user->setPassword($this->password->create($password));

        // Persist the user:
        $this->mapper->persist($user);
    }

}
