<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // پیدا کردن نقش‌ها
        $adminRole = Role::where('name', 'admin')->first();
        $teacherRole = Role::where('name', 'teacher')->first();
        $studentRole = Role::where('name', 'student')->first();

        // ادمین
        $admin = User::create([
            'name' => 'رضا آواره',
            'email' => 'admin@mana.ir',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);
        // اضافه کردن نقش به صورت مستقیم در جدول role_user
        DB::table('role_user')->insert([
            'role_id' => $adminRole->id,
            'user_id' => $admin->id,
            'user_type' => get_class($admin),
        ]);

        // استاد
        $teacher = User::create([
            'name' => 'علی معلمی',
            'email' => 'teacher@mana.ir',
            'password' => Hash::make('12345678'),
            'role' => 'teacher',
        ]);
        DB::table('role_user')->insert([
            'role_id' => $teacherRole->id,
            'user_id' => $teacher->id,
            'user_type' => get_class($teacher),
        ]);

        // دانشجو
        $student = User::create([
            'name' => 'سارا دانشجو',
            'email' => 'student@mana.ir',
            'password' => Hash::make('12345678'),
            'role' => 'student',
        ]);
        DB::table('role_user')->insert([
            'role_id' => $studentRole->id,
            'user_id' => $student->id,
            'user_type' => get_class($student),
        ]);

        // کاربران عادی
        $users = [
            ['name' => 'محمد رضایی', 'email' => 'mohammad@example.com'],
            ['name' => 'فاطمه کریمی', 'email' => 'fatemeh@example.com'],
            ['name' => 'علی حسینی', 'email' => 'ali@example.com'],
            ['name' => 'زهرا محمدی', 'email' => 'zahra@example.com'],
            ['name' => 'نیما کریمی', 'email' => 'nima@example.com'],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('12345678'),
                'role' => 'student',
            ]);
            DB::table('role_user')->insert([
                'role_id' => $studentRole->id,
                'user_id' => $user->id,
                'user_type' => get_class($user),
            ]);
        }
    }
}