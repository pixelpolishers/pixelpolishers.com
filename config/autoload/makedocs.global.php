<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

$GLOBALS['extension'] = isset($GLOBALS['extension']) ? $GLOBALS['extension'] : 'local';

return array(
    'makedocs' => array(
        'listeners' => array(
            'resolver' => array(
                'driver' => 'git',
                'source' => __DIR__ . '/../../data/makedocs/src/resolver',
                'repository' => 'https://github.com/pixelpolishers/resolver.git',
                'builders' => array(
                    array(
                        'type' => 'html',
                        'baseUrl' => 'http://developers.pixelpolishers.' . $GLOBALS['extension'] . '/docs/manual/resolver/{version}',
                        'theme' => realpath(__DIR__ . '/../../data/makedocs/theme'),
                        'output' => __DIR__ . '/../../data/makedocs/output/resolver/html/{version}',
                    ),
                ),
            ),
            'makedocs' => array(
                'driver' => 'git',
                'source' => __DIR__ . '/../../data/makedocs/src/makedocs',
                'repository' => 'https://github.com/pixelpolishers/makedocs.git',
                'builders' => array(
                    array(
                        'type' => 'html',
                        'baseUrl' => 'http://developers.pixelpolishers.' . $GLOBALS['extension'] . '/docs/manual/makedocs/{version}',
                        'theme' => realpath(__DIR__ . '/../../data/makedocs/theme'),
                        'output' => __DIR__ . '/../../data/makedocs/output/makedocs/html/{version}',
                    ),
                ),
            ),
        ),
    ),
);
