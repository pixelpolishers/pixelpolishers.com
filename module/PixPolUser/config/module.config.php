<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser;

use PixPolUser\Controller\Plugin\UserAccess;
use PixPolUser\Controller\Plugin\UserAuthentication;
use PixPolUser\Controller\Plugin\UserService as UserServicePlugin;
use PixPolUser\Service\AccessService;
use PixPolUser\Service\UserService;

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
    'service_manager' => array(
        'factories' => array(
            'PixPolAccessService' => function($sm) {
                $authService = $sm->get('Zend\Authentication\AuthenticationService');
                $provider = $sm->get('PixPolUserRoleProvider');
                return new AccessService($provider, $authService->getIdentity());
            },
            'PixPolUserService' => function($sm) {
                $mapper = $sm->get('PixPolUserMapper');
                return new UserService($mapper);
            },
        ),
    ),
);
