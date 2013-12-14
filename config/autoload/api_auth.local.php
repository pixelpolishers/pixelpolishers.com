<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */
return array(
    'api_auth' => array(
        'providers' => array(
            "LinkedIn" => array(
                /*
                 * API Key: 77o1doqhw0lt41
                 * Secret Key: BvzSHOUkG32bz0aj
                 * OAuth User Token: 2117574b-b157-49e0-b4df-782ff433d630
                 * OAuth User Secret: b8c9812a-5bf9-4b44-af34-9044718915f3
                 */
                "enabled" => true,
                "keys" => array(
                    'key' => '77o1doqhw0lt41',
                    'secret' => 'BvzSHOUkG32bz0aj'
                ),
            ),
        ),
        'debug_mode' => true,
        'debug_file' => getcwd() . '/auth.log',
    ),
);
