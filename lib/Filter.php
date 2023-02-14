<?php
/**
 * PrivateBin
 *
 * a zero-knowledge paste bin
 *
 * @link      https://github.com/PrivateBin/PrivateBin
 * @copyright 2012 Sébastien SAUVAGE (sebsauvage.net)
 * @license   https://www.opensource.org/licenses/zlib-license.php The zlib/libpng License
 * @version   1.5.1
 */

namespace PrivateBin;

use Exception;

/**
 * Filter
 *
 * Provides data filtering functions.
 */
class Filter
{
    /**
     * format a given time string into a human readable label (localized)
     *
     * accepts times in the format "[integer][time unit]"
     *
     * @access public
     * @static
     * @param int $time
     * @param string $unite
     * @throws Exception
     * @return string
     */
    public static function formatHumanReadableTime($time, $unite = 's') {
        $time = (int) $time;
        if ($time < 0) {
            throw new Exception('Invalid time');
        }
        $unite = strtolower($unite);
        if ($unite === 's') {
            $unite = I18n::_('second');
        } elseif ($unite === 'm') {
            $unite = I18n::_('minute');
        } elseif ($unite === 'h') {
            $unite = I18n::_('hour');
        } elseif ($unite === 'd') {
            $unite = I18n::_('day');
        } elseif ($unite === 'w') {
            $unite = I18n::_('week');
        } elseif ($unite === 'm') {
            $unite = I18n::_('month');
        } elseif ($unite === 'y') {
            $unite = I18n::_('year');
        } else {
            throw new Exception('Invalid time unit');
        }
        if ($time === 0) {
            return I18n::_('never');
        } elseif ($time === 1) {
            return I18n::_('%d ' . $unite, $time);
        } else {
            return I18n::_('%d ' . $unite . 's', $time);
        }
    }
    

    /**
     * format a given number of bytes in IEC 80000-13:2008 notation (localized)
     *
     * @access public
     * @static
     * @param  int $size
     * @return string
     */
    public static function formatHumanReadableSize($size)
    {
        $iec = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
        $i   = 0;
        while (($size / 1024) >= 1) {
            $size = $size / 1024;
            ++$i;
        }
        return number_format($size, ($i ? 2 : 0), '.', ' ') . ' ' . I18n::_($iec[$i]);
    }
}
