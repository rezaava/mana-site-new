<?php

namespace Database\Seeders;

use App\Models\Services;
use App\Models\ServiceState;
use Illuminate\Database\Seeder;

class ServiceStateSeeder extends Seeder
{
    public function run(): void
    {
        $services = Services::orderBy('number')->get();

        foreach ($services as $service) {
            ServiceState::create([
                'service_id' => $service->id,

                'text_1' => 'کاهش زمان فرآیندهای تکراری',
                'value_1' => '40',

                'text_2' => 'پروژه اجراشده',
                'value_2' => '60',

                'text_3' => 'عملکرد بدون وقفه',
                'value_3' => '24',

                'text_4' => 'هفته، حداقل زمان شروع',
                'value_4' => '3',
            ]);
        }
    }
}