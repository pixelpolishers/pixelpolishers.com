<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Provider;

use PixPolUser\Service\AccessService;

interface RoleProviderInterface2
{
    public function provide(AccessService $accessService);
}
