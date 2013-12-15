<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolLicense;

use PixPolLicense\Service\LicenseService;

return array(
    'service_manager' => array(
        'factories' => array(
            'PixPolLicenseService' => function($sm) {
                $mapper = $sm->get('PixPolLicenseMapper');
                return new LicenseService($mapper);
            },
        ),
    ),
);
