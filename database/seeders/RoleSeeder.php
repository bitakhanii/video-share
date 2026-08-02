<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $rolesWithPermissions = [

            'admin' => [
                'video.create', 'video.edit', 'video.delete', 'video.view',
                'user.view', 'user.create', 'user.edit', 'user.delete',
                'comment.view', 'comment.delete',
                'category.create', 'category.edit', 'category.delete',
                'report.view', 'analytics.view',
                'settings.manage', 'role.manage', 'permission.manage',
            ],

            'video-manager' => [
                'video.create', 'video.edit', 'video.delete', 'video.view',
                'category.create', 'category.edit',
                'analytics.view',
            ],

            'moderator' => [
                'comment.view', 'comment.delete',
                'user.view',
                'video.view',
            ],

            'editor' => [
                'video.view', 'video.edit',
                'category.edit',
                'comment.view',
            ],

            'support' => [
                'user.view',
                'comment.view',
                'report.view',
            ],

            'user' => [],
        ];

        $roleNames = [
            'admin' => 'مدیر',
            'video-manager' => 'مدیر ویدئو',
            'moderator' => 'ناظر',
            'editor' => 'ویرایشگر',
            'support' => 'پشتیبانی',
            'user' => 'کاربر',
        ];

        foreach ($rolesWithPermissions as $roleName => $permissionNames) {
            $role = Role::firstOrCreate(
                ['name' => $roleName],
                ['persian_name' => $roleNames[$roleName]]
            );

            $permissionIds = Permission::whereIn('name', $permissionNames)->pluck('id');

            $role->permissions()->syncWithoutDetaching($permissionIds);
        }
    }
}
