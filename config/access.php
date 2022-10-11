<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Permissions List
    |--------------------------------------------------------------------------
    |
    */
    'permissions' => \App\Constants\PermissionsConstant::PERMISSIONS,

    /*
    |--------------------------------------------------------------------------
    | Roles List
    |--------------------------------------------------------------------------
    |
    */
    'roles' => [

        'super_admin' => [
            'id' => \App\Constants\RoleSuperAdminConstant::ID,
            'slug' => \App\Constants\RoleSuperAdminConstant::SLUG,
            'name' => \App\Constants\RoleSuperAdminConstant::NAME,
        ],

        'admin' => [
            'id' => \App\Constants\RoleAdminConstant::ID,
            'slug' => \App\Constants\RoleAdminConstant::SLUG,
            'name' => \App\Constants\RoleAdminConstant::NAME,
        ],

        'instructor' => [
            'id' => \App\Constants\RoleInstructorConstant::ID,
            'slug' => \App\Constants\RoleInstructorConstant::SLUG,
            'name' => \App\Constants\RoleInstructorConstant::NAME,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Users List
    |--------------------------------------------------------------------------
    |
    */
    'users' => [
        'super_admin' => [
            'id' => \App\Constants\UserSuperAdminConstant::ID,
            'name' => \App\Constants\UserSuperAdminConstant::NAME,
            'email' => env('USER_SUPER_ADMIN_EMAIL'),
            'password' => env('USER_SUPER_ADMIN_PASSWORD'),
        ],

        'admin' => [
            'id' => \App\Constants\UserAdminConstant::ID,
            'name' => \App\Constants\UserAdminConstant::NAME,
            'email' => env('USER_ADMIN_EMAIL'),
            'password' => env('USER_ADMIN_PASSWORD'),
        ],

        'instructor' => [
            'id' => \App\Constants\UserInstructorConstant::ID,
            'name' => \App\Constants\UserInstructorConstant::NAME,
            'email' => env('USER_INSTRUCTOR_EMAIL'),
            'password' => env('USER_INSTRUCTOR_PASSWORD'),
        ],
    ],

];
