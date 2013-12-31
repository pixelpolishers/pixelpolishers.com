<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Controller\Plugin;

use PixPolForum\Service\BoardService;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Board extends AbstractPlugin
{
    private $service;

    public function __construct(BoardService $service)
    {
        $this->service = $service;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->service, $name), $arguments);
    }
}
