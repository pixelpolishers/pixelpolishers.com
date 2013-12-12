<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */
return array(
    'makedocs' => array(
        'input' => __DIR__ . '/../../../input',
        'builders' => array(
            'html' => array(
                'baseUrl' => 'http://pixelpolishers.com/{language}/docs/{project}/{version}',
                'themeDirectory' => realpath(__DIR__ . '/../../vendor/pixelpolishers/makedocs/themes/default'),
                'outputDirectory' => __DIR__ . '/../../../output/html',
            ),
        ),
    ),
);
