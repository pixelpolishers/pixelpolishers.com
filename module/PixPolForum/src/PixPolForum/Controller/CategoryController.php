<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class CategoryController extends AbstractActionController
{
    public function indexAction()
    {
        $id = $this->params('category');
        $category = $this->ppForumCategory()->find($id);
        if (!$category) {
            return $this->redirect()->toRoute('developers/forum');
        }

        return array(
            'category' => $category,
        );
    }
}
