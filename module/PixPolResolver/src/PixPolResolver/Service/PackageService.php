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
use PixelPolishers\Resolver\Entity\Version;

class PackageService
{
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function removePackage(Package $package)
    {
        return $this->adapter->removePackage($package);
    }

    public function removeVersion(Version $version)
    {
        return $this->adapter->removeVersion($version);
    }

    public function findPackage($vendor, $name)
    {
        return $this->adapter->findPackageByName($vendor . '/' . $name);
    }

    public function findVersion($vendor, $name, $version)
    {
        $package = $this->adapter->findPackageByName($vendor . '/' . $name);

        foreach ($package->getVersions() as $packageVersion) {
            if ($packageVersion->getVersion() == $version) {
                return $packageVersion;
            }
        }

        return null;
    }
}