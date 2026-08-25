@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <h5 style="margin-bottom: 20px;">
        <i class="fa-solid fa-chart-line"></i> آمار کاربران
    </h5>

    <!-- کارت‌های آمار -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 30px;">
        <div class="stat-card" style="background: var(--card-bg); border-radius: 12px; padding: 20px; position: relative; overflow: hidden;">
            <div class="stat-icon blue" style="width: 45px; height: 45px; background: rgba(99,102,241,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                <i class="fa-solid fa-users" style="color: #6366f1; font-size: 20px;"></i>
            </div>
            <h3 style="font-size: 28px; margin: 5px 0;">{{ number_format($totalUsers) }}</h3>
            <span style="color: var(--text-light); font-size: 14px;">کل کاربران</span>
        </div>

        <div class="stat-card" style="background: var(--card-bg); border-radius: 12px; padding: 20px; position: relative; overflow: hidden;">
            <div class="stat-icon green" style="width: 45px; height: 45px; background: rgba(16,185,129,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                <i class="fa-solid fa-user-plus" style="color: #10b981; font-size: 20px;"></i>
            </div>
            <h3 style="font-size: 28px; margin: 5px 0;">{{ number_format($newUsersToday) }}</h3>
            <span style="color: var(--text-light); font-size: 14px;">کاربران جدید امروز</span>
        </div>

        <div class="stat-card" style="background: var(--card-bg); border-radius: 12px; padding: 20px; position: relative; overflow: hidden;">
            <div class="stat-icon yellow" style="width: 45px; height: 45px; background: rgba(245,158,11,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                <i class="fa-solid fa-calendar-week" style="color: #f59e0b; font-size: 20px;"></i>
            </div>
            <h3 style="font-size: 28px; margin: 5px 0;">{{ number_format($newUsersThisWeek) }}</h3>
            <span style="color: var(--text-light); font-size: 14px;">کاربران جدید این هفته</span>
        </div>

        <div class="stat-card" style="background: var(--card-bg); border-radius: 12px; padding: 20px; position: relative; overflow: hidden;">
            <div class="stat-icon purple" style="width: 45px; height: 45px; background: rgba(139,92,246,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                <i class="fa-solid fa-calendar-check" style="color: #8b5cf6; font-size: 20px;"></i>
            </div>
            <h3 style="font-size: 28px; margin: 5px 0;">{{ number_format($newUsersThisMonth) }}</h3>
            <span style="color: var(--text-light); font-size: 14px;">کاربران جدید این ماه</span>
        </div>
    </div>

    <!-- کارت‌های نقش‌ها -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
        <div style="background: var(--card-bg); border-radius: 12px; padding: 25px; text-align: center;">
            <div style="width: 60px; height: 60px; background: rgba(99,102,241,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                <i class="fa-solid fa-crown" style="color: #6366f1; font-size: 24px;"></i>
            </div>
            <h4 style="font-size: 24px; margin: 5px 0;">{{ number_format($admins) }}</h4>
            <span style="color: var(--text-light);">ادمین‌ها</span>
        </div>

        <div style="background: var(--card-bg); border-radius: 12px; padding: 25px; text-align: center;">
            <div style="width: 60px; height: 60px; background: rgba(16,185,129,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                <i class="fa-solid fa-chalkboard-teacher" style="color: #10b981; font-size: 24px;"></i>
            </div>
            <h4 style="font-size: 24px; margin: 5px 0;">{{ number_format($teachers) }}</h4>
            <span style="color: var(--text-light);">اساتید</span>
        </div>

        <div style="background: var(--card-bg); border-radius: 12px; padding: 25px; text-align: center;">
            <div style="width: 60px; height: 60px; background: rgba(245,158,11,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                <i class="fa-solid fa-user-graduate" style="color: #f59e0b; font-size: 24px;"></i>
            </div>
            <h4 style="font-size: 24px; margin: 5px 0;">{{ number_format($students) }}</h4>
            <span style="color: var(--text-light);">دانشجویان</span>
        </div>
    </div>
</div>
@endsection
