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

    private function isValidPayload($payload, $refs = array('refs/heads/master'))
    {
        if ($_SERVER['HTTP_X_GITHUB_EVENT'] !== 'push') {
            return false;
        }
        
        if ($payload) {
            $json = json_decode($payload);

            return in_array($json->ref, $refs);
        }
        
        return false;
    }

    public function updateAction()
    {
        $logDirectory = 'data/github/' . $_SERVER['HTTP_X_GITHUB_EVENT'] . '/';
        $logPath = $logDirectory . time() . '-' . date('Y-m-d-His') . '.log';
        
        if (!is_dir($logDirectory)) {
            mkdir($logDirectory);
        }
        
        $f = fopen($logPath, 'a+');
        fwrite($f, print_r($_SERVER, true));
        fwrite($f, print_r($_GET, true));
        fwrite($f, print_r($_POST, true));
        fwrite($f, $this->getRequest()->getContent());
        fclose($f);
        
        $remoteAddress = new \Zend\Http\PhpEnvironment\RemoteAddress();
        if (!$this->isValidIp($remoteAddress->getIpAddress())) {
            throw new \RuntimeException('Invalid request.');
        }

        $payload = $this->getRequest()->getContent();
        if (!$this->isValidPayload($payload)) {
            throw new \RuntimeException('Invalid request.');
        }

        $buildFile = getcwd() . '/build.sh';
        if (!is_file($buildFile)) {
            throw new \RuntimeException('No build file found.');
        }

        $process = new Process($buildFile);
        
        $extension = empty($GLOBALS['extension']) ? 'com' : $GLOBALS['extension'];
        if ($extension === 'com') {
            $process->run();
        }

        if (!$process->isSuccessful()) {
            // TODO: Send an e-mail.
        }

        return $this->getResponse();
    }
}
