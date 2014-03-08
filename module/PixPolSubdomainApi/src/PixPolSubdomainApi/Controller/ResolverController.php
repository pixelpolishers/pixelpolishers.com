<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainApi\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ResolverController extends AbstractActionController
{
    public function catchAllAction()
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $pdo = $dbAdapter->getDriver()->getConnection()->getResource();
        
        $adapter = new \PixelPolishers\Resolver\Adapter\Pdo\Pdo($pdo);
        $adapter->setTablePrefix('resolver_');

        $router = new PixelPolishers\Resolver\Server\Router\Router();
        $router->setSearchUrl('/resolver/search');
        $router->setResolverUrl('/resolver/resolver.json');

        $server = new \PixelPolishers\Resolver\Server\Server($router, $adapter);
        $server->run();

        return $this->response();
    }
}
