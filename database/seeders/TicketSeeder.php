<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $tickets = [
            [
                'user_name' => 'رضا محمدی',
                'email' => 'reza@example.com',
                'subject' => 'مشکل در ورود به سیستم',
                'message' => 'سلام، من نمی‌توانم وارد پنل کاربری شوم. لطفاً راهنمایی کنید.',
                'status' => 'open',
            ],
            [
                'user_name' => 'سارا عزیزی',
                'email' => 'sara@example.com',
                'subject' => 'مشکل در پرداخت',
                'message' => 'هنگام پرداخت با خطا مواجه می‌شوم. لطفاً بررسی کنید.',
                'status' => 'open',
            ],
            [
                'user_name' => 'علی حسینی',
                'email' => 'ali@example.com',
                'subject' => 'درخواست تغییر پلن',
                'message' => 'می‌خواهم پلن خود را ارتقا دهم. لطفاً راهنمایی کنید.',
                'status' => 'closed',
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}