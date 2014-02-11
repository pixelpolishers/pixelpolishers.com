<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolDocs\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ManualController extends AbstractActionController
{
    public function indexAction()
    {
        $project = $this->params('project');
        $version = $this-> params('version');
        $page = $this->params('page', 'index');

        if (!$project || !$page || !$version) {
            return $this->notFoundAction();
        }

        $config = $this->getServiceLocator()->get('Config');
        $docsConfig = $config['makedocs']['listeners'];

        if (!array_key_exists($project, $docsConfig)) {
            return $this->notFoundAction();
        }

        $pageDir = $docsConfig[$project]['builders'][0]['output'];
        $pageDir = str_replace('{version}', $version, $pageDir);
        $pageDir = realpath($pageDir);

        if (!$pageDir) {
            return $this->notFoundAction();
        }

        $pagePath = realpath($pageDir . '/' . $page . '.html');
        if (!is_file($pagePath)) {
            return $this->notFoundAction();
        }

        $content = file_get_contents($pagePath);

        return array(
            'content' => $content,
        );
    }
}
