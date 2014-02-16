<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolEmployee\Service;

use PixPolEmployee\Entity\Employee;
use PixPolEmployee\Mapper\EmployeeMapperInterface;

class EmployeeService
{
    private $mapper;

    public function __construct(EmployeeMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    public function find($id)
    {
        return $this->mapper->find($id);
    }

    public function findAll()
    {
        return $this->mapper->findAll();
    }

    public function persist(Employee $employee)
    {
        $this->mapper->persist($employee);
    }

    public function remove(Employee $employee)
    {
        $this->mapper->remove($employee);
    }
}
