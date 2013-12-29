<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Email;

abstract class AbstractEmail
{
    private $topBarColor;
    private $subBarColor;

    public function getTopBarColor()
    {
        return $this->topBarColor;
    }

    public function setTopBarColor($topBarColor)
    {
        $this->topBarColor = $topBarColor;
    }

    public function getSubBarColor()
    {
        return $this->subBarColor;
    }

    public function setSubBarColor($subBarColor)
    {
        $this->subBarColor = $subBarColor;
    }
}
