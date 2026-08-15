<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'profile_views' => '۱۱۲,۰۰۰',
                'followers' => '۱۸۳,۰۰۰',
                'saved' => '۱۱۲',
                'comments' => 45,
            ]
        ]);
    }

    public function visitsChart(Request $request)
    {
        $period = $request->get('period', 'month');

        $data = [
            'month' => [
                'labels' => ['فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند'],
                'visits' => [4200, 5100, 4800, 6200, 5800, 7100, 6900, 8200, 7800, 9100, 10500, 11200],
                'visitors' => [3800, 4600, 4300, 5600, 5200, 6400, 6200, 7400, 7000, 8200, 9500, 10200],
            ],
            'week' => [
                'labels' => ['شنبه', 'یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه'],
                'visits' => [1200, 1400, 1100, 1600, 1500, 1900, 2100],
                'visitors' => [1000, 1200, 950, 1400, 1300, 1700, 1900],
            ],
            'year' => [
                'labels' => ['۱۳۹۹', '۱۴۰۰', '۱۴۰۱', '۱۴۰۲', '۱۴۰۳', '۱۴۰۴', '۱۴۰۵'],
                'visits' => [35000, 42000, 38000, 45000, 48000, 52000, 58000],
                'visitors' => [31000, 38000, 34000, 41000, 44000, 48000, 54000],
            ],
        ];

        return response()->json([
            'success' => true,
            'data' => $data[$period] ?? $data['month']
        ]);
    }

    public function genderChart()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'labels' => ['مرد', 'زن'],
                'values' => [70, 30]
            ]
        ]);
    }

    public function visitorsByRegion()
    {
        return response()->json([
            'success' => true,
            'data' => [
                ['region' => 'اروپا', 'count' => 862],
                ['region' => 'آمریکا', 'count' => 375],
                ['region' => 'هند', 'count' => 625],
                ['region' => 'اندونزی', 'count' => 1025],
                ['region' => 'ایران', 'count' => 842],
            ]
        ]);
    }

    public function recentComments()
    {
        $comments = Comments::where('is_approved', true)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($comment) {
                return [
                    'user' => $comment->user_name,
                    'content' => $comment->content,
                    'time' => $comment->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $comments
        ]);
    }
}
