<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolCli;

use Zend\Db\Metadata\Metadata;
use Zend\Db\Sql\Sql;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractCommand implements ServiceLocatorAwareInterface
{
    protected $dbAdapter;
    protected $sql;
    protected $metadata;
    private $tableNames;
    private $serviceLocator;

    public function __construct($dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
        $this->sql = new Sql($this->dbAdapter);
        $this->metadata = new Metadata($this->dbAdapter);
        $this->tableNames = $this->metadata->getTableNames();
    }

    protected function query($action)
    {
        if (!is_string($action)) {
            $action = $this->sql->getSqlStringForSqlObject($action);
        }
        
        $query = $this->dbAdapter->query($action);
        $query->execute();
    }

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    protected function hasTable($name, $force = false)
    {
        if ($force) {
            $this->tableNames = $this->metadata->getTableNames();
        }
        return in_array($name, $this->tableNames);
    }
}
