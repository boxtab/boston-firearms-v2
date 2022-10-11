<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

/**
 * Class StringHelper
 * @package App\Helpers
 */
class StringHelper
{
    /**
     * @param string|null $string
     * @param int|null $length
     * @return string|string|null
     */
    public static function substr(?string $string, ?int $length)
    {
        if (is_null($string) || is_null($length)) {
            return $string;
        }

        return mb_strlen($string) > $length
            ? mb_substr($string, 0, $length) . '...'
            : $string;
    }


    public static function getPicturePath(?array $arrayField): ?string
    {
        if ( is_null($arrayField) || (! count($arrayField)) || ( ! array_key_exists('signature_path', $arrayField) ) ) {
            return null;
        }

        $host = request()->schemeAndHttpHost() . '/';

        return substr($arrayField['signature_path'], strlen($host));
    }
}
