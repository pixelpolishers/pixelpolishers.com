<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Mapper;

use PixPolUser\Entity\User;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class UserMapperZendDb implements UserMapperInterface
{
    private $adapter;
    private $gateway;
    private $hydrator;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        $this->gateway = new TableGateway('user', $this->adapter);
        $this->hydrator = new ClassMethods(false);
    }

    public function find($id)
    {
        $resultSet = $this->gateway->select(array('id' => $id));

        $instance = null;

        if (count($resultSet) == 1) {
            $instance = new User();
            $this->hydrator->hydrate((array)$resultSet->current(), $instance);
        }

        return $instance;
    }

    public function findAll()
    {
        return array();
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
            $instance = new User();
            $this->hydrator->hydrate((array)$resultSet->current(), $instance);
        }

        return $instance;
    }

    public function persist(User $user)
    {
        $data = array(
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'displayName' => $user->getDisplayName(),
            'registrationDate' => $user->getRegistrationDate()->format('Y-m-d H:i:s'),
        );

        if ($user->getId()) {
            $this->gateway->update($data, array(
                'id' => $user->getId(),
            ));
        } else {
            $this->gateway->insert($data);
            $user->setId($this->gateway->getLastInsertValue());
        }

        $roleUserGateway = new TableGateway('role_user', $this->adapter);
        $roleUserGateway->delete(array('user_id' => $user->getId()));
        foreach ($user->getRoles() as $role) {
            $roleUserGateway->insert(array(
                'user_id' => $user->getId(),
                'role_id' => $role->getId(),
            ));
        }
    }

    public function remove(User $user)
    {

    }

    public function getAZUsers($letter)
    {

    }

}
