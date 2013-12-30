<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainDevelopers\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class DocsController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function manualAction()
    {
        $project= $this->params('project');
        $version = $this-> params('version');
        $page = $this->params('page', 'index');

        if (!$project || !$page || !$version) {
            return $this->notFoundAction();
        }

        $config = $this->getServiceLocator()->get('Config');
        $docsConfig = $config['makedocs'];

        if (!array_key_exists($project, $docsConfig)) {
            return $this->notFoundAction();
        }

        $pageDir = $docsConfig[$project]['builders']['html']['outputDirectory'];
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
