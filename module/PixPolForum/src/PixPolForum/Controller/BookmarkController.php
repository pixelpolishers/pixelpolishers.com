<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Controller;

use PixPolForum\Entity\Bookmark;
use Zend\Mvc\Controller\AbstractActionController;

class BookmarkController extends AbstractActionController
{
    public function createAction()
    {
        $user = $this->ppUserAuth()->getIdentity();
        if (!$user) {
            return $this->redirect()->toRoute('account/index');
        }

        $topic = $this->ppForumTopic()->find($this->params('topic'));
        if (!$topic) {
            return $this->redirect()->toRoute('developers/forum');
        }

        $bookmarkService = $this->ppForumBookmark();
        $bookmark = $bookmarkService->find(array(
            'topic' => $topic->getId(),
            'user' => $user->getId(),
        ));

        if (!$bookmark) {
            $bookmark = new Bookmark();
            $bookmark->setTopic($topic);
            $bookmark->setUser($user);

            $bookmarkService->persist($bookmark);
        }

        return $this->redirect()->toRoute('developers/forum/topic/read', array(
            'topic' => $topic->getId(),
        ));
    }

    public function deleteAction()
    {
        $user = $this->ppUserAuth()->getIdentity();
        if (!$user) {
            return $this->redirect()->toRoute('account/index');
        }

        $topic = $this->ppForumTopic()->find($this->params('topic'));
        if (!$topic) {
            return $this->redirect()->toRoute('developers/forum');
        }

        $bookmarkService = $this->ppForumBookmark();
        $bookmark = $bookmarkService->find(array(
            'topic' => $topic->getId(),
            'user' => $user->getId(),
        ));

        if ($bookmark) {
            $bookmarkService->remove($bookmark);
        }

        return $this->redirect()->toRoute('developers/forum/topic/read', array(
            'topic' => $topic->getId(),
        ));
    }
}
