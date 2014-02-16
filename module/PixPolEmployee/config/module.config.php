<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolEmployee;

return array(
    'service_manager' => array(
        'factories' => array(
            'PixPolEmployee\Mapper\Employee' => 'PixPolEmployee\Mapper\EmployeeMapperFactory',
            'PixPolEmployee\Service\Employee' => 'PixPolEmployee\Service\EmployeeServiceFactory',
        ),
    ),
);
