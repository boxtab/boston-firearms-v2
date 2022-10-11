<?php

namespace App\Helpers;

use Closure;

/**
 * Class PermissionsHelper
 * @package App\Helpers
 */
class PermissionsHelper
{
    /**
     * Get the list of permissions as an array.
     *
     * @param bool $allowed
     * @return array
     */
    public static function getPermissionAll($allowed = false): array
    {
        $permissionList = [];

        foreach(config('access.permissions') as $group) {
            foreach($group as $permissionName => $permissionDescription) {
                $permissionList[$permissionName] = $allowed;
            }
        }

        return $permissionList;
    }

    /**
     * Give permission to all groups except those listed.
     *
     * @param array $exceptGroup
     * @return array
     */
    public static function getPermissionExceptGroup(array $exceptGroup): array
    {
        $allowed = function ($groupName, $customGroups) {
            return ( ! in_array($groupName, $customGroups)) ? true : false;
        };

        return self::getPermissionGroup($exceptGroup, $allowed);
    }

    /**
     * Grant permission to the listed groups only.
     *
     * @param array $exceptGroup
     * @return array
     */
    public static function getPermissionOnlyGroup(array $exceptGroup): array
    {
        $allowed = function ($groupName, $customGroups) {
            return ( in_array($groupName, $customGroups)) ? true : false;
        };

        return self::getPermissionGroup($exceptGroup, $allowed);
    }

    /**
     * Determines which groups to grant permission and which not.
     *
     * @param array $groupExcept
     * @param Closure $isAllowed
     * @return array
     */
    private static function getPermissionGroup(array $groupExcept, Closure $isAllowed): array
    {
        $permissionList = [];

        foreach(config('access.permissions') as $groupName => $group) {
            $allowed = $isAllowed($groupName, $groupExcept);
            foreach($group as $permissionName => $permissionDescription) {
                $permissionList[$permissionName] = $allowed;
            }
        }

        return $permissionList;
    }
}
