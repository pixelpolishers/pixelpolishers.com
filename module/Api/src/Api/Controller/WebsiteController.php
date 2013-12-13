<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Api\Controller;

use Symfony\Component\Process\Process;
use Zend\Mvc\Controller\AbstractActionController;

class WebsiteController extends AbstractActionController
{
    private function isValidIp($ipAddress)
    {
        if ($ipAddress === '127.0.0.1') {
            return true;
        }

        $min = ip2long('192.30.252.0');
        $max = ip2long('192.30.252.255');
        $needle = ip2long($ipAddress);

        return true;//($needle >= $min) && ($needle <= $max);
    }

    public function buildAction()
    {
        $remoteAddress = new \Zend\Http\PhpEnvironment\RemoteAddress();
        if (!$this->isValidIp($remoteAddress->getIpAddress())) {
            throw new \RuntimeException('Invalid request.');
        }

        echo '<h1>Auto Update</h1>';

        $buildFile = getcwd() . '/build.sh';
        if (is_file($buildFile)) {
            $process = new Process($buildFile);
            $process->run();

            if (!$process->isSuccessful()) {
                echo '<h2>Error</h2><pre>' . $process->getErrorOutput() . '</pre>';
            }

            echo '<h2>Output</h2><pre>' . $process->getOutput() . '</pre>';
        }

        return $this->getResponse();
    }
}
