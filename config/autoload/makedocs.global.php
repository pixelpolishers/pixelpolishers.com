<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */
return array(
    'makedocs' => array(
        'resolver' => array(
            'name' => 'Resolver',
            'alias' => array(
                'develop' => 'latest',
            ),
            'repository' => 'https://github.com/pixelpolishers/resolver.git',
            'input' => __DIR__ . '/../../data/makedocs/src/resolver',
            'builders' => array(
                'html' => array(
                    'baseUrl' => 'http://developers.pixelpolishers.' . $GLOBALS['extension'] . '/docs/manual/resolver/{version}',
                    'themeDirectory' => realpath(__DIR__ . '/../../data/makedocs/theme'),
                    'outputDirectory' => __DIR__ . '/../../data/makedocs/output/resolver/html/{version}',
                ),
            ),
        ),
        'makedocs' => array(
            'name' => 'MakeDocs',
            'alias' => array(
                'develop' => 'latest',
            ),
            'repository' => 'https://github.com/pixelpolishers/makedocs.git',
            'input' => __DIR__ . '/../../data/makedocs/src/makedocs',
            'builders' => array(
                'html' => array(
                    'baseUrl' => 'http://developers.pixelpolishers.' . $GLOBALS['extension'] . '/docs/manual/makedocs/{version}',
                    'themeDirectory' => realpath(__DIR__ . '/../../data/makedocs/theme'),
                    'outputDirectory' => __DIR__ . '/../../data/makedocs/output/makedocs/html/{version}',
                ),
            ),
        ),
        'website' => array(
            'name' => 'Website',
            'alias' => array(
                'develop' => 'latest',
            ),
            'repository' => 'https://github.com/pixelpolishers/pixelpolishers.com.git',
            'input' => __DIR__ . '/../../data/makedocs/src/website',
            'builders' => array(
                'html' => array(
                    'baseUrl' => 'http://developers.pixelpolishers.' . $GLOBALS['extension'] . '/docs/manual/website/{version}',
                    'themeDirectory' => realpath(__DIR__ . '/../../data/makedocs/theme'),
                    'outputDirectory' => __DIR__ . '/../../data/makedocs/output/website/html/{version}',
                ),
            ),
        ),
    ),
);
