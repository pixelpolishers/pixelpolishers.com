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

class ServicesController extends AbstractActionController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function consultingAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function trainingAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function certificationAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }
}
