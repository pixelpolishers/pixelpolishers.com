<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\View;

use PixPolForum\Entity\Topic;
use PixPolUser\Service\AccessService;
use Zend\View\Helper\AbstractHelper;

class CanReply extends AbstractHelper
{
    private $accessService;

    public function __construct(AccessService $accessService)
    {
        $this->accessService = $accessService;
    }

    public function __invoke(Topic $topic)
    {
        if ($topic->isLocked()) {
            return false;
        }

        if (!$this->accessService->getCurrentUser()) {
            return false;
        }

        return true;//$this->accessService->canCurrentUser('ForumPostReply');
    }
}
