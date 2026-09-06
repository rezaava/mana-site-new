<?php

namespace Database\Seeders;

use App\Models\Services;
use App\Models\ServiceWhatReceive;
use Illuminate\Database\Seeder;

class ServiceWhatReceiveSeeder extends Seeder
{
    public function run(): void
    {
        $service = Services::where('title', 'هوش مصنوعی و اتوماسیون')->first();

        if (!$service) {
            return;
        }

        $items = [
            [
                'title' => 'چت‌بات و دستیار هوشمند',
                'text' => 'طراحی چت‌بات اختصاصی برای پاسخ‌گویی به مشتریان یا پشتیبانی داخلی تیم، هماهنگ با لحن برند شما.',
                'icon' => 'fa-comments',
                'number' => 1,
            ],
            [
                'title' => 'اتوماسیون فرآیندهای اداری',
                'text' => 'خودکارسازی کارهای تکراری مثل ورود داده، تولید گزارش و هماهنگی بین سامانه‌های مختلف (RPA).',
                'icon' => 'fa-gears',
                'number' => 2,
            ],
            [
                'title' => 'مدل‌های یادگیری ماشین',
                'text' => 'طراحی و آموزش مدل‌های اختصاصی برای پیش‌بینی، دسته‌بندی یا تحلیل داده‌های خاص کسب‌وکار شما.',
                'icon' => 'fa-diagram-project',
                'number' => 3,
            ],
            [
                'title' => 'داشبورد تحلیل هوشمند',
                'text' => 'نمایش زنده و قابل‌فهم داده‌ها برای تصمیم‌گیری سریع‌تر مدیران و تیم‌های عملیاتی.',
                'icon' => 'fa-chart-pie',
                'number' => 4,
            ],
            [
                'title' => 'یکپارچه‌سازی با سامانه‌های فعلی',
                'text' => 'اتصال راهکار هوش مصنوعی به نرم‌افزارها و پایگاه‌داده‌های موجود شما، بدون توقف کسب‌وکار.',
                'icon' => 'fa-plug',
                'number' => 5,
            ],
            [
                'title' => 'مشاوره نقشه‌راه هوش مصنوعی',
                'text' => 'بررسی فرآیندهای شما و اولویت‌بندی حوزه‌هایی که بیشترین بازگشت سرمایه را از هوش مصنوعی دارند.',
                'icon' => 'fa-map',
                'number' => 6,
            ],
        ];

        foreach ($items as $item) {
            ServiceWhatReceive::create([
                'service_id' => $service->id,
                'title' => $item['title'],
                'text' => $item['text'],
                'icon' => $item['icon'],
                'number' => $item['number'],
            ]);
        }
    }
}