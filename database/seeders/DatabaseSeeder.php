<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // 1. รัน Seeder ของ Role และ Permission ก่อน เพื่อสร้างบทบาทในระบบ
        $this->call(RoleAndPermissionSeeder::class);

        // 2. สร้าง User ตัวอย่าง
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 3. กำหนด Role 'admin' ให้กับ User ที่สร้างขึ้น
        $user->assignRole('admin');
    }
}
