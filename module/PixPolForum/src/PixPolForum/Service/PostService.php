<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Service;

use PixPolDoctrineORM\Service\AbstractService;
use PixPolForum\Entity\Topic;

class PostService extends AbstractService
{
    public function getPostPaginator(Topic $topic)
    {
        return $this->mapper->getPostPaginator($topic);
    }
}
