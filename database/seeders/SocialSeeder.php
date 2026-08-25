<?php

namespace Database\Seeders;

use App\Models\Socials;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    public function run(): void
    {
        $socials = [
            ['name' => 'تلگرام', 'url' => 'https://t.me/mana_team'],
            ['name' => 'اینستاگرام', 'url' => 'https://instagram.com/mana_team'],
            ['name' => 'توییتر', 'url' => 'https://twitter.com/mana_team'],
            ['name' => 'لینکدین', 'url' => 'https://linkedin.com/company/mana_team'],
            ['name' => 'واتساپ', 'url' => 'https://wa.me/989123456789'],
        ];

        foreach ($socials as $social) {
            Socials::create($social);
        }
    }
}