<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\View;

use PixPolForum\Entity\Post;
use PixPolForum\Entity\Topic;
use PixPolUser\Service\AccessService;
use Zend\View\Helper\AbstractHelper;

class CanEdit extends AbstractHelper
{
    private $accessService;

    public function __construct(AccessService $accessService)
    {
        $this->accessService = $accessService;
    }

    public function __invoke($postOrTopic)
    {
        if ($postOrTopic instanceof Topic) {
            $postOrTopic = $postOrTopic->getPost(0);
        }

        if (!($postOrTopic instanceof Post)) {
            throw new \RuntimeException('No post given!');
        }

        if (!$this->accessService->canCurrentUser('ForumPostEdit')) {
            return false;
        }

        return true;
    }
}
