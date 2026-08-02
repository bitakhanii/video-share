<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'video.create' => 'ایجاد ویدئو',
            'video.edit' => 'ویرایش ویدئو',
            'video.delete' => 'حذف ویدئو',
            'video.view' => 'نمایش ویدئوها',

            'user.view' => 'مایش کاربران',
            'user.create' => 'ایجاد کاربر',
            'user.edit' => 'ویرایش کاربر',
            'user.delete' => 'حذف کاربر',

            'comment.view' => 'نمایش نظرات',
            'comment.delete' => 'حذف نظر',

            'category.create' => 'ایجاد دسته‌بندی',
            'category.edit' => 'ویرایش دسته‌بندی',
            'category.delete' => 'حذف دسته‌بندی',

            'report.view' => 'نمایش گزارشات',
            'analytics.view' => 'نمایش آنالیزها',

            'settings.manage' => 'مدیریت تنظیمات',
            'role.manage' => 'مدیریت نقش‌ها',
            'permission.manage' => 'مدیریت دسترسی‌ها',
        ];

        foreach ($permissions as $permissionName => $permissionFaName) {
            Permission::firstOrCreate(
                ['name' => $permissionName],
                ['persian_name' => $permissionFaName]
            );
        }
    }
}
