<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum;

return array(
    'router' => array(
        'routes' => array(
            'developers' => include 'routes.config.php',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'PixPolForum\Controller\IndexController' => 'PixPolForum\Controller\IndexController',
            'PixPolForum\Controller\BoardController' => 'PixPolForum\Controller\BoardController',
            'PixPolForum\Controller\CategoryController' => 'PixPolForum\Controller\CategoryController',
            'PixPolForum\Controller\PostController' => 'PixPolForum\Controller\PostController',
            'PixPolForum\Controller\TopicController' => 'PixPolForum\Controller\TopicController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'PixPolForum\Form\ReplyForm' => 'PixPolForum\Form\ReplyForm',
            'PixPolForum\Form\TopicForm' => 'PixPolForum\Form\TopicForm',
        ),
        'factories' => array(
            'PixPolForum\Service\BoardService' => function($sm) {
                $mapper = $sm->get('PixPolForum\Mapper\BoardMapperInterface');

                return new Service\BoardService($mapper);
            },
            'PixPolForum\Service\CategoryService' => function($sm) {
                $mapper = $sm->get('PixPolForum\Mapper\CategoryMapperInterface');

                return new Service\CategoryService($mapper);
            },
            'PixPolForum\Service\PostService' => function($sm) {
                $mapper = $sm->get('PixPolForum\Mapper\PostMapperInterface');

                return new Service\PostService($mapper);
            },
            'PixPolForum\Service\TopicService' => function($sm) {
                $mapper = $sm->get('PixPolForum\Mapper\TopicMapperInterface');

                return new Service\TopicService($mapper);
            },
        ),
    ),
    'controller_plugins' => array(
        'factories' => array(
            'ppForumBoard' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolForum\Service\BoardService');

                return new Controller\Plugin\Board($service);
            },
            'ppForumCategory' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolForum\Service\CategoryService');

                return new Controller\Plugin\Category($service);
            },
            'ppForumPost' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolForum\Service\PostService');

                return new Controller\Plugin\Post($service);
            },
            'ppForumTopic' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolForum\Service\TopicService');

                return new Controller\Plugin\Topic($service);
            },
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'ppForumCanEdit' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolAccessService');
                return new View\CanEdit($service);
            },
            'ppForumCanDelete' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolAccessService');
                return new View\CanDelete($service);
            },
            'ppForumCanLock' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolAccessService');
                return new View\CanLock($service);
            },
            'ppForumCanReply' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolAccessService');
                return new View\CanReply($service);
            },
            'ppForumCanUnlock' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolAccessService');
                return new View\CanUnlock($service);
            },
        ),
        'invokables' => array(
            'ppForumContent' => 'PixPolForum\View\ContentHelper',
            'ppForumDate' => 'PixPolForum\View\DateHelper',
        ),
    ),
);
