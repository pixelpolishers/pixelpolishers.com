<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum;

return array(
    'child_routes' => array(
        'forum' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/forum',
                'defaults' => array(
                    'controller' => 'PixPolForum\Controller\IndexController',
                    'action' => 'index',
                ),
            ),
            'may_terminate' => true,
            'child_routes' => array(
                'board' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/board/:board',
                        'defaults' => array(
                            'controller' => 'PixPolForum\Controller\BoardController',
                            'action' => 'index',
                        ),
                    ),
                ),
                'board' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/board/:board[/:page]',
                        'defaults' => array(
                            'controller' => 'PixPolForum\Controller\BoardController',
                            'action' => 'index',
                        ),
                    ),
                ),
                'category' => array(
                    'type' => 'Zend\Mvc\Router\Http\Segment',
                    'options' => array(
                        'route' => '/category/:category',
                        'defaults' => array(
                            'controller' => 'PixPolForum\Controller\CategoryController',
                            'action' => 'index',
                        ),
                    ),
                ),
                'topic' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/topic',
                        'defaults' => array(
                            'controller' => 'PixPolForum\Controller\TopicController',
                            'action' => 'index',
                        ),
                    ),
                    'child_routes' => array(
                        'create' => array(
                            'type' => 'Zend\Mvc\Router\Http\Segment',
                            'options' => array(
                                'route' => '/create/:board',
                                'defaults' => array(
                                    'controller' => 'PixPolForum\Controller\TopicController',
                                    'action' => 'create',
                                ),
                            ),
                        ),
                        'read' => array(
                            'type' => 'Zend\Mvc\Router\Http\Segment',
                            'options' => array(
                                'route' => '/:topic[/:page]',
                                'defaults' => array(
                                    'controller' => 'PixPolForum\Controller\TopicController',
                                    'action' => 'read',
                                ),
                            ),
                        ),
                        'delete' => array(
                            'type' => 'Zend\Mvc\Router\Http\Segment',
                            'options' => array(
                                'route' => '/delete/:topic',
                                'defaults' => array(
                                    'controller' => 'PixPolForum\Controller\TopicController',
                                    'action' => 'delete',
                                ),
                            ),
                        ),
                        'edit' => array(
                            'type' => 'Zend\Mvc\Router\Http\Segment',
                            'options' => array(
                                'route' => '/edit/:topic',
                                'defaults' => array(
                                    'controller' => 'PixPolForum\Controller\TopicController',
                                    'action' => 'edit',
                                ),
                            ),
                        ),
                        'lock' => array(
                            'type' => 'Zend\Mvc\Router\Http\Segment',
                            'options' => array(
                                'route' => '/lock/:topic',
                                'defaults' => array(
                                    'controller' => 'PixPolForum\Controller\TopicController',
                                    'action' => 'lock',
                                ),
                            ),
                        ),
                        'unlock' => array(
                            'type' => 'Zend\Mvc\Router\Http\Segment',
                            'options' => array(
                                'route' => '/unlock/:topic',
                                'defaults' => array(
                                    'controller' => 'PixPolForum\Controller\TopicController',
                                    'action' => 'unlock',
                                ),
                            ),
                        ),
                        'reply' => array(
                            'type' => 'Zend\Mvc\Router\Http\Segment',
                            'options' => array(
                                'route' => '/reply/:topic',
                                'defaults' => array(
                                    'controller' => 'PixPolForum\Controller\TopicController',
                                    'action' => 'reply',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
