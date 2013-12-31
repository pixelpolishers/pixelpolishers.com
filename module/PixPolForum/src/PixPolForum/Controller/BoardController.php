<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class BoardController extends AbstractActionController
{
    public function indexAction()
    {
        $id = $this->params('board');

        return array(
            'board' => $this->ppForumBoard()->find($id),
        );
    }
}
