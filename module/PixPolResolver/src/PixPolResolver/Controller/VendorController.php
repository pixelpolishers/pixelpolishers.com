<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolResolver\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class VendorController extends AbstractActionController
{
    public function viewAction()
    {
        $vendorName = $this->params('name');

        $vendorService = $this->getServiceLocator()->get('PixPolResolver\Service\Vendor');
        $vendor = $vendorService->findByName($vendorName);

        if (!$vendor) {
            return $this->notFoundAction();
        }

        $packageService = $this->getServiceLocator()->get('PixPolResolver\Service\Package');

        return array(
            'vendor' => $vendor,
            'packages' => $packageService->findByVendor($vendor),
        );
    }
}
