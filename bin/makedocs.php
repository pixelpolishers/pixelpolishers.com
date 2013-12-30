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
foreach ($makeDocsConfig as $projectName => $config) {
    echo '[' . date('Y-m-d H:i:s') . '] Retrieving ' . $config['name'] . '...' . PHP_EOL;

    try {
        $driverConfig = new \MakeDocs\Driver\DriverConfig();
        $driverConfig->setDirectory($config['input']);
        $driverConfig->setBranch($refToBuild);
        $driverConfig->setRepository($config['repository']);
        $driver->install($driverConfig);
    } catch (\Exception $e) {
        echo '[' . date('Y-m-d H:i:s') . '] Failed: ' . $e->getMessage() . PHP_EOL;
        continue;
    }

    $version = isset($config['alias'][$refToBuild]) ? $config['alias'][$refToBuild] : $refToBuild;

    $builders = array();
    foreach ($config['builders'] as $type => $builderConfig) {
        echo '[' . date('Y-m-d H:i:s') . '] Configuring builder ' . $type . '...' . PHP_EOL;

        $baseUrl = str_replace('{version}', $version, $builderConfig['baseUrl']);

        $outputDir = str_replace('{version}', $version, $builderConfig['outputDirectory']);

        switch ($type) {
            case 'html':
                $builder = new \MakeDocs\Builder\Html\HtmlBuilder();
                $builder->setBaseUrl($baseUrl);
                $builder->setThemeDirectory($builderConfig['themeDirectory']);
                $builder->setOutputDirectory($outputDir);
                break;
            default:
                throw new \RuntimeException('Invalid builder provided: ' . $type);
        }

        $builders[] = $builder;
    }

    try {
        $makeDocs = new \MakeDocs\Generator\Generator();
        $makeDocs->setInputDirectory(detectConfigFile($config['input']));
        $makeDocs->setBuilders($builders);
        $makeDocs->generate();
    } catch (\Exception $e) {
        echo '[' . date('Y-m-d H:i:s') . '] Failed to generate: ' . $e->getMessage() . PHP_EOL;
        continue;
    }
}

echo '[' . date('Y-m-d H:i:s') . '] Done' . PHP_EOL;
