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

// Run the application!
$application = Zend\Mvc\Application::init(include 'config/application.config.php');
$config = $application->getConfig();

$makeDocsConfig = $config['makedocs'];

function detectConfigFile($path)
{
    $it = new RecursiveDirectoryIterator($path);
    $objects = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::SELF_FIRST);

    foreach ($objects as $fileInfo) {
        if ($fileInfo->isFile() && $fileInfo->getFilename() == 'makedocs.json') {
            return dirname(realpath($fileInfo->getPathname()));
        }
    }

    return null;
}

$driver = new \MakeDocs\Driver\GitDriver();
foreach ($makeDocsConfig as $config) {
    echo '[' . date('Y-m-d H:i:s') . '] Retrieving ' . $config['name'] . '...' . PHP_EOL;

    $driverConfig = new \MakeDocs\Driver\DriverConfig();
    $driverConfig->setDirectory($config['input']);
    $driverConfig->setBranch($config['branch']);
    $driverConfig->setRepository($config['repository']);
    $driver->install($driverConfig);

    $builders = array();
    foreach ($config['builders'] as $type => $builderConfig) {
        echo '[' . date('Y-m-d H:i:s') . '] Configuring builder ' . $type . '...' . PHP_EOL;

        switch ($type) {
            case 'html':
                $builder = new \MakeDocs\Builder\Html\HtmlBuilder();
                $builder->setBaseUrl($builderConfig['baseUrl']);
                $builder->setThemeDirectory($builderConfig['themeDirectory']);
                $builder->setOutputDirectory($builderConfig['outputDirectory']);
                break;
            default:
                throw new \RuntimeException('Invalid builder provided: ' . $type);
        }

        $builders[] = $builder;
    }

    $makeDocs = new \MakeDocs\Generator\Generator();
    $makeDocs->setInputDirectory(detectConfigFile($config['input']));
    $makeDocs->setBuilders($builders);
    $makeDocs->generate();
}

echo '[' . date('Y-m-d H:i:s') . '] Done' . PHP_EOL;
