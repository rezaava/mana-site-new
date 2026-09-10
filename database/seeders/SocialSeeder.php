<?php

namespace Database\Seeders;

use App\Models\Socials;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    public function run(): void
    {
        $socials = [
            [
                'name' => 'تلگرام',
                'icon_class' => 'fa-telegram',
                'url' => 'https://t.me/mana_team',
            ],
            [
                'name' => 'اینستاگرام',
                'icon_class' => 'fa-instagram',
                'url' => 'https://instagram.com/mana_team',
            ],
            [
                'name' => 'توییتر',
                'icon_class' => 'fa-x-twitter',
                'url' => 'https://twitter.com/mana_team',
            ],
            [
                'name' => 'لینکدین',
                'icon_class' => 'fa-linkedin-in',
                'url' => 'https://linkedin.com/company/mana_team',
            ],
            [
                'name' => 'واتساپ',
                'icon_class' => 'fa-whatsapp',
                'url' => 'https://wa.me/989123456789',
            ],
        ];

        foreach ($socials as $social) {
            Socials::create($social);
        }
    }
}