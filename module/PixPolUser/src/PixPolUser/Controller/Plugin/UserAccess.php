<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Controller\Plugin;

use PixPolUser\Service\AccessService;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class UserAccess extends AbstractPlugin
{
    private $accessService;

    public function __construct(AccessService $accessService)
    {
        $this->accessService = $accessService;
    }

    public function __invoke()
    {
        return $this->accessService;
    }
}
