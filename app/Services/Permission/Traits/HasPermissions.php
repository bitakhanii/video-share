<?php

namespace App\Services\Permission\Traits;

use App\Models\Permission;
use Illuminate\Support\Arr;

Trait HasPermissions
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissions(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);

        if ($permissions->isEmpty()) return $this;

        $this->permissions()->syncWithoutDetaching($permissions);
    }

    public function withdrawPermissions(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissions(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->sync($permissions);
    }

    public function hasPermission(Permission $permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->permissions->contains($permission);
    }

    protected function hasPermissionThroughRole(Permission $permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) return true;
        }
        return false;
    }

    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('name', Arr::flatten($permissions))->get();
    }
}
