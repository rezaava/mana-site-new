<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function visitors()
    {
        $visitors = [
            ['id' => 1, 'ip' => '192.168.1.1', 'country' => 'ایران', 'region' => 'تهران', 'date' => '۱۴۰۲/۱۲/۱۵'],
            ['id' => 2, 'ip' => '10.0.0.1', 'country' => 'آلمان', 'region' => 'برلین', 'date' => '۱۴۰۲/۱۲/۱۴'],
            ['id' => 3, 'ip' => '172.16.0.1', 'country' => 'آمریکا', 'region' => 'نیویورک', 'date' => '۱۴۰۲/۱۲/۱۳'],
        ];

        return view('admin.visitors', compact('visitors'));
    }

    public function sales()
    {
        $sales = [
            ['id' => 1, 'product' => 'دوره لاراول', 'amount' => '۲,۵۰۰,۰۰۰', 'date' => '۱۴۰۲/۱۲/۱۵'],
            ['id' => 2, 'product' => 'دوره ری‌اکت', 'amount' => '۱,۸۰۰,۰۰۰', 'date' => '۱۴۰۲/۱۲/۱۴'],
        ];

        return view('admin.sales', compact('sales'));
    }

    public function usersStats()
    {
        $totalUsers = 1250;
        $newUsers = 45;
        $activeUsers = 890;

        return view('admin.users-stats', compact('totalUsers', 'newUsers', 'activeUsers'));
    }

    public function posts()
    {
        $posts = [
            ['id' => 1, 'title' => 'آموزش لاراول', 'author' => 'رضا', 'date' => '۱۴۰۲/۱۲/۱۰'],
            ['id' => 2, 'title' => 'راهنمای PHP', 'author' => 'علی', 'date' => '۱۴۰۲/۱۲/۰۸'],
        ];

        return view('admin.posts', compact('posts'));
    }

    public function pages()
    {
        $pages = [
            ['id' => 1, 'title' => 'درباره ما', 'slug' => 'about', 'date' => '۱۴۰۲/۱۱/۰۱'],
            ['id' => 2, 'title' => 'تماس با ما', 'slug' => 'contact', 'date' => '۱۴۰۲/۱۰/۱۵'],
        ];

        return view('admin.pages', compact('pages'));
    }

    public function comments()
    {
        $comments = [
            ['id' => 1, 'user' => 'سارا', 'text' => 'عالی بود!', 'status' => 'approved', 'date' => '۱۴۰۲/۱۲/۱۵'],
            ['id' => 2, 'user' => 'محمد', 'text' => 'ممنون از آموزش', 'status' => 'pending', 'date' => '۱۴۰۲/۱۲/۱۴'],
        ];
        $pendingCount = 12;

        return view('admin.comments', compact('comments', 'pendingCount'));
    }

    public function users()
    {
        $users = [
            ['id' => 1, 'name' => 'رضا آواره', 'email' => 'reza@example.com', 'date' => '۱۴۰۲/۰۹/۰۱'],
            ['id' => 2, 'name' => 'علی حسینی', 'email' => 'ali@example.com', 'date' => '۱۴۰۲/۰۸/۱۵'],
        ];

        return view('admin.users', compact('users'));
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function support()
    {
        $tickets = [
            ['id' => 1, 'title' => 'مشکل در پرداخت', 'status' => 'open', 'date' => '۱۴۰۲/۱۲/۱۵'],
            ['id' => 2, 'title' => 'سوال درباره دوره', 'status' => 'open', 'date' => '۱۴۰۲/۱۲/۱۴'],
        ];
        $openTickets = 3;

        return view('admin.support', compact('tickets', 'openTickets'));
    }
}
