<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Mapper;

use PixPolForum\Entity\Board;

interface TopicMapperInterface
{
    public function getTopicPaginator(Board $board);
}
