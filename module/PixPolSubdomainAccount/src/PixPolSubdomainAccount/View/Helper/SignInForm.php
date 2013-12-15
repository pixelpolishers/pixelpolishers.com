<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\View\Helper;

use PixPolSubdomainAccount\Form;
use Zend\View\Helper\AbstractHelper;

class SignInForm extends AbstractHelper
{
    private $signInForm;

    public function __construct(Form\SignInForm $form)
    {
        $this->signInForm = $form;
    }

    public function __invoke()
    {
        $result = '';

        $action = $this->view->url('account/signin');

        $this->signInForm->setAttribute('action', $action);
        $this->signInForm->prepare();

        $result .= $this->view->form()->openTag($this->signInForm);

        $result .= $this->view->formRow($this->signInForm->get('identity'));
        $result .= $this->view->formRow($this->signInForm->get('credential'));
        $result .= $this->view->formRow($this->signInForm->get('signin'));

        $result .= $this->view->form()->closeTag();

        return $result;
    }
}
