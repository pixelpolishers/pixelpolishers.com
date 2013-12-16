<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Controller\Plugin;

use PixPolUser\Service\UserService as Service;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class UserService extends AbstractPlugin
{
    private $userService;

    public function __construct(Service $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke()
    {
        return $this->userService;
    }
}
