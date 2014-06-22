<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany\Controller;

use Symfony\Component\Process\Process;
use Zend\Mvc\Controller\AbstractActionController;

class WebsiteController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }
    
    public function updateAction()
    {
        $buildFile = getcwd() . '/build.sh';
        if (!is_file($buildFile)) {
            throw new \RuntimeException('No build file found.');
        }

        $process = new Process($buildFile);
        
        $extension = empty($GLOBALS['extension']) ? 'com' : $GLOBALS['extension'];
        if ($extension === 'com') {
            $process->run();
        }
        
        return array(
            'buildFile' => $buildFile,
            'process' => $process,
        );
    }
}
