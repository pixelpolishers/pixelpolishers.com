<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Account;

return array(
    'router' => array(
        'routes' => array(
            'account' => include 'routes.config.php',
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'PixPolSubdomainAccount\Controller\IndexController' => 'PixPolSubdomainAccount\Controller\IndexController',
            'PixPolSubdomainAccount\Controller\AccessController' => 'PixPolSubdomainAccount\Controller\AccessController',
            'PixPolSubdomainAccount\Controller\ProfileController' => 'PixPolSubdomainAccount\Controller\ProfileController',
            'PixPolSubdomainAccount\Controller\RequestController' => 'PixPolSubdomainAccount\Controller\RequestController',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'PixPolSubdomainAccount\Form\PasswordForm' => 'PixPolSubdomainAccount\Form\Service\PasswordFormFactory',
            'PixPolSubdomainAccount\Form\ProfileForm' => 'PixPolSubdomainAccount\Form\Service\ProfileFormFactory',
            'PixPolSubdomainAccount\Form\RequestPasswordForm' => 'PixPolSubdomainAccount\Form\Service\RequestPasswordFormFactory',
            'PixPolSubdomainAccount\Form\SignInForm' => 'PixPolSubdomainAccount\Form\Service\SignInFormFactory',
            'PixPolSubdomainAccount\Form\SignUpForm' => 'PixPolSubdomainAccount\Form\Service\SignUpFormFactory',
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'ppSignInForm' => 'PixPolSubdomainAccount\View\Helper\SignInFormFactory',
            'ppSignUpForm' => 'PixPolSubdomainAccount\View\Helper\SignUpFormFactory',
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
