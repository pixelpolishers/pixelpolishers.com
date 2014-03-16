<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolResolver\Service;

use PixelPolishers\Resolver\Adapter\AdapterInterface;
use PixelPolishers\Resolver\Entity\Package;
use PixelPolishers\Resolver\Importer\GitHubImporter;

class UpdateService
{
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function update(Package $package)
    {
        switch ($package->getRepositoryType()) {
            case 'github':
                $this->updateGitHub($package);
                break;
        }

        $package->setUpdatedAt(new \DateTime());
        $this->adapter->persistPackage($package);
    }

    public function updateGitHub(Package $oldPackage)
    {
        $importer = new GitHubImporter();
        $newPackage = $importer->import($oldPackage->getRepositoryUrl());

        // Remove all versions that do not exist anymore and update the existing versions:
        foreach ($oldPackage->getVersions() as $version) {
            $newVersion = $this->findVersion($newPackage, $version);
            if (!$newVersion) {
                $oldPackage->removeVersion($version);
            } else {
                $version->setReferenceHash($newVersion->getReferenceHash());
            }
        }

        // Add the new versions:
        foreach ($newPackage->getVersions() as $version) {
            $oldVersion = $this->findVersion($oldPackage, $version);
            if ($oldVersion === null) {
                $oldPackage->addVersion($version);
            }
        }
    }

    private function findVersion($package, $version)
    {
        foreach ($package->getVersions() as $packageVersion) {
            if ($packageVersion->getVersion() == $version->getVersion()) {
                return $packageVersion;
            }
        }
        return null;
    }
}