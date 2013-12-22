<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolTag;

use PixPolTag\Service\TagService;

return array(
    'service_manager' => array(
        'factories' => array(
            'PixPolTag\Service\TagService' => function($sm) {
                $mapper = $sm->get('PixPolTag\Mapper\TagMapperInterface');

                return new TagService($mapper);
            },
        ),
    ),
);
