<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainApi\Service;

use MakeDocs\Driver\GitDriver;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

// TODO: Make use of the git webhook of MakeDocs
class DocsGenerator
{
    private $reference;
    private $repository;

    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    public function setRepository($repository)
    {
        $this->repository = $repository;
    }

    public function generate($config)
    {
        if (!array_key_exists($this->repository, $config)) {
            throw new \RuntimeException('Invalid repository provided.');
        }

        $config = $config[$this->repository];

        $driverConfig = new \MakeDocs\Driver\DriverConfig();
        $driverConfig->setDirectory($config['input']);
        $driverConfig->setBranch($this->reference);
        $driverConfig->setRepository($config['repository']);

        $driver = new GitDriver();
        echo $driver->install($driverConfig) . PHP_EOL . PHP_EOL;

        if (array_key_exists($this->reference, $config['alias'])) {
            $version = $config['alias'][$this->reference];
        } else {
            $version = $this->reference;
        }

        $builders = array();
        foreach ($config['builders'] as $type => $builderConfig) {
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

        $inputDir = $this->detectConfigFile($config['input']);
        if (!is_dir($inputDir)) {
            throw new \RuntimeException('The input directory does not exist: ' . $inputDir);
        }

        $makeDocs = new \MakeDocs\Generator\Generator();
        $makeDocs->setInputDirectory($inputDir);
        $makeDocs->setBuilders($builders);
        $makeDocs->generate();
    }

    private function detectConfigFile($path)
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

}
