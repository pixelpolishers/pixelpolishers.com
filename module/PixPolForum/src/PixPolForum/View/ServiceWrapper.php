<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\View;

use Zend\View\Helper\AbstractHelper;

class ServiceWrapper extends AbstractHelper
{
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function __invoke()
    {
        return $this->service;
    }
}
