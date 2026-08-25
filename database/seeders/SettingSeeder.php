<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'مانا'],
            ['key' => 'site_description', 'value' => 'راهکارهای هوشمند دیجیتال برای رشد کسب‌وکار شما'],
            ['key' => 'site_keywords', 'value' => 'هوش مصنوعی, طراحی وب, اپلیکیشن موبایل, امنیت سایبری'],
            ['key' => 'contact_email', 'value' => 'info@mana.ir'],
            ['key' => 'contact_phone', 'value' => '۰۲۱-۱۷۵۴۵۶۷۸'],
            ['key' => 'address', 'value' => 'تهران، خیابان ولیعصر، پلاک ۱۲۳'],
            ['key' => 'telegram', 'value' => 'https://t.me/mana_team'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/mana_team'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/mana_team'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}