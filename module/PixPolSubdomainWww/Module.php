<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainWww;

use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        if (!extension_loaded('intl')) {
            /** @var HelperPluginManager $helperPluginManger */
            $helperPluginManger = $e->getApplication()->getServiceManager()->get('ViewHelperManager');
            $helperPluginManger->addInitializer(function($helper) {
                if ($helper instanceof TranslatorAwareInterface) {
                    $helper->setTranslatorEnabled(false);
                }
            });
        }
    }
}