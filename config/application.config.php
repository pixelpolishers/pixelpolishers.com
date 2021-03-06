<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */
return array(
    'modules' => array(
        'PixPolCli',
        'PixPolDocs',
        'PixPolEmployee',
        'PixPolResolver',
        'PixPolSubdomainAccount',
        'PixPolSubdomainApi',
        'PixPolSubdomainCompany',
        'PixPolSubdomainDevelopers',
        'PixPolSubdomainWww',
        'PixPolTag',
        'PixPolUser',
    ),
    'module_listener_options' => array(
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'config_cache_enabled' => false,
        'cache_dir' => 'data/cache',
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);