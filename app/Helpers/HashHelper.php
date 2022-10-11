<?php

namespace App\Helpers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Class HashHelper
 * @package App\Helpers
 */
class HashHelper
{
    /**
     * @param $value
     * @return string
     */
    public static function encrypt($value)
    {
        return Crypt::encrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     * @throws Exception
     */
    public static function decrypt($value)
    {
        try {
            return Crypt::decrypt($value);
        } catch (DecryptException $e) {
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
}
