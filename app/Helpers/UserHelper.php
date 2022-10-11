<?php

namespace App\Helpers;

use App\Constants\UserAdminConstant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class UserHelper
 * @package App\Helpers
 */
class UserHelper
{
    /**
     * @return User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public static function instructor()
    {
        if (Auth::check()) {
            $user = Auth::user();
        } else {
            $user = User::find(UserAdminConstant::ID);
        }

        return $user;
    }
}
