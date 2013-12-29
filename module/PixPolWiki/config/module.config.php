<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolWiki;

use PixPolWiki\Service\PageService;

return array(
    'controllers' => array(
        'invokables' => array(
            'PixPolWiki\Controller\PageController' => 'PixPolWiki\Controller\PageController',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'PixPolWiki\Service\PageService' => function($sm) {
                $mapper = $sm->get('PixPolWiki\Mapper\PageMapperInterface');

                return new PageService($mapper);
            },
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
