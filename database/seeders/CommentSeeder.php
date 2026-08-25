<?php

namespace Database\Seeders;

use App\Models\Comments;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $comments = [
            [
                'user_name' => 'مهدی کریمی',
                'content' => 'خیلی عالی بود! دقیقاً همین مسیر رو داریم طی می‌کنیم و نکات خیلی به‌دردبخوری داشت. ممنون از تیم مانا 🙏',
                'is_approved' => true,
            ],
            [
                'user_name' => 'سارا نوری',
                'content' => 'درباره‌ی بخش انتخاب استک فنی خیلی دقیق توضیح دادید. کاش یکم بیشتر در مورد معماری میکروسرویس هم صحبت می‌کردید.',
                'is_approved' => true,
            ],
            [
                'user_name' => 'رضا فتحی',
                'content' => 'دقیقاً همون چیزی بود که دنبالش می‌گشتم. مخصوصاً بخش اعتبارسنجی ایده که خیلی از استارتاپ‌ها نادیده می‌گیرن.',
                'is_approved' => true,
            ],
            [
                'user_name' => 'نیما کریمی',
                'content' => 'چه طراحی خیره‌کننده‌ای! خیلی خلاق و استعداد دارید 😍',
                'is_approved' => false,
            ],
            [
                'user_name' => 'زهرا محمدی',
                'content' => 'طراحیتون رو خیلی دوست دارم! خیلی زیبا و منحصربه‌فرد است 🌟',
                'is_approved' => false,
            ],
        ];

        foreach ($comments as $comment) {
            Comments::create($comment);
        }
    }
}