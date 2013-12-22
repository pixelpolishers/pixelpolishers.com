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

class UserCan extends AbstractHelper
{
    private $accessService;

    public function __construct(AccessService $accessService)
    {
        $this->accessService = $accessService;
    }

    public function __invoke($permission, $assertion = null, User $user = null)
    {
        if ($user) {
            return $this->accessService->canUser($user, $permission, $assertion);
        } else {
            return $this->accessService->canCurrentUser($permission, $assertion);
        }
    }
}
