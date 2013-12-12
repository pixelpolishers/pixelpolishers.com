<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);

chdir(dirname(dirname(__DIR__)));

// Setup autoloading
include 'vendor/autoload.php';

// Run the application!
Zend\Mvc\Application::init(include 'config/application.config.php')->run()->send();
