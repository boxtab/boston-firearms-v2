<?php

namespace App\Helpers;

use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class DateTimeHelper
 * @package App\Helpers
 */
class DateTimeHelper
{
    /**
     * @param string|null $startDate
     * @param string|null $endDate
     * @return DatePeriod
     * @throws Exception
     */
    public static function getPeriod(?string $startDate, ?string $endDate)
    {
        if ( is_null($startDate) ) {
            throw new Exception('Period start not specified!');
        }

        if ( is_null($endDate) ) {
            throw new Exception('End of period not specified!');
        }

        $endDateInclusive = (clone (new DateTime($endDate)))->modify('next day');

        try {
            return new DatePeriod(
                new DateTime($startDate),
                new DateInterval('P1D'),
                $endDateInclusive
            );
        } catch (Exception $e) {
            throw new Exception('Cannot create a period from an interval!');
        }
    }

    /**
     * @param string $firstDayMonth
     * @return string
     */
    public static function getLastDayMonth(string $firstDayMonth): string
    {
        // Converting string to date
        $date = strtotime($firstDayMonth);

        // Last date of current month.
        $lastDate = strtotime(date("Y-m-t", $date ));

        // Day of the last date
        return date("Y-m-d", $lastDate);
    }

    /**
     * @param string|null $date
     * @return false|string|null
     */
    public static function getDateUnitedStates(?string $date)
    {
        return is_null($date)
            ? null
            : date('m/d/Y', strtotime($date));
    }
}
