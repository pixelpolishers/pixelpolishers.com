<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUserDoctrineORM;

use PixPolUserDoctrineORM\Mapper\DoctrineORMMapper;

return array(
    'data-fixture' => array(
        __NAMESPACE__ . '\Fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
    ),
    'doctrine' => array(
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'PixPolUser\Entity\User',
                'identity_property' => 'email',
                'credential_property' => 'password',
            ),
        ),
        'driver' => array(
            __NAMESPACE__ => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/doctrine')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'PixPolUser\Entity' => __NAMESPACE__,
                )
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'PixPolUserMapper' => function($sm) {
                $em = $sm->get('Doctrine\ORM\EntityManager');
                return new DoctrineORMMapper($em);
            },
            'Zend\Authentication\AuthenticationService' => function($sm) {
                return $sm->get('doctrine.authenticationservice.orm_default');
            }
        ),
    ),
);
