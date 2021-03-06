<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\View;

use Zend\View\Helper\AbstractHelper;

class ContentHelper extends AbstractHelper
{
    public function __invoke($content)
    {
        return nl2br($content);
    }
}
