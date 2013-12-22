<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Zend\EventManager\EventManager;

class PermissionService
{
    const EVENT_FIND_PERMISSIONS = 'EventFindPermissions';

    private $eventManager;
    private $cachedPermissions;

    public function find($name)
    {
        $permissions = $this->findAll();
        foreach ($permissions as $permission) {
            if ($permission->getName() === $name) {
                return $permission;
            }
        }
        return null;
    }

    public function findAll()
    {
        if ($this->cachedPermissions === null) {
            $this->cachedPermissions = new ArrayCollection();

            $this->getEventManager()->trigger(self::EVENT_FIND_PERMISSIONS, $this->cachedPermissions);
        }
        return $this->cachedPermissions;
    }

    private function getEventManager()
    {
        if ($this->eventManager === null) {
            $this->eventManager = new EventManager(__CLASS__);
        }
        return $this->eventManager;
    }
}
