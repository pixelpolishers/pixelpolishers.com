<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolEmployee\Mapper;

use PixPolEmployee\Entity\Employee;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;

class EmployeeMapperZendDb implements EmployeeMapperInterface
{
    private $adapter;
    private $gateway;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        $this->gateway = new TableGateway('employee', $this->adapter);
    }

    public function find($id)
    {
    }

    public function findAll()
    {
        return array();
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
