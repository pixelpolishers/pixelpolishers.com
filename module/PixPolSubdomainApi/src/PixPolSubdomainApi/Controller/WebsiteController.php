<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainApi\Controller;

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

        return ($needle >= $min) && ($needle <= $max);
    }

    private function isValidPayload($payload)
    {
        if ($payload) {
            $json = json_decode($payload);

            return in_array($json->ref, array('master'));
        }
        return false;
    }

    public function buildAction()
    {
        $f = fopen('data/logs/api-website-build.log', 'a+');
        $exception = null;

        try {
            $remoteAddress = new \Zend\Http\PhpEnvironment\RemoteAddress();
            fwrite($f, '[' . date('Y-m-d H:i:s') . '][' . $remoteAddress->getIpAddress() . '] ');
            if (!$this->isValidIp($remoteAddress->getIpAddress())) {
                fwrite($f, 'Invalid IP' . PHP_EOL);
                throw new \RuntimeException('Invalid request.');
            }

            $payload = array_key_exists('payload', $_POST) ? $_POST['payload'] : '';
            if (!$this->isValidPayload($payload)) {
                fwrite($f, 'Invalid payload' . PHP_EOL);
                throw new \RuntimeException('Invalid request.');
            }

            $buildFile = getcwd() . '/build.sh';
            if (is_file($buildFile)) {
                $process = new Process($buildFile);
                $process->run();

                if (!$process->isSuccessful()) {
                    // TODO: Send an e-mail.
                    fwrite($f, 'Failed: ' . $process->getErrorOutput() . PHP_EOL);
                } else {
                    fwrite($f, 'OK' . PHP_EOL);
                }
            } else {
                fwrite($f, 'Build file does not exist.'. PHP_EOL);
            }
        } catch (\Exception $e) {
            $exception = $e;
        }

        fclose($f);

        if ($exception) {
            throw $exception;
        }

        return $this->getResponse();
    }
}
