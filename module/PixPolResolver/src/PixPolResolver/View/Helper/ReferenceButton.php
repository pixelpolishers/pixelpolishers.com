<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolResolver\View\Helper;

use PixelPolishers\Resolver\Entity\Package;
use PixelPolishers\Resolver\Entity\Version;
use Zend\View\Helper\AbstractHelper;

class ReferenceButton extends AbstractHelper
{
    public function __invoke(Version $version)
    {
        /** @var Package $package */
        $package = $version->getPackage();

        $url = $this->getView()->ppResolverReferenceUrl($version);

        if ($package->getRepositoryType() == 'github') {
            $hash = substr($version->getReferenceHash(), 0, 10);
        } else {
            throw new \Exception('The repository type "' . $package->getRepositoryType() . '" is not supported.');
        }

        return '<a href="' . $url . '" target="_blank"><pre>' . $hash . '</pre></a>';
    }
}
