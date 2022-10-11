<?php

namespace App\Constants;

/**
 * Class PathSignatureConstant
 * @package App\Constants
 */
class SignaturesPathConstant
{
    const SIGNATURES_PATH = [
        UserAdminConstant::NAME => 'instructor-signatures/thomas_cheffro.png',
        UserSuperAdminConstant::NAME => null,
        UserInstructorConstant::NAME => null,
    ];
}
