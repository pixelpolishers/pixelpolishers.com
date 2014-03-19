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
            $url = $request->getPost('resolver-url');
            $user = $this->ppUserAuth()->getIdentity();

            $submitService = $this->getServiceLocator()->get('PixPolResolver\Service\Submit');
            $package = $submitService->submitPackage($user, $url);

            return $this->redirect()->toRoute('developers/resolver/view', array(
                'name' => $package->getName(),
                'vendor' => $package->getVendor()->getName(),
            ));
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

        $owningPackage = false;
        if ($this->ppUserAuth()->hasIdentity()) {
            $userId = $this->ppUserAuth()->getIdentity()->getId();
            $maintainerId = $package->getUserId();

            $owningPackage = $userId == $maintainerId;
        }

        $devVersions = array();
        $semVersions = array();

        foreach ($package->getVersions() as $version) {
            if (strpos($version->getVersion(), 'dev-') === 0) {
                $devVersions[] = $version;
            } else {
                $semVersions[] = $version;
            }
        }

        usort($devVersions, function($a, $b) {
            return strcmp($a->getVersion(), $v->getVersion());
        });

        usort($semVersions, function($a, $b) {
            $semVerA = \PixelPolishers\Resolver\SemanticVersion::fromString($a->getVersion());
            $semVerB = \PixelPolishers\Resolver\SemanticVersion::fromString($b->getVersion());

            return version_compare($semVerA, $semVerB, '<');
        });

        $sortedVersions = array_merge($devVersions, $semVersions);

        return array(
            'package' => $package,
            'sortedVersions' => $sortedVersions,
            'owningPackage' => $owningPackage,
        );
    }
}
