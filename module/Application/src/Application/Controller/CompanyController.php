<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CompanyController extends AbstractActionController
{
    public function aboutAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function careersAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }

    public function contactAction()
    {
        $viewModel = new ViewModel();
        return $viewModel;
    }
}
