<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolEmployee\Mapper;

use PixPolEmployee\Entity\Employee;
use PixPolEmployee\Mapper\ZendDb\EmployeeProxy;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class EmployeeMapperZendDb implements EmployeeMapperInterface
{
    private $adapter;
    private $gateway;
    private $hydrator;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        $this->gateway = new TableGateway('employee', $this->adapter);
        $this->hydrator = new ClassMethods();
    }

    public function find($id)
    {
        $resultSet = $this->gateway->select(array('id' => $id));

        $instance = null;

        if (count($resultSet) == 1) {
            $instance = new EmployeeProxy($this);
            $this->hydrator->hydrate((array)$resultSet->current(), $instance);
        }

        return $instance;
    }

    public function findAll()
    {
        $resultSet = $this->gateway->select();

        $result = array();

        foreach ($resultSet as $resultRow) {
            $instance = new EmployeeProxy($this);
            $this->hydrator->hydrate((array)$resultRow, $instance);

            $result[] = $instance;
        }

        return $result;
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
    }

    public function findOneBy(array $criteria, array $orderBy = null)
    {
        $select = new \Zend\Db\Sql\Select($this->gateway->getTable());
        $select->where($criteria);

        if ($orderBy) {
            $select->order($orderBy);
        }

        $resultSet = $this->gateway->selectWith($select);

        $instance = null;

        if (count($resultSet) == 1) {
            $instance = new EmployeeProxy($this);
            $this->hydrator->hydrate((array)$resultSet->current(), $instance);
        }

        return $instance;
    }

    public function persist(Employee $employee)
    {
        $data = array(
            'user_id' => $employee->getUser()->getId(),
        );

        if ($employee->getId()) {
            $this->gateway->update($data, array(
                'id' => $employee->getId(),
            ));
        } else {
            $this->gateway->insert($data);
            $employee->setId($this->gateway->getLastInsertValue());
        }
    }

    public function remove(Employee $employee)
    {
    }
}
