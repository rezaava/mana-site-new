<?php

namespace Database\Seeders;

use App\Models\Services;
use App\Models\ServiceTech;
use Illuminate\Database\Seeder;

class ServiceTechSeeder extends Seeder
{
    public function run(): void
    {
        $service = Services::where('title', 'هوش مصنوعی و اتوماسیون')->first();

        if (!$service) {
            return;
        }

        $techs = [
            [
                'text' => 'Python',
                'icon' => 'fa-microchip',
                'number' => 1,
            ],
            [
                'text' => 'مدل‌های زبانی بزرگ (LLM)',
                'icon' => 'fa-brain',
                'number' => 2,
            ],
            [
                'text' => 'Vector Database',
                'icon' => 'fa-database',
                'number' => 3,
            ],
            [
                'text' => 'زیرساخت ابری مقیاس‌پذیر',
                'icon' => 'fa-cloud',
                'number' => 4,
            ],
            [
                'text' => 'n8n / اتوماسیون فرآیند',
                'icon' => 'fa-code-branch',
                'number' => 5,
            ],
            [
                'text' => 'ابزارهای تحلیل داده',
                'icon' => 'fa-chart-line',
                'number' => 6,
            ],
        ];

        foreach ($techs as $tech) {
            ServiceTech::create([
                'service_id' => $service->id,
                'text' => $tech['text'],
                'icon' => $tech['icon'],
                'number' => $tech['number'],
            ]);
        }
    }
}