<?php

namespace App\Services;

use App\Helpers\ConvertRegisterHelper;
use App\Traits\RolesTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

/**
 * Class CreateUserService
 * @package App\Services
 */
class CreateUserService
{
    use RolesTrait;

    /**
     * @var int
     */
    private $roleId;

    /**
     * @var string
     */
    private $roleSlug;

    /**
     * @var string
     */
    private $roleName;

    /**
     * @var Collection
     */
    private $rolePermissions;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $userEmail;

    /**
     * @var string
     */
    private $userPassword;

    /**
     * @var string
     */
    private $envVariableNameEmail;

    /**
     * @var string
     */
    private $envVariableNamePassword;

    /**
     * CreateUserService constructor.
     * "super_admin" or "admin" or ...
     *
     * @param string $userName
     */
    public function __construct($userName)
    {
        /*
         * Role
         */
        $this->roleId = config("access.roles.$userName.id");
        $this->roleSlug = config("access.roles.$userName.slug");
        $this->roleName = config("access.roles.$userName.name");
        $permissionsMethodName = 'getExtensionsFor' . ConvertRegisterHelper::snakeCaseToUpperCamelCase($userName);
        $permissionsArray = $this->{$permissionsMethodName}();
        $this->rolePermissions = collect($permissionsArray);

        /*
         * User
         */
        $this->userId = config("access.users.$userName.id");
        $this->userName = config("access.users.$userName.name");
        $this->userEmail = config("access.users.$userName.email");
        $this->userPassword = is_null(config("access.users.$userName.password"))
            ? null
            : Hash::make(config("access.users.$userName.password"));

        /*
         * Environment variable name
         */
        $this->envVariableNameEmail = 'USER_' . strtoupper($userName) . '_EMAIL';
        $this->envVariableNamePassword = 'USER_' . strtoupper($userName) . '_PASSWORD';
    }

    /**
     * @return bool
     */
    public function emailIsNull()
    {
        return is_null($this->userEmail);
    }

    /**
     * @return bool
     */
    public function passwordIsNull()
    {
        return is_null($this->userPassword);
    }

    /**
     * @return string
     */
    public function getEmailErrorMessage()
    {
        return "Variable '$this->envVariableNameEmail' not set in environment file!";
    }

    /**
     * @return string
     */
    public function getPasswordErrorMessage()
    {
        return "Variable '$this->envVariableNamePassword' not set in environment file!";
    }

    /**
     * @return string
     */
    public function getTextSuccessMessage()
    {
        return "User '$this->userName' has been created. Role '$this->roleName' created. And assigned to him";
    }

    /**
     * @throws Exception
     */
    public function seeding()
    {
        DB::beginTransaction();

        try {
            DB::table('roles')->upsert([
                [
                    'id' => $this->roleId,
                    'slug' => $this->roleSlug,
                    'name' => $this->roleName,
                    'permissions' => $this->rolePermissions,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ], ['id'], ['slug', 'name', 'permissions', 'created_at', 'updated_at']);


            DB::table('users')->upsert([
                [
                    'id' => $this->userId,
                    'name' => $this->userName,
                    'email' => $this->userEmail,
                    'password' => $this->userPassword,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ], ['id'], ['name', 'email', 'password', 'created_at', 'updated_at']);

            DB::table('role_users')->upsert([
                [
                    'user_id' => $this->userId,
                    'role_id' => $this->roleId,
                ],
            ], ['user_id', 'role_id'], ['user_id', 'role_id']);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e->getMessage());
        }
    }
}
