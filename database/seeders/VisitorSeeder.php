<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VisitorSeeder extends Seeder
{
    public function run(): void
    {
        $visitors = [
            ['ip_address' => '192.168.1.1', 'country' => 'ایران', 'region' => 'تهران', 'visited_at' => Carbon::now()->subDays(1)],
            ['ip_address' => '10.0.0.1', 'country' => 'آلمان', 'region' => 'برلین', 'visited_at' => Carbon::now()->subDays(2)],
            ['ip_address' => '172.16.0.1', 'country' => 'آمریکا', 'region' => 'نیویورک', 'visited_at' => Carbon::now()->subDays(3)],
            ['ip_address' => '192.168.1.2', 'country' => 'ایران', 'region' => 'اصفهان', 'visited_at' => Carbon::now()->subDays(4)],
            ['ip_address' => '10.0.0.2', 'country' => 'انگلستان', 'region' => 'لندن', 'visited_at' => Carbon::now()->subDays(5)],
        ];

        foreach ($visitors as $visitor) {
            Visitor::create($visitor);
        }
    }
}