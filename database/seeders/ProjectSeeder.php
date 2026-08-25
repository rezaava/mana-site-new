<?php

namespace Database\Seeders;

use App\Models\Projects;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'سامانه نوبت‌دهی پزشکی',
                'brief' => 'سلامت دیجیتال',
                'desc' => 'سامانه‌ای برای نوبت‌دهی، پرونده الکترونیک و مشاوره آنلاین با پزشکان.',
                'number' => 1,
                'image_url' => 'projects/project1.jpg',
            ],
            [
                'title' => 'پلتفرم تجارت الکترونیک',
                'brief' => 'فروشگاه آنلاین',
                'desc' => 'فروشگاهی سریع و مقیاس‌پذیر با تجربه‌ی خرید یکپارچه در وب و موبایل.',
                'number' => 2,                'image_url' => 'projects/project2.jpg',
            ],
            [
                'title' => 'داشبورد هوشمند فروش',
                'brief' => 'پنل مدیریت',
                'desc' => 'داشبوردی تحلیلی برای رصد لحظه‌ای فروش، موجودی و رفتار مشتریان با گزارش‌های هوشمند.',
                'number' => 3,
                'image_url' => 'projects/project3.jpg',
            ],
            [
                'title' => 'اپ موبایل بانکداری نوین',
                'brief' => 'اپلیکیشن بانکی',
                'desc' => 'اپلیکیشن بانکی امن با احراز هویت بیومتریک و تجربه‌ی کاربری ساده.',
                'number' => 4,
                'image_url' => 'projects/project4.jpg',
            ],
            [
                'title' => 'پلتفرم یادگیری هوشمند',
                'brief' => 'آموزش آنلاین',
                'desc' => 'سامانه‌ی آموزش آنلاین با مسیرهای یادگیری شخصی‌سازی‌شده توسط هوش مصنوعی.',
                'number' => 5,
                'image_url' => 'projects/project5.jpg',
            ],
        ];

        foreach ($projects as $project) {
            Projects::create($project);
        }
    }
}