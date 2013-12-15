<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser;

use PixPolUser\Controller\Plugin\UserAuthentication;
use PixPolUser\Service\UserService;

return array(
    'controller_plugins' => array(
        'factories' => array(
            'ppUserAuth' => function($sm) {
                $instance = new UserAuthentication();
                $instance->setServiceManager($sm);
                return $instance;
            },
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'PixPolUserService' => function($sm) {
                $mapper = $sm->get('PixPolUserMapper');
                return new UserService($mapper);
            },
        ),
    ),
);
