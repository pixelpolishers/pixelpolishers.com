<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolCli;

return array(
    'service_manager' => array(
        'factories' => array(
            'PixPolCli\Installer' => function($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                return new Installer($dbAdapter);
            },
            'PixPolCli\Uninstaller' => function($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                return new Uninstaller($dbAdapter);
            },
        ),
    ),
);
