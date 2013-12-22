<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PermissionServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $instance = new PermissionService();

        if (array_key_exists('pixpoluser', $config)) {
            if (array_key_exists('accessfile_path', $config['pixpoluser'])) {
                $instance->setAccessFilePath($config['pixpoluser']['accessfile_path']);
            }
        }

        return $instance;
    }
}
