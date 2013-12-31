<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForumDoctrineORM;

return array(
    'doctrine' => array(
        'fixture' => array(
            __NAMESPACE__ . '\Fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
        ),
        'driver' => array(
            __NAMESPACE__ => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/doctrine')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'PixPolForum\Entity' => __NAMESPACE__,
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'PixPolForum\Mapper\BoardMapperInterface' => function($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                return new Mapper\BoardMapperDoctrineORM($em);
            },
            'PixPolForum\Mapper\CategoryMapperInterface' => function($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                return new Mapper\CategoryMapperDoctrineORM($em);
            },
            'PixPolForum\Mapper\PostMapperInterface' => function($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                return new Mapper\PostMapperDoctrineORM($em);
            },
            'PixPolForum\Mapper\TopicMapperInterface' => function($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                return new Mapper\TopicMapperDoctrineORM($em);
            },
        ),
    ),
);
