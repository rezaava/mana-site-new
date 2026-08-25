<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $sales = [
            ['title' => 'دوره لاراول پیشرفته', 'text' => 'آموزش جامع لاراول از مقدماتی تا پیشرفته', 'price' => 2500000, 'number' => 1],
            ['title' => 'دوره ری‌اکت Native', 'text' => 'آموزش ساخت اپلیکیشن موبایل با ری‌اکت', 'price' => 1800000, 'number' => 2],
            ['title' => 'دوره هوش مصنوعی', 'text' => 'آموزش مفاهیم پایه و پیشرفته هوش مصنوعی', 'price' => 3200000, 'number' => 3],
            ['title' => 'دوره امنیت سایبری', 'text' => 'آموزش امنیت وب و تست نفوذ', 'price' => 2800000, 'number' => 4],
        ];

        foreach ($sales as $sale) {
            Sale::create($sale);
        }
    }
}