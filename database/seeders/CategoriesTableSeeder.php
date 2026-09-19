<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'سایت و افزونه ورد',
                'type' => '1'
            ],
            [
                'name' => 'اپلیکیشن موبایل',
                'type' => '1'
            ],
            [
                'name' => 'وب‌سایت شرکتی',
                'type' => '1'
            ],
            [
                'name' => 'فروشگاه آنلاین',
                'type' => '1'
            ],
            [
                'name' => 'سیستم مدیریت محتوا',
                'type' => '1'
            ],
            [
                'name' => 'پنل مدیریتی',
                'type' => '1'
            ],
            [
                'name' => 'سامانه آموزشی',
                'type' => '1'
            ],
            [
                'name' => 'درگاه پرداخت',
                'type' => '1'
            ],




            [
                'name' => 'سایت و افزونه ورد',
                'type' => '2'
            ],
            [
                'name' => 'اپلیکیشن موبایل',
                'type' => '2'
            ],
            [
                'name' => 'وب‌سایت شرکتی',
                'type' => '2'
            ],
            [
                'name' => 'فروشگاه آنلاین',
                'type' => '2'
            ],
            [
                'name' => 'سیستم مدیریت محتوا',
                'type' => '1'
            ],
            [
                'name' => 'پنل مدیریتی',
                'type' => '2'
            ],
            [
                'name' => 'سامانه آموزشی',
                'type' => '2'
            ],
            [
                'name' => 'درگاه پرداخت',
                'type' => '2'
            ],
        ];

        foreach ($categories as $categorie) {
            Categories::create($categorie);
        }
    }
}