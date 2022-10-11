<?php

namespace App\Helpers;

use App\Constants\UserSuperAdminConstant;
use App\Models\User;

/**
 * Class ClientHelper
 * @package App\Helpers
 */
class ClientHelper
{
    /**
     * @return int
     */
    public static function getUserIdForAddedBy()
    {
        return UserSuperAdminConstant::ID;
    }
}
