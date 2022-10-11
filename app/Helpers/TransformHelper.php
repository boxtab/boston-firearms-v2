<?php

namespace App\Helpers;

/**
 * Class TransformHelper
 * @package App\Helpers
 */
class TransformHelper
{
    /**
     * Double question mark php 7 only.
     *
     * @param $value
     * @param null $default
     * @return null
     */
    public static function doubleQuestionMark($value, $default = null)
    {
        if ( ! empty($value) ) {
            $result = $value;
        } else {
            $result = $default;
        }

        return $result;
    }
}
