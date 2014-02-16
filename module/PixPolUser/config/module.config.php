<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser;

use Zend\Session\Config\SessionConfig;
use PixPolUser\Controller\Plugin\UserAccess;
use PixPolUser\Controller\Plugin\UserAuthentication;
use PixPolUser\Controller\Plugin\UserService as UserServicePlugin;

return array(
    'controller_plugins' => array(
        'factories' => array(
            'ppUserAccess' => function($sm) {
                return new UserAccess($sm->getServiceLocator()->get('PixPolUser\Service\Access'));
            },
            'ppUserAuth' => function($sm) {
                $instance = new UserAuthentication();
                $instance->setServiceManager($sm);
                return $instance;
            },
            'ppUserService' => function($sm) {
                return new UserServicePlugin($sm->getServiceLocator()->get('PixPolUser\Service\User'));
            },
        ),
    ),
    'session_manager' => array(
        'enable_default_container_manager' => true,
    ),
    'service_manager' => array(
        'factories' => array(

            'PixPolUser\Mapper\Role' => 'PixPolUser\Mapper\RoleMapperFactory',
            'PixPolUser\Mapper\User' => 'PixPolUser\Mapper\UserMapperFactory',
            'PixPolUser\Service\Access' => 'PixPolUser\Service\AccessServiceFactory',
            'PixPolUser\Service\Role' => 'PixPolUser\Service\RoleServiceFactory',
            'PixPolUser\Service\User' => 'PixPolUser\Service\UserServiceFactory',

            'Zend\Authentication\AuthenticationService' => function($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');

                $userService = $sm->get('PixPolUser\Service\User');

                $adapter = new \Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter($dbAdapter);
                $adapter->setCredentialColumn('password');
                $adapter->setIdentityColumn('email');
                $adapter->setTableName('user');
                $adapter->setCredentialValidationCallback(function($a, $b) use ($userService) {
                    return $userService->getPassword()->verify($a, $b);
                });

                $instance = new Service\AuthService();
                $instance->setUserService($userService);
                $instance->setAdapter($adapter);
                return $instance;
            },
            'Zend\Session\SessionManager' => 'Zend\Session\Service\SessionManagerFactory',
            'Zend\Session\Config\ConfigInterface' => function($sm) {
                $instance = new SessionConfig();
                $instance->setUseCookies(true);
                if (array_key_exists('extension', $GLOBALS)) {
                    $instance->setCookieDomain('.pixelpolishers.' . $GLOBALS['extension']);
                } else {
                    $instance->setCookieDomain('.pixelpolishers.' . 'com');
                }
                return $instance;
            },
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'ppUserCan' => 'PixPolUser\View\Helper\UserCanFactory',
            'ppHasIdentity' => 'PixPolUser\View\Helper\HasIdentityFactory',
            'ppIdentity' => 'PixPolUser\View\Helper\IdentityFactory',
        ),
    ),
);
