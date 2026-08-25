<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // ابتدا نقش‌های قدیمی را پاک کنید (اختیاری)
        // Role::truncate();

        $roles = [
            ['name' => 'admin', 'display_name' => 'مدیر سیستم', 'description' => 'دسترسی کامل به تمام بخش‌ها'],
            ['name' => 'teacher', 'display_name' => 'استاد', 'description' => 'مدیریت دوره‌ها و محتوا'],
            ['name' => 'student', 'display_name' => 'دانشجو', 'description' => 'دسترسی به دوره‌ها و محتوا'],
            ['name' => 'vendor', 'display_name' => 'فروشنده', 'description' => 'مدیریت فروش و محصولات'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}