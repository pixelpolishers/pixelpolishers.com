<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Application\Service;

use Zend\I18n\Translator\Translator;

class TranslatorService extends Translator
{
    public function getLocale()
    {
        return 'en_US';
    }
}
