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
    private $config;

    private function getApiWebsiteBuildConfig()
    {
        if ($this->config === null) {
            $this->config = array(
                'ip_range_from' => '',
                'ip_range_till' => '',
                'refs' => array(),
            );

            $config = $this->getServiceLocator()->get('Config');
            if (!array_key_exists('api_website', $config)) {
                return $this->config;
            }

            $api_website = $config['api_website'];
            if (!array_key_exists('build', $api_website)) {
                return $this->config;
            }

            $this->config = $api_website['build'];
        }
        return $this->config;
    }

    private function isValidIp($ipAddress)
    {
        if ($ipAddress === '127.0.0.1') {
            return true;
        }

        $config = $this->getApiWebsiteBuildConfig();

        $min = ip2long($config['ip_range_from']);
        $max = ip2long($config['ip_range_till']);
        $needle = ip2long($ipAddress);

        return ($needle >= $min) && ($needle <= $max);
    }

    private function isValidPayload($payload)
    {
        if ($payload) {
            $json = json_decode($payload);

            $config = $this->getApiWebsiteBuildConfig();

            return in_array($json->ref, $config['refs']);
        }
        return false;
    }

    public function buildAction()
    {
        $remoteAddress = new \Zend\Http\PhpEnvironment\RemoteAddress();
        if (!$this->isValidIp($remoteAddress->getIpAddress())) {
            throw new \RuntimeException('Invalid request.');
        }

        $payload = array_key_exists('payload', $_POST) ? $_POST['payload'] : '';
        if (!$this->isValidPayload($payload)) {
            throw new \RuntimeException('Invalid request.');
        }

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
