<?php

namespace App\Providers;

use App\Constants\PermissionsConstant;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\Dashboard;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard)
    {
        foreach (config('access.permissions') as $group => $permissions) {
            $itemPermissions = ItemPermission::group($group);
            foreach ($permissions  as $permissionName => $permissionDescription) {
                $itemPermissions->addPermission($permissionName, $permissionDescription);
            }
            $dashboard->registerPermissions($itemPermissions);
        }
    }
}
