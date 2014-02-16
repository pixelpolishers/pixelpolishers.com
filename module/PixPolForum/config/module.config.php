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
            'PixPolForum\Controller\BookmarkController' => 'PixPolForum\Controller\BookmarkController',
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
            'PixPolForum\Mapper\Board' => function($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');

                return new Mapper\BoardMapperZendDb($dbAdapter);
            },
            'PixPolForum\Mapper\Bookmark' => function($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');

                return new Mapper\BookmarkMapperZendDb($dbAdapter);
            },
            'PixPolForum\Service\Board' => function($sm) {
                $mapper = $sm->get('PixPolForum\Mapper\Board');

                return new Service\BoardService($mapper);
            },
            'PixPolForum\Service\Bookmark' => function($sm) {
                $mapper = $sm->get('PixPolForum\Mapper\Bookmark');

                return new Service\BookmarkService($mapper);
            },
            'PixPolForum\Service\Category' => function($sm) {
                $mapper = $sm->get('PixPolForum\Mapper\Category');

                return new Service\CategoryService($mapper);
            },
            'PixPolForum\Service\Post' => function($sm) {
                $mapper = $sm->get('PixPolForum\Mapper\Post');

                return new Service\PostService($mapper);
            },
            'PixPolForum\Service\Topic' => function($sm) {
                $mapper = $sm->get('PixPolForum\Mapper\Topic');

                return new Service\TopicService($mapper);
            },
        ),
    ),
    'controller_plugins' => array(
        'factories' => array(
            'ppForumBoard' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolForum\Service\Board');

                return new Controller\Plugin\ServiceWrapper($service);
            },
            'ppForumBookmark' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolForum\Service\Bookmark');

                return new Controller\Plugin\ServiceWrapper($service);
            },
            'ppForumCategory' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolForum\Service\Category');

                return new Controller\Plugin\ServiceWrapper($service);
            },
            'ppForumPost' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolForum\Service\Post');

                return new Controller\Plugin\ServiceWrapper($service);
            },
            'ppForumTopic' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolForum\Service\Topic');

                return new Controller\Plugin\ServiceWrapper($service);
            },
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'ppForumBookmark' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolForum\Service\Bookmark');

                return new View\ServiceWrapper($service);
            },
            'ppForumCanBookmark' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolUser\Service\Access');
                return new View\CanBookmark($service);
            },
            'ppForumCanCreateTopic' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolUser\Service\Access');
                return new View\CanCreateTopic($service);
            },
            'ppForumCanEdit' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolUser\Service\Access');
                return new View\CanEdit($service);
            },
            'ppForumCanDelete' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolUser\Service\Access');
                return new View\CanDelete($service);
            },
            'ppForumCanLock' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolUser\Service\Access');
                return new View\CanLock($service);
            },
            'ppForumCanReply' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolUser\Service\Access');
                return new View\CanReply($service);
            },
            'ppForumCanUnlock' => function($sm) {
                $service = $sm->getServiceLocator()->get('PixPolUser\Service\Access');
                return new View\CanUnlock($service);
            },
        ),
        'invokables' => array(
            'ppForumContent' => 'PixPolForum\View\ContentHelper',
            'ppForumDate' => 'PixPolForum\View\DateHelper',
        ),
    ),
);
