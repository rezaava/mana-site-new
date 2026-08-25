<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['name' => 'فاطمه', 'title' => 'مدیر محصول', 'number' => 1],
            ['name' => 'عرشیا', 'title' => 'Web Developer', 'number' => 2],
            ['name' => 'رضا آواره', 'title' => 'مدیر عامل', 'number' => 3],
            ['name' => 'مزمز', 'title' => 'توسعه‌دهنده C#', 'number' => 4],
            ['name' => 'خواجه‌ها', 'title' => 'Web Developer', 'number' => 5],
        ];

        foreach ($members as $member) {
            Team::create($member);
        }
    }
}