<?php

namespace App\Traits;

use App\Helpers\PermissionsHelper;

/**
 * Trait RolesTrait
 * @package App\Traits
 */
trait RolesTrait
{
    /**
     * Get list of permissions for super admin role.
     *
     * @return array
     */
    private function getExtensionsForSuperAdmin(): array
    {
        return PermissionsHelper::getPermissionAll(true);
    }

    /**
     * Get list of permissions for admin role.
     *
     * @return array
     */
    private function getExtensionsForAdmin(): array
    {
        return PermissionsHelper::getPermissionExceptGroup(['PlatformSystems', 'Permissions', 'Roles', 'Instructor']);
    }

    /**
     * Get list of permissions for admin instructor.
     *
     * @return array
     */
    private function getExtensionsForInstructor(): array
    {
        return PermissionsHelper::getPermissionOnlyGroup(['Platform', 'Events', 'Clients', 'Appointments', 'Instructor']);
    }
}
