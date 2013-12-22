<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolTagDoctrineORM;

use PixPolTagDoctrineORM\Mapper\DoctrineORMMapper;

return array(
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/doctrine')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'PixPolTag\Entity' => __NAMESPACE__,
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'PixPolTagMapper' => function($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                
                return new DoctrineORMMapper($em);
            },
        ),
    ),
);