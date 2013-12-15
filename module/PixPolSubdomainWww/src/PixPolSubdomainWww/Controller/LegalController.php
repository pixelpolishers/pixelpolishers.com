<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainWww\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LegalController extends AbstractActionController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function copyrightPolicyAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function privacyPolicyAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function termsOfUseAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }
}
