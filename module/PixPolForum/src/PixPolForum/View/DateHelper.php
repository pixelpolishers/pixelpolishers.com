<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolForum\View;

use DateTime;
use Zend\View\Helper\AbstractHelper;

class DateHelper extends AbstractHelper
{
    public function __invoke(DateTime $date)
    {
        $currentDate = new DateTime();
        $diff = $currentDate->diff($date);

        $result = '';
        if ($diff->y > 0) {
            $result = $this->format($diff->y, 'year', 'years');
        } else if ($diff->m > 0) {
            $result = $this->format($diff->m, 'month', 'months');
        } else if ($diff->d > 0) {
            $result = $this->format($diff->d, 'day', 'days');
        } else if ($diff->h > 0) {
            $result = $this->format($diff->h, 'hour', 'hours');
        } else if ($diff->i > 0) {
            $result = $this->format($diff->i, 'minute', 'minutes');
        } else {
            $result = 'Written just now';
        }

        return $result;
    }

    private function format($amount, $singular, $plural)
    {
        return 'Written ' . $amount . ' '.  ($amount == 1 ? $singular : $plural) . ' ago';
    }
}
