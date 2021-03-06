<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ServiceWrapper extends AbstractPlugin
{
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->service, $name), $arguments);
    }
}
