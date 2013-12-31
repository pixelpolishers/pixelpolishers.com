<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolWikiDoctrineORM;

return array(
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/doctrine')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'PixPolWiki\Entity' => __NAMESPACE__,
                ),
            ),
        ),
    ),
);
