<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolResolver\Service;

use PixelPolishers\Resolver\Entity\Package;
use PixelPolishers\Resolver\Entity\Vendor;
use PixelPolishers\Resolver\Entity\Version;
use PixelPolishers\Resolver\SemanticVersion;
use PixelPolishers\Resolver\Adapter\AdapterInterface;

class SubmitService
{
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function submitPackage($url)
    {
        $urlData = parse_url($url);

        // Parse the repository and collect all versions:
        if ($urlData['host'] === 'github.com') {
            $package = $this->parseGitHubPackage($url, substr($urlData['path'], 1));
        } else {
            throw new \Exception('Invalid service, ' . $urlData['host'] . ' is not supported.');
        }

        $this->adapter->persistPackage($package);
    }

    private function parseGitHubPackage($url, $repositoryName)
    {
        $packageUrl = 'https://api.github.com/repos/' . $repositoryName . '/contents/resolver.json';
        $packageJson = $this->getHttpContent($packageUrl);

        $package = $this->parsePackageJson($packageJson);

        $tagsUrl = 'https://api.github.com/repos/' . $repositoryName . '/tags';
        $tagsJson = $this->getHttpContent($tagsUrl);
        foreach ($tagsJson as $tagJson) {
            $tagPackageUrl = 'https://api.github.com/repos/' . $repositoryName . '/contents/resolver.json?ref=' . $tagJson->name;
            $tagPackageJson = $this->getHttpContent($tagPackageUrl);

            $tag = $this->parseTagJson($tagPackageJson);
            $tag->setPackage($package);
            $tag->setReference($tagJson->commit->sha);
            $tag->setReferenceType('git');
            $tag->setReferenceUrl($url);

            $semanticVersion = SemanticVersion::fromString($tagJson->name);
            $tag->setVersion($semanticVersion);

            $package->addVersion($tag);
        }

        return $package;
    }

    private function parsePackageJson($json)
    {
        $package = new Package();
        $package->setCreatedAt(new \DateTime());
        $package->setUpdatedAt(new \DateTime());

        if (isset($json->name)) {
            list($vendorName, $packageName) = explode('/', $json->name, 2);
            
            $vendor = new Vendor();
            $vendor->setName($vendorName);

            $package->setName($packageName);
            $package->setVendor($vendor);
            $package->setFullname($json->name);
        }

        if (isset($json->description)) {
            $package->setDescription($json->description);
        }

        return $package;
    }

    private function parseTagJson($json)
    {
        $version = new Version();
        $version->setCreatedAt(new \DateTime());
        $version->setUpdatedAt(new \DateTime());

        if (isset($json->license)) {
            $version->setLicense($json->license);
        }

        return $version;
    }

    private function getHttpContent($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'pixelpolishers.com');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/vnd.github.3.raw'
        ));
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output);
    }
}