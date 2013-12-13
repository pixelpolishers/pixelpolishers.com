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

        $config = $this->getServiceLocator()->get('Config');

        $min = ip2long($config['api_website']['build']['ip_range_from']);
        $max = ip2long($config['api_website']['build']['ip_range_till']);
        $needle = ip2long($ipAddress);

        return ($needle >= $min) && ($needle <= $max);
    }

    public function buildAction()
    {
        $remoteAddress = new \Zend\Http\PhpEnvironment\RemoteAddress();
        if (!$this->isValidIp($remoteAddress->getIpAddress())) {
            throw new \RuntimeException('Invalid request.');
        }

        $f = fopen(getcwd() . '/payload.log', 'a+');
        fwrite($f, print_r($_POST, true));
        fwrite($f, PHP_EOL . PHP_EOL);
        fclose($f);

        $buildFile = getcwd() . '/build.sh';
        if (is_file($buildFile)) {
            $process = new Process($buildFile);
            $process->run();

            if (!$process->isSuccessful()) {
                // TODO: Send an e-mail.
            }
        }

        return $this->getResponse();
    }
}
