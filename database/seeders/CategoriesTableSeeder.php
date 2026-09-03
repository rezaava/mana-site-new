<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'سایت و افزونه ورد',
            'اپلیکیشن موبایل',
            'وب‌سایت شرکتی',
            'فروشگاه آنلاین',
            'سیستم مدیریت محتوا',
            'پنل مدیریتی',
            'سامانه آموزشی',
            'درگاه پرداخت',
        ];

        foreach ($categories as $name) {
            Categories::create(['name' => $name]);
        }
    }
}