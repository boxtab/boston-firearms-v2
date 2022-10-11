<?php

namespace App\Constants;

/**
 * Class ResultPerPageConstant
 * @package App\Constants
 */
class ResultPerPageConstant
{
    const ATTENDEES = [
        25 => '25',
        50 => '50',
        100 => '100',
        0 => 'View All',
    ];

    /**
     * @return mixed|null
     */
    public static function getFirstPagination()
    {
        return array_values(self::ATTENDEES)[0];
    }
}
