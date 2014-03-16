<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolResolver\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class PackageController extends AbstractActionController
{
    public function deleteAction()
    {
        $packageVendor = $this->params('vendor');
        $packageName = $this->params('name');

        $packageService = $this->getServiceLocator()->get('PixPolResolver\Service\Package');
        $package = $packageService->findPackage($packageVendor, $packageName);

        if (!$package) {
            return $this->notFoundAction();
        }

        $packageService->removePackage($package);

        return array(
            'package' => $package,
        );
    }

    public function deleteVersionAction()
    {
        $packageVendor = $this->params('vendor');
        $packageName = $this->params('name');
        $packageVersion = $this->params('version');

        $packageService = $this->getServiceLocator()->get('PixPolResolver\Service\Package');
        $version = $packageService->findVersion($packageVendor, $packageName, $packageVersion);

        if (!$version) {
            return $this->notFoundAction();
        }

        $packageService->removeVersion($version);

        return array(
            'version' => $version,
        );
    }

    public function forceUpdateAction()
    {
        $packageVendor = $this->params('vendor');
        $packageName = $this->params('name');

        $packageService = $this->getServiceLocator()->get('PixPolResolver\Service\Package');
        $package = $packageService->findPackage($packageVendor, $packageName);

        if (!$package) {
            return $this->notFoundAction();
        }

        $updateService = $this->getServiceLocator()->get('PixPolResolver\Service\Update');
        $updateService->update($package);

        return $this->redirect()->toRoute('developers/resolver/view', array(
            'vendor' => $packageVendor,
            'name' => $packageName,
        ));
    }

    public function submitAction()
    {
        if (!$this->ppUserAuth()->hasIdentity()) {
            return $this->redirect()->toRoute('account/index');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $submitService = $this->getServiceLocator()->get('PixPolResolver\Service\Submit');
            $submitService->submitPackage($request->getPost('resolver-url'));

            return $this->redirect()->toRoute('developers/resolver');
        }
    }

    public function viewAction()
    {
        $packageVendor = $this->params('vendor');
        $packageName = $this->params('name');

        $packageService = $this->getServiceLocator()->get('PixPolResolver\Service\Package');
        $package = $packageService->findPackage($packageVendor, $packageName);

        if (!$package) {
            return $this->notFoundAction();
        }

        return array(
            'package' => $package,
        );
    }
}
