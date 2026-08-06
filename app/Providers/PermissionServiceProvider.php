<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Permission::all()->map(function ($permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->hasPermission($permission);
            });
        });

        Role::all()->map(function ($role) {
            Gate::define('role:' . $role->name, function ($user) use ($role) {
                return $user->hasRole($role->name);
            });
        });

        Blade::if('role', function (...$roleNames) {
            if (!auth()->check()) {
                return false;
            }

            if (auth()->guard('admin')) {
                return true;
            }

            return auth()->user()->hasRole(...$roleNames);
        });
    }
}
