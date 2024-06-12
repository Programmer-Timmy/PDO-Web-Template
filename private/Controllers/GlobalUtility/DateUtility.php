<?php
namespace App\Controllers\GlobalUtility;


use DateTime;

/**
 * A utility class for date operations
 */
class DateUtility  
{
    /**
     * Calculate the time difference between the current time and a given time.
     * 
     * @param string $date The time to calculate the difference from.
     * 
     * @return string The time difference.
     */
    public static function calculateTimeAgo(string $date): string
    {
        $date = new DateTime($date);
        $now = new DateTime('now');
        $diff = $now->diff($date);

        return match (true) {
            $diff->y > 0 => $diff->format('%y years ago'),
            $diff->m > 0 => $diff->format('%m months ago'),
            $diff->d > 0 => $diff->format('%d days ago'),
            $diff->h > 0 => $diff->format('%h hours ago'),
            $diff->i > 0 => $diff->format('%i minutes ago'),
            default => 'Just now',
        };
    }

    /**
     * Format a given date.
     * 
     * @param string $date The date to format.
     * @param string $format The format to use.
     * 
     * @return string The formatted date.
     */
    public static function formatDate(string $date, string $format = 'd-m-Y H:i:s'): string
    {
        $date = new DateTime($date);
        return $date->format($format);
    }

    /**
     * Get the current date.
     * 
     * @param string $format The format to use.
     * 
     * @return string The current date.
     */
    public static function getCurrentDate(string $format = 'd-m-Y'): string
    {
        $now = new DateTime('now');
        return $now->format($format);
    }
}
