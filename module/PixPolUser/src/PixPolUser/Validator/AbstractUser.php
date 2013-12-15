<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolUser\Validator;

use PixPolUser\Mapper\MapperInterface;
use Zend\Validator\AbstractValidator;

abstract class AbstractUser extends AbstractValidator
{
    const ERROR_NO_USER_EXISTS = 'noUserExists';
    const ERROR_USER_EXISTS = 'userExists';

    protected $messageTemplates = array(
        self::ERROR_NO_USER_EXISTS => 'No user was found',
        self::ERROR_USER_EXISTS => 'The user already exists',
    );

    private $mapper;

    public function __construct(MapperInterface $mapper)
    {
        parent::__construct();
        
        $this->mapper = $mapper;
    }

    protected function getUser($value)
    {
        return $this->mapper->findByEmail($value);
    }

}
