<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainWww;

return array(
    'type' => 'Zend\Mvc\Router\Http\Hostname',
    'may_terminate' => false,
    'options' => array(
        'route' => ':subdomain.pixelpolishers.:extension',
        'constraints' => array(
            'subdomain' => 'www',
            'extension' => 'local|com',
        ),
        'defaults' => array(
            'subdomain' => 'www',
            'extension' => empty($GLOBALS['extension']) ? 'com' : $GLOBALS['extension'],
        ),
    ),
    'child_routes' => array(
        'index' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainWww\Controller\CompanyController',
                    'action' => 'about',
                ),
            ),
        ),
        'company' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/company',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainWww\Controller\CompanyController',
                    'action' => 'index',
                ),
            ),
            'child_routes' => array(
                'about' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/about',
                        'defaults' => array(
                            'action' => 'about',
                        ),
                    ),
                ),
                'legal' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'may_terminate' => true,
                    'options' => array(
                        'route' => '/legal',
                        'defaults' => array(
                            'controller' => 'PixPolSubdomainWww\Controller\LegalController',
                            'action' => 'index',
                        ),
                    ),
                    'child_routes' => array(
                        'copyright-policy' => array(
                            'type' => 'Zend\Mvc\Router\Http\Literal',
                            'options' => array(
                                'route' => '/copyruight-policy',
                                'defaults' => array(
                                    'action' => 'copyrightPolicy',
                                ),
                            ),
                        ),
                        'privacy-policy' => array(
                            'type' => 'Zend\Mvc\Router\Http\Literal',
                            'options' => array(
                                'route' => '/privacy-policy',
                                'defaults' => array(
                                    'action' => 'privacyPolicy',
                                ),
                            ),
                        ),
                        'terms-of-use' => array(
                            'type' => 'Zend\Mvc\Router\Http\Literal',
                            'options' => array(
                                'route' => '/terms-of-use',
                                'defaults' => array(
                                    'action' => 'termsOfUse',
                                ),
                            ),
                        ),
                    ),
                ),
                'careers' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/careers',
                        'defaults' => array(
                            'action' => 'careers',
                        ),
                    ),
                ),
                'contact' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/contact',
                        'defaults' => array(
                            'action' => 'contact',
                        ),
                    ),
                ),
                'website' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/website',
                        'defaults' => array(
                            'action' => 'website',
                        ),
                    ),
                ),
            ),
        ),
        'technologies' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/technologies',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainWww\Controller\TechnologyController',
                    'action' => 'index',
                ),
            ),
        ),
        'services' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'may_terminate' => true,
            'options' => array(
                'route' => '/services',
                'defaults' => array(
                    'controller' => 'PixPolSubdomainWww\Controller\ServicesController',
                    'action' => 'index',
                ),
            ),
            'child_routes' => array(
                'consulting' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/consulting',
                        'defaults' => array(
                            'action' => 'consulting',
                        ),
                    ),
                ),
                'training' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/training',
                        'defaults' => array(
                            'action' => 'training',
                        ),
                    ),
                ),
                'certification' => array(
                    'type' => 'Zend\Mvc\Router\Http\Literal',
                    'options' => array(
                        'route' => '/certification',
                        'defaults' => array(
                            'action' => 'certification',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
