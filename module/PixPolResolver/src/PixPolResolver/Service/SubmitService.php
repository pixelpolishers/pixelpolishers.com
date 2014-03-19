<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolResolver\Service;

use PixelPolishers\Resolver\Adapter\AdapterInterface;
use PixelPolishers\Resolver\Importer\GitHubImporter;
use PixPolUser\Entity\User;

class SubmitService
{
    /**
     *
     * @var AdapterInterface
     */
    private $adapter;

    /**
     *
     * @var GitHubImporter
     */
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

    public function submitPackage(User $user, $url)
    {
        $urlData = parse_url($url);

        // Parse the repository and collect all versions:
        if ($urlData['host'] === 'github.com' && $this->gitHubImporter !== null) {
            $package = $this->parseGitHubPackage($url);
        } else {
            throw new \Exception('Invalid service, ' . $urlData['host'] . ' is not supported.');
        }

        $existingPackage = $this->adapter->findPackageByFullname($package->getFullname());
        if ($existingPackage !== null) {
            throw new \Exception('The package "' . $existingPackage->getFullname() . '" already exists.');
        }

        $package->setUserId($user->getId());

        $this->adapter->persistPackage($package);
        return $package;
    }

    private function parseGitHubPackage($url)
    {
        return $this->gitHubImporter->import($url);
    }
}