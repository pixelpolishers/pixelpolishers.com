<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Mapper;

use PixPolUser\Entity\Role;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;

class RoleMapperZendDb implements RoleMapperInterface
{
    private $adapter;
    private $gateway;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        $this->gateway = new TableGateway('role', $this->adapter);
    }

    public function find($id)
    {
    }

    public function findAll()
    {
        return array();
    }

    public function persist(Role $role)
    {
        $data = array(
            'name' => $role->getName(),
        );

        if ($role->getId()) {
            $this->gateway->update($data, array(
                'id' => $role->getId(),
            ));
        } else {
            $this->gateway->insert($data);
            $role->setId($this->gateway->getLastInsertValue());
        }
    }

    public function remove(Role $role)
    {
    }
}
