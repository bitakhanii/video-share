<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionUserSeeder extends Seeder
{
    public function run(): void
    {
        User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'user');
        })->inRandomOrder()->take(5)->each(function ($user) {
            $permissionIds = Permission::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $user->permissions()->syncWithoutDetaching($permissionIds);
        });
    }
}
