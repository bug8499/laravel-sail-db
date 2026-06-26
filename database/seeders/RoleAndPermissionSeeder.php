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
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        // 2. สร้าง Roles และใส่สิทธิ์ (Permissions)
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit articles');
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all()); // แอดมินได้ทุกสิทธิ์
    }
}
