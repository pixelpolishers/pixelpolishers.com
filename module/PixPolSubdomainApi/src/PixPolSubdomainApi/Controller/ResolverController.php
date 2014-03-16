<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainApi\Controller;

use PixelPolishers\Resolver\Adapter\Pdo\Pdo;
use PixelPolishers\Resolver\Server\Controller\LookupController;
use PixelPolishers\Resolver\Server\Controller\SearchController;
use PixelPolishers\Resolver\Server\Controller\ResolverController as ResServController;
use PixelPolishers\Resolver\Search\AdapterSearchProvider;
use PixelPolishers\Resolver\Server\Router\Router;
use PixelPolishers\Resolver\Server\Server;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Http\Header\ContentType;

class ResolverController extends AbstractActionController
{
    public function catchAllAction()
    {
        $dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $pdo = $dbAdapter->getDriver()->getConnection()->getResource();

        $adapter = new Pdo($pdo);
        $adapter->setTablePrefix('resolver_');

        $searchProvider = new AdapterSearchProvider($adapter);

        $router = new Router();
        $router->setController('/resolver/lookup', new LookupController());
        $router->setController('/resolver/search', new SearchController($searchProvider));
        $router->setController('/resolver/resolver.json', new ResServController());

        $server = new Server($router, $adapter);
        $content = $server->run();

        $typeHeader = ContentType::fromString('Content-Type: application/json');

        $response = $this->getResponse();
        $response->getHeaders()->addHeader($typeHeader);
        $response->setContent($content);
        return $response;
    }
}
