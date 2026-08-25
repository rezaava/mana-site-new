<?php

namespace Database\Seeders;

use App\Models\Questions;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'title' => 'مدت زمان انجام پروژه چقدر است؟', // تغییر از question به title
                'answer' => 'بسته به پیچیدگی پروژه، معمولاً بین ۴ تا ۱۲ هفته زمان می‌برد. در جلسه‌ی مشاوره‌ی اولیه، برآورد دقیق زمانی ارائه می‌شود.',
                'number' => 1,
            ],
            [
                'title' => 'هزینه پروژه چگونه محاسبه می‌شود؟',
                'answer' => 'هزینه بر اساس محدوده کار، پیچیدگی فنی و بازه زمانی پروژه تعیین می‌شود و پیش از شروع، در قالب پیشنهاد شفاف ارائه خواهد شد.',
                'number' => 2,
            ],
            [
                'title' => 'آیا از اطلاعات پروژه محافظت می‌کنید؟',
                'answer' => 'بله، تمام اطلاعات پروژه تحت قرارداد محرمانگی (NDA) محافظت شده و صرفاً در اختیار تیم پروژه قرار می‌گیرد.',
                'number' => 3,
            ],
            [
                'title' => 'آیا بعد از اتمام پروژه پشتیبانی ارائه می‌دهید؟',
                'answer' => 'بله، بسته‌های پشتیبانی و نگهداری پس از تحویل پروژه برای اطمینان از عملکرد پایدار آن ارائه می‌شود.',
                'number' => 4,
            ],
        ];

        foreach ($questions as $question) {
            Questions::create($question);
        }
    }
}