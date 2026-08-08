@extends('admin.panel')

@section('content')
    <!-- ===== STATS ===== -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fa-solid fa-eye"></i>
            </div>
            <h3 id="statViews">---</h3>
            <span>بازدید پروفایل</span>
            <span class="change up">
                <i class="fa-solid fa-arrow-up"></i> <span id="viewsChange">---</span>
            </span>
            <div class="stat-bg">
                <i class="fa-regular fa-eye"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h3 id="statFollowers">---</h3>
            <span>دنبال‌کنندگان</span>
            <span class="change up">
                <i class="fa-solid fa-arrow-up"></i> <span id="followersChange">---</span>
            </span>
            <div class="stat-bg">
                <i class="fa-regular fa-user"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon yellow">
                <i class="fa-solid fa-bookmark"></i>
            </div>
            <h3 id="statSaved">---</h3>
            <span>ذخیره‌شده‌ها</span>
            <span class="change down">
                <i class="fa-solid fa-arrow-down"></i> <span id="savedChange">---</span>
            </span>
            <div class="stat-bg">
                <i class="fa-regular fa-bookmark"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fa-solid fa-comment"></i>
            </div>
            <h3 id="statComments">---</h3>
            <span>نظرات جدید</span>
            <span class="change up">
                <i class="fa-solid fa-arrow-up"></i> <span id="commentsChange">---</span>
            </span>
            <div class="stat-bg">
                <i class="fa-regular fa-comment"></i>
            </div>
        </div>
    </div>

    <!-- نمودارها (بقیه مثل قبل) -->
    <div class="charts-row">
        <div class="chart-card">
            <div class="card-header">
                <h6>
                    <i class="fa-regular fa-calendar" style="color: var(--accent-2)"></i> آمار بازدید ماهانه
                </h6>
                <div class="filter-btns">
                    <button class="active" data-period="month">ماه</button>
                    <button data-period="week">هفته</button>
                    <button data-period="year">سال</button>
                </div>
            </div>
            <canvas id="visitsChart"></canvas>
        </div>
        <div class="chart-card">
            <div class="card-header">
                <h6>
                    <i class="fa-solid fa-circle-pie" style="color: var(--accent)"></i> ترکیب بازدیدکنندگان
                </h6>
            </div>
            <canvas id="genderChart"></canvas>
        </div>
    </div>

    <!-- بقیه بخش‌ها -->
@endsection

@section('scripts')
<script>
    // لود داینامیک با API
    document.addEventListener('DOMContentLoaded', function() {
        loadStats();
        loadCharts();
    });

    function loadStats() {
        fetch('/api/admin/dashboard/stats')
            .then(res => res.json())
            .then(result => {
                if(result.success) {
                    const d = result.data;
                    document.getElementById('statViews').textContent = d.profile_views;
                    document.getElementById('statFollowers').textContent = d.followers;
                    document.getElementById('statSaved').textContent = d.saved;
                    document.getElementById('statComments').textContent = d.comments;
                    document.getElementById('viewsChange').textContent = d.views_change;
                    document.getElementById('followersChange').textContent = d.followers_change;
                    document.getElementById('savedChange').textContent = d.saved_change;
                    document.getElementById('commentsChange').textContent = d.comments_change;
                }
            });
    }

    function loadCharts() {
        // کد نمودارها (همون که قبلاً نوشتم)
    }
</script>
@endsection
