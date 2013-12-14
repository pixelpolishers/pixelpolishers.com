<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

if (!extension_loaded('intl')) {
    $factories = array(
        'MvcTranslator' => 'Application\Service\TranslatorServiceFactory',
    );
}

return array(
    'service_manager' => array(
        'factories' => $factories,
    ),
);
