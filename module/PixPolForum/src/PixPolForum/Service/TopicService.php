<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Service;

use PixPolForum\Entity\Board;
use PixPolDoctrineORM\Service\AbstractService;

class TopicService extends AbstractService
{
    public function getTopicPaginator(Board $board)
    {
        return $this->mapper->getTopicPaginator($board);
    }
}
