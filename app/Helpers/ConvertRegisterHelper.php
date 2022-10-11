<?php

namespace App\Helpers;

/**
 * Class ConvertCaseRegister
 * @package App\Helpers
 */
class ConvertRegisterHelper
{
    /**
     * @param $snakeCase
     * @return string|string[]
     */
    public static function snakeCaseToUpperCamelCase($snakeCase)
    {
        return str_replace('_', '', ucwords($snakeCase, '_'));
    }

    /**
     * @param $snakeCase
     * @return string
     */
    function snakeCaseToLowerCamelCase($snakeCase)
    {
        $upperCamelCase = str_replace('_', '', ucwords($snakeCase, '_'));

        return lcfirst($upperCamelCase);
    }
}
