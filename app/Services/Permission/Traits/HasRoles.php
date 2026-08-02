<?php

namespace App\Services\Permission\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use function PHPUnit\Framework\isEmpty;

trait HasRoles
{
    /* Relation Methods */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /* End Relation Methods */

    public function giveRoles(...$roleNames): static
    {
        $roles = $this->getAllRoles($roleNames);
        if ($roles->isEmpty()) return $this;

        $this->roles()->syncWithoutDetaching($roles);
        return $this;
    }

    public function withdrawRoles(...$roles): static
    {
        $roles = $this->getAllRoles($roles);
        $this->roles()->detach($roles);
        return $this;
    }

    public function refreshRoles(...$roles): static
    {
        $roles = $this->getAllRoles($roles);
        $this->roles()->sync($roles);
        return $this;
    }

    public function hasRole(... $roleNames): bool
    {
        return $this->roles()->whereIn('name', $roleNames)->exists();
    }

    protected function getAllRoles(array $roleNames): Collection
    {
        return Role::whereIn('name', Arr::flatten($roleNames))->get();
    }
}
