<?php

namespace App\Services\Permission\Traits;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;

trait HasPermissions
{
    /* Relation Methods */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /* End Relation Methods */

    public function givePermissions(...$permissionNames): static
    {
        $permissions = $this->getAllPermissions($permissionNames);

        if ($permissions->isEmpty()) return $this;

        $this->permissions()->syncWithoutDetaching($permissions);
        return $this;
    }

    public function withdrawPermissions(...$permissions): static
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissions(...$permissions): static
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->sync($permissions);
        return $this;
    }

    public function hasPermission(Permission $permission): bool
    {
        return $this->hasPermissionThroughRole($permission) || $this->permissions->contains($permission);
    }

    protected function hasPermissionThroughRole(Permission $permission): bool
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) return true;
        }
        return false;
    }

    protected function getAllPermissions(array $permissionNames): Collection
    {
        return Permission::whereIn('name', Arr::flatten($permissionNames))->get();
    }
}
