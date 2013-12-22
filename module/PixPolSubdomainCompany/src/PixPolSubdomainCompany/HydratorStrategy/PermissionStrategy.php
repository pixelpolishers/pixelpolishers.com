<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany\HydratorStrategy;

use PixPolUser\Service\PermissionService;
use Zend\Stdlib\Hydrator\Strategy\DefaultStrategy;

class PermissionStrategy extends DefaultStrategy
{
    private $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function extract($value)
    {
        $result = array();

        foreach ($value as $permission) {
            $result[$permission] = $permission;
        }
        
        return $result;
    }

    public function hydrate($value)
    {
        $result = array();
        foreach ($value as $entry) {
            $result[] = $this->permissionService->find($entry);
        }
        return $result;
    }
}
