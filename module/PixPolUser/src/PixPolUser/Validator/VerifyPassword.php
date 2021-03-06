<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Validator;

use PixPolUser\Service\UserService;
use Zend\InputFilter\Input;
use Zend\Validator\AbstractValidator;

class VerifyPassword extends AbstractValidator
{
    const ERROR_PASSWORD_NOT_VALID = 'passwordNotValid';

    protected $messageTemplates = array(
        self::ERROR_PASSWORD_NOT_VALID => 'Invalid password provided',
    );

    private $service;
    private $input;

    public function __construct(UserService $service, $input)
    {
        parent::__construct();

        $this->service = $service;
        $this->input = $input;
    }

    public function isValid($value)
    {
        $this->setValue($value);

        if ($this->input instanceof Input) {
            $input = $this->input->getValue();
        } else {
            $input = $this->input;
        }

        $user = $this->service->findByEmail($input);
        if ($user !== null && $this->service->getPassword()->verify($user, $value)) {
            return true;
        }

        $this->error(self::ERROR_PASSWORD_NOT_VALID);
        return false;
    }
}
