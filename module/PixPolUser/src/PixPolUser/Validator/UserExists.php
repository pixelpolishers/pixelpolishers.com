<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Validator;

class UserExists extends AbstractUser
{
    public function isValid($value)
    {
        $this->setValue($value);

        $user = $this->getUser($value);
        if ($user !== null) {
            return true;
        }

        $this->error(self::ERROR_USER_EXISTS);
        return false;
    }
}
