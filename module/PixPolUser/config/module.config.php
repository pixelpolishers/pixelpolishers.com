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
                return new UserAccess($sm->getServiceLocator()->get('PixPolAccessService'));
            },
            'ppUserAuth' => function($sm) {
                $instance = new UserAuthentication();
                $instance->setServiceManager($sm);
                return $instance;
            },
            'ppUserService' => function($sm) {
                return new UserServicePlugin($sm->getServiceLocator()->get('PixPolUserService'));
            },
        ),
    ),
    'session_manager' => array(
        'enable_default_container_manager' => true,
    ),
    'service_manager' => array(
        'factories' => array(
            'PixPolAccessService' => 'PixPolUser\Service\AccessServiceFactory',
            'PixPolGuardListener' => 'PixPolUser\Guard\GuardListenerFactory',
            'PixPolPermissionService' => 'PixPolUser\Service\PermissionServiceFactory',
            'PixPolRoleService' => 'PixPolUser\Service\RoleServiceFactory',
            'PixPolUserService' => 'PixPolUser\Service\UserServiceFactory',
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
);
