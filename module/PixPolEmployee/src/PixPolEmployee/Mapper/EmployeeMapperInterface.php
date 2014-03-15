<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolEmployee\Mapper;

use PixPolEmployee\Entity\Employee;

interface EmployeeMapperInterface
{
    public function find($id);
    public function findAll();
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null);
    public function findOneBy(array $criteria, array $orderBy = null);
    public function persist(Employee $user);
    public function remove(Employee $user);
}
