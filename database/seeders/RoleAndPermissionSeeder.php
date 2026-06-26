<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // รีเซ็ตแคชของ Role/Permission ก่อน
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // 1. สร้าง Permissions
        $editArticles = Permission::create(['name' => 'edit articles', 'guard_name' => 'web']);
        $deleteArticles = Permission::create(['name' => 'delete articles', 'guard_name' => 'web']);
        $publishArticles = Permission::create(['name' => 'publish articles', 'guard_name' => 'web']);

        // 2. สร้าง Roles และใส่สิทธิ์ (Permissions)
        $writerRole = Role::create(['name' => 'writer', 'guard_name' => 'web']);
        $writerRole->givePermissionTo($editArticles);

        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo([$editArticles, $deleteArticles, $publishArticles]);
    }
}
