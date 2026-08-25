<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ServiceSeeder::class,
            ProjectSeeder::class,
            TeamSeeder::class,
            QuestionSeeder::class,
            BlogSeeder::class,
            CommentSeeder::class,
            VisitorSeeder::class,
            SaleSeeder::class,
            TicketSeeder::class,
            SettingSeeder::class,
            SocialSeeder::class,
        ]);
    }
}