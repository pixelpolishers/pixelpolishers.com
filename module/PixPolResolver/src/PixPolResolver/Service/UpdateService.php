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
    private $gitHubImporter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getGitHubImporter()
    {
        return $this->gitHubImporter;
    }

    public function setGitHubImporter(GitHubImporter $gitHubImporter)
    {
        $this->gitHubImporter = $gitHubImporter;
    }

    public function update(Package $package)
    {
        if ($package->getRepositoryType() == 'github' && $this->gitHubImporter !== null) {
            $newPackage = $this->getGitHubPackage($package->getRepositoryUrl());
        } else {
            throw new \RuntimeException('The repository type "' . $package->getRepositoryType() . '" is not supported.');
        }

        $this->updatePackage($package, $newPackage);

        $this->adapter->persistPackage($package);
    }

    private function getGitHubPackage($url)
    {
        return $this->gitHubImporter->import($url);
    }

    private function updatePackage(Package $oldPackage, Package $newPackage)
    {
        $oldPackage->setUpdatedAt(new \DateTime());
        $oldPackage->setDescription($newPackage->getDescription());

        // Remove all versions that do not exist anymore and update the existing versions:
        foreach ($oldPackage->getVersions() as $version) {
            $newVersion = $this->findVersion($newPackage, $version);
            if (!$newVersion) {
                $oldPackage->removeVersion($version);
            } else {
                $version->setReferenceHash($newVersion->getReferenceHash());
                $version->setLicense($newVersion->getLicense());
                $version->setUpdatedAt(new \DateTime());
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