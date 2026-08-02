<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        $userRole = Role::where('name', 'user')->first();
        $adminRoles = Role::where('name', '!=', 'user')->pluck('id');

        User::all()->each(function ($user) use ($userRole, $adminRoles) {
            $user->roles()->syncWithoutDetaching([$userRole->id]);

            if (rand(1, 100) <= 15) {
                $randomAdminRole = $adminRoles->random(rand(1, 2));
                $user->roles()->syncWithoutDetaching($randomAdminRole);
            }
        });
    }
}
