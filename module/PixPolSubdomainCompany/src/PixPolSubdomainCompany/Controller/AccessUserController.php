<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainCompany\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AccessUserController extends AbstractActionController
{
    public function viewAction()
    {
        $service = $this->getServiceLocator()->get('PixPolUserService');
        $entity = $service->find($this->params('id'));

        if (!$entity) {
            return $this->redirect()->toRoute('company/access');
        }

        return array(
            'user' => $entity,
        );
    }
}
