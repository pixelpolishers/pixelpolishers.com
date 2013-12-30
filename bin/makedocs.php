<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

// Change the current working direction:
chdir(__DIR__ . '/../');

// Setup autoloading:
include 'vendor/autoload.php';

if (!isset($_SERVER['argv'][1])) {
    echo 'Missing ref to build!' . PHP_EOL;
    exit(1);
}

$refToBuild = $_SERVER['argv'][1];
$GLOBALS['extension'] = isset($_SERVER['argv'][2]) ? $_SERVER['argv'][2] : 'local';

// Run the application!
$application = Zend\Mvc\Application::init(include 'config/application.config.php');
$config = $application->getConfig();

// The make docs configuration:
$makeDocsConfig = $config['makedocs'];

// Generate:
foreach ($makeDocsConfig as $repositoryName => $config) {
    echo '[' . date('Y-m-d H:i:s') . '] Building ' . $config['name'] . '...' . PHP_EOL;

    try {
        $generator = new PixPolSubdomainApi\Service\DocsGenerator();
        $generator->setReference($refToBuild);
        $generator->setRepository($repositoryName);
        $generator->generate($makeDocsConfig);
    } catch (\Exception $e) {
        echo '[' . date('Y-m-d H:i:s') . '] Failed: ' . $e->getMessage() . PHP_EOL;
    }
}

echo '[' . date('Y-m-d H:i:s') . '] Done' . PHP_EOL;
