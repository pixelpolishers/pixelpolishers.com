<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\View\Helper;

use PixPolUser\Entity\User;
use PixPolUser\Service\AccessService;
use Zend\View\Helper\AbstractHelper;

class HasIdentity extends AbstractHelper
{
    private $accessService;

    public function __construct(AccessService $accessService)
    {
        $this->accessService = $accessService;
    }

    public function __invoke()
    {
        return $this->accessService->getCurrentUser() !== null;
    }
}
