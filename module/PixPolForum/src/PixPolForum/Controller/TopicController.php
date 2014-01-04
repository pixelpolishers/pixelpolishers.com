<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Controller;

use PixPolForum\Entity\Post;
use Zend\Mvc\Controller\AbstractActionController;

class TopicController extends AbstractActionController
{
    public function createAction()
    {
        if (!$this->ppUserAuth()->getIdentity()) {
            return $this->redirect()->toRoute('account/index');
        }

        $id = $this->params('board');
        $board = $this->ppForumBoard()->find($id);

        $form = $this->getServiceLocator()->get('PixPolForum\Form\TopicForm');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $topic = $form->getData();
                $topic->setBoard($board);
                $topic->setCreatedBy($this->ppUserAuth()->getIdentity());
                $topic->setCreatedOn(new \DateTime());
                $topic->setLocked(false);
                $topic->setSticky(false);
                $topic->setPostCount(1);
                $this->ppForumTopic()->persist($topic);

                $post = new Post();
                $post->setTopic($topic);
                $post->setCreatedBy($topic->getCreatedBy());
                $post->setCreatedOn($topic->getCreatedOn());
                $post->setContent($form->get('content')->getValue());
                $this->ppForumPost()->persist($post);

                $topic->setLastPost($post);
                $this->ppForumTopic()->persist($topic);

                $board->setLastTopic($topic);
                $this->ppForumBoard()->persist($board);

                return $this->redirect()->toRoute('developers/forum/topic/read', array(
                    'topic' => $topic->getId(),
                ));
            }
        }

        return array(
            'board' => $board,
            'form' => $form,
        );
    }

    public function readAction()
    {
        $id = $this->params('topic');
        $topic = $this->ppForumTopic()->find($id);
        if (!$topic) {
            return $this->redirect()->toRoute('developers/forum');
        }

        $paginator = $this->ppForumPost()->getPostPaginator($topic);
        $paginator->setCurrentPageNumber($this->params('page', 1));
        $paginator->setItemCountPerPage(10);

        return array(
            'topic' => $topic,
            'posts' => $paginator,
        );
    }

    public function replyAction()
    {
        if (!$this->ppUserAuth()->getIdentity()) {
            return $this->redirect()->toRoute('account/index');
        }

        $id = $this->params('topic');
        $topic = $this->ppForumTopic()->find($id);
        if (!$topic) {
            return $this->redirect()->toRoute('developers/forum');
        }

        $form = $this->getServiceLocator()->get('PixPolForum\Form\ReplyForm');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $post = $form->getData();
                $post->setTopic($topic);
                $post->setCreatedBy($this->ppUserAuth()->getIdentity());
                $post->setCreatedOn(new \DateTime());
                $this->ppForumPost()->persist($post);

                $topic->setLastPost($post);
                $this->ppForumTopic()->persist($topic);

                $topic->getBoard()->setLastTopic($topic);
                $this->ppForumBoard()->persist($topic->getBoard());

                return $this->redirect()->toRoute('developers/forum/topic/read', array(
                    'topic' => $topic->getId(),
                ));
            }
        }

        return array(
            'topic' => $topic,
            'form' => $form,
        );
    }
}
