<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Service;

use Zend\Crypt\Password\Bcrypt;

class UserPassword
{
    private $crypt;

    public function __construct()
    {
        $this->crypt = new Bcrypt();
    }

    public function create($password)
    {
        return $this->crypt->create($password);
    }

    public function createRandom($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= substr($chars, $index, 1);
        }

        return $this->create($result);
    }

    public function verify($user, $password)
    {
        if ($user instanceof User) {
            $hash = $user->getPassword();
        } else {
            $hash = $user;
        }

        return $this->crypt->verify($password, $hash);
    }
}
