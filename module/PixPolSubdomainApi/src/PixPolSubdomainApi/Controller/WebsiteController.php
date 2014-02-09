<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainApi\Controller;

use PixPolSubdomainApi\Service\DocsGenerator;
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
        if ($payload) {
            $json = json_decode($payload);

            return in_array($json->ref, $refs);
        }
        return false;
    }

    public function buildDocsAction()
    {
        $remoteAddress = new \Zend\Http\PhpEnvironment\RemoteAddress();
        if (!$this->isValidIp($remoteAddress->getIpAddress())) {
            throw new \RuntimeException('Invalid request.');
        }

        $f = fopen(__DIR__ . '/../../../../../payload.log', 'w');
        fwrite($f, print_r($_POST['payload'], true));
        fclose($f);

        $refs = array('refs/heads/master', 'refs/heads/develop');
        $payload = array_key_exists('payload', $_POST) ? $_POST['payload'] : '';
        if (!$this->isValidPayload($payload, $refs)) {
            throw new \RuntimeException('Invalid request.');
        }

        $json = json_decode($payload);
        $config = $this->getServiceLocator()->get('Config');

        $generator = new DocsGenerator();
        $generator->setReference($json->ref);
        $generator->setRepository($json->repository->name);

        try {
            $generator->generate($config['makedocs']);
        } catch (\Exception $e) {
            $f = fopen(__DIR__ . '/../../../../../docs-errors.log', 'w');
            fwrite($f, $e->getMessage() . PHP_EOL . PHP_EOL);
            fwrite($f, print_r($generator, true));
            fwrite($f, print_r($config['makedocs'], true));
            fclose($f);
        }

        return $this->getResponse();
    }

    public function buildWebsiteAction()
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
        if (!is_file($buildFile)) {
            throw new \RuntimeException('No build file found.');
        }

        $process = new Process($buildFile);
        $process->run();

        if (!$process->isSuccessful()) {
            // TODO: Send an e-mail.
        }

        return $this->getResponse();
    }
}
