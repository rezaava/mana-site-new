<!doctype html>
<html lang="fa" dir="rtl" data-theme="dark">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/mana.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت | مانا</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.css">
    <link rel="stylesheet" href="{{ asset('css/paneladmin.css') }}">
</head>
<body>
<!-- ===== CURSOR ===== -->
<div class="cur-dot" id="curDot"></div>
<div class="cur-ring" id="curRing"></div>
<!-- ===== SIDEBAR OVERLAY (موبایل) ===== -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<!-- ===== ADMIN WRAPPER ===== -->
<div class="admin-wrapper">
    <!-- ===== SIDEBAR ===== -->
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <span class="mark">
                <img src="{{ asset('img/mana.png') }}" alt="مانا">
            </span>
            <span>پنل مدیریت</span>
        </div>
        <div class="menu-label">منوی اصلی</div>

        <!-- داشبورد -->
        <a href="{{ url('/admin/2') }}" class="nav-item active">
            <i class="fa-solid fa-gauge-high"></i>
            داشبورد
        </a>

        <!-- آمار و گزارشات (زیرمنو) -->
        <button class="nav-item has-sub open" id="statsToggle">
            <i class="fa-solid fa-chart-line"></i>
            آمار و گزارشات
            <span class="arrow">
                <i class="fa-solid fa-chevron-left"></i>
            </span>
        </button>
        <div class="sub-menu open" id="statsSub">
            <a href="{{ url('/admin/visitors') }}" class="nav-item">بازدیدکنندگان</a>
            <a href="{{ url('/admin/sales') }}" class="nav-item">فروش</a>
            <a href="{{ url('/admin/users-stats') }}" class="nav-item">کاربران</a>
        </div>

        <!-- مدیریت محتوا (زیرمنو) -->
        <button class="nav-item has-sub open" id="contentToggle">
            <i class="fa-solid fa-folder-tree"></i>
            مدیریت محتوا
            <span class="arrow">
                <i class="fa-solid fa-chevron-left"></i>
            </span>
        </button>
        <div class="sub-menu open" id="contentSub">
            <a href="{{ url('/admin/blogs') }}" class="nav-item">مقالات</a>
            <a href="{{ url('/admin/pages') }}" class="nav-item">صفحات</a>
            <a href="{{ url('/admin/comments') }}" class="nav-item">نظرات
                <span class="badge-num">{{ persianNum(\App\Models\Comments::where('is_approved', true)->count()) }}</span>
            </a>
        </div>


                <!-- مدیریت پروژه‌ها -->
        <a href="{{ url('/admin/projects') }}" class="nav-item">
            <i class="fa-solid fa-diagram-project"></i>
            پروژه‌ها
        </a>


        <!-- کاربران -->
        <a href="{{ url('/admin/users') }}" class="nav-item">
            <i class="fa-solid fa-users"></i>
            کاربران
            <span class="badge-dot"></span>
        </a>

        <a href="{{ url('/admin/team') }}" class="nav-item">
            <i class="fa-solid fa-users"></i>
            تیم
            <span class="badge-dot"></span>
        </a>

        <a href="{{ url('/admin/socials') }}" class="nav-item">
            <i class="fa-solid fa-users"></i>
            شبکه‌های اجتماعی
            <span class="badge-dot"></span>
        </a>

        <!-- تنظیمات -->
        <a href="{{ url('/admin/settings') }}" class="nav-item">
            <i class="fa-solid fa-gear"></i>
            تنظیمات
        </a>

        <!-- پشتیبانی -->
        <a href="{{ url('/admin/support') }}" class="nav-item">
            <i class="fa-solid fa-headset"></i>
            پشتیبانی
            <span class="badge-num">{{ persianNum(\App\Models\Ticket::where('status', 'open')->count()) }}</span>
        </a>

        <!-- کارت کاربر -->
        <div class="user-card">
            <div class="avatar">
                <img src="{{ asset('img/contect3.jpg') }}" alt="admin">
            </div>
            <div class="info">
                <h6>رضا آواره</h6>
                <span>مدیر سیستم</span>
            </div>
        </div>
    </aside>
    <!-- ===== MAIN CONTENT ===== -->
    <main class="main-content" id="mainContent">
        <!-- ===== TOPBAR ===== -->
        <div class="topbar">
            <div class="left">
                <button class="toggle-btn" id="sidebarToggle">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <h4 id="pageTitle">داشبورد</h4>
            </div>
            <div class="right">
                <div class="theme-switch" id="themeSwitch">
                    <div class="knob">
                        <i class="fa-solid fa-moon" id="themeIcon"></i>
                    </div>
                </div>
                <button class="notif-btn" id="notifBtn">
                    <i class="fa-regular fa-bell"></i>
                    <span class="dot"></span>
                </button>
            </div>
        </div>
        <!-- ===== CONTENT AREA ===== -->
        <div id="pageContent">
            @yield('content')
        </div>
    </main>
</div>
<!-- ===== SCRIPTS ===== -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="{{ asset('js/paneladmin.js') }}"></script>
@yield('scripts')
</body>
</html>
