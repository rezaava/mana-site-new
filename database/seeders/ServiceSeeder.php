<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'هوش مصنوعی و اتوماسیون',
                'text' => 'استفاده از مدل‌های هوشمند برای ساده‌سازی فرآیندها و تصمیم‌گیری داده‌محور در کسب‌وکار شما.',
                'number' => 1,
                'icon' => 'brain',
            ],
            [
                'title' => 'اپلیکیشن موبایل',
                'text' => 'طراحی و توسعه اپلیکیشن‌های iOS و Android با تجربه‌ کاربری روان و عملکردی بی‌نقص.',
                'number' => 2,
                'icon' => 'mobile-screen-button',
            ],
            [
                'title' => 'طراحی وب‌سایت',
                'text' => 'وب‌سایت‌هایی مدرن، سریع و بهینه‌شده برای موتورهای جست‌وجو با تمرکز بر نرخ تبدیل.',
                'number' => 3,
                'icon' => 'window-restore',
            ],
            [
                'title' => 'زیرساخت ابری',
                'text' => 'معماری، مهاجرت و مدیریت زیرساخت ابری امن، مقیاس‌پذیر و بهینه از نظر هزینه.',
                'number' => 4,
                'icon' => 'cloud-arrow-up',
            ],
            [
                'title' => 'نرم‌افزار اختصاصی',
                'text' => 'طراحی و توسعه نرم‌افزار سفارشی متناسب با فرآیندهای دقیق کسب‌وکار شما.',
                'number' => 5,
                'icon' => 'code-branch',
            ],
            [
                'title' => 'امنیت سایبری',
                'text' => 'ارزیابی، تست نفوذ و پیاده‌سازی راهکارهای امنیتی برای محافظت از دارایی‌های دیجیتال شما.',
                'number' => 6,
                'icon' => 'shield-halved',
            ],
        ];

        foreach ($services as $service) {
            Services::create($service);
        }
    }
}