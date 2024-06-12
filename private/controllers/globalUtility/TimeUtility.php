<?php
namespace App\Controllers\GlobalUtility;

use DateTime;
use DateTimeZone;

/**
 * A utility class for time operations
 */
class TimeUtility
{
    /**
     * Get the current date and time.
     * 
     * @param string $format The format to use.
     * 
     * @return string The current date and time.
     */
    public static function getCurrentDateTime(string $format = 'd-m-Y H:i:s'): string
    {
        $now = new DateTime('now');
        return $now->format($format);
    }

    /**
     * Get the current time.
     *
     * @param string $format The format to use.
     * @param string $timezone The timezone to use.
     * 
     * @return string The current time.
     */
    public static function getCurrentTime(string $format = 'd-m-Y H:i:s', string $timezone = 'Europe/Amsterdam'): string
    {
        $now = new DateTime('now', new DateTimeZone($timezone));
        return $now->format($format);
    }
}
