<?php

// Change the current working direction:
chdir(__DIR__ . '/../');

// Setup autoloading:
include 'vendor/autoload.php';

// Bootstrap the application:
try {
    $application = Zend\Mvc\Application::init(include 'config/application.config.php');
    $application->getServiceManager()->get('PixPolCli\Uninstaller')->run();
    $application->getServiceManager()->get('PixPolCli\Installer')->run();
} catch (\Exception $e) {
    while ($e) {
        echo $e->getMessage() . PHP_EOL;
        $e = $e->getPrevious();
    }
}