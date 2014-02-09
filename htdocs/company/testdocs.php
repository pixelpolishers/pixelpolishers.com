<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

$_SERVER['argv'] = array(
    '',
    'refs/heads/develop',
    'com',
);

echo '<pre>';
include __DIR__ . '/../../bin/makedocs.php';
