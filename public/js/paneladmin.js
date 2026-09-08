document.addEventListener('DOMContentLoaded', function () {
    const toggleButtons = document.querySelectorAll('.sidebar .nav-item.has-sub');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            // پیدا کردن زیرمنوی هم‌سطح بعدی
            const subMenu = this.nextElementSibling;
            if (subMenu && subMenu.classList.contains('sub-menu')) {
                // تاگل کلاس open روی دکمه و زیرمنو
                this.classList.toggle('open');
                subMenu.classList.toggle('open');
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    // ===== SIDEBAR TOGGLE (موبایل و دسکتاپ) =====
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggle');
    const mainContent = document.getElementById('mainContent');

    // اگر المان‌ها وجود نداشتند، از اجرا خارج شو
    if (!sidebar || !overlay || !toggleBtn || !mainContent) return;

    // تابع تشخیص موبایل
    const isMobile = () => window.innerWidth <= 991;

    // باز/بسته کردن سایدبار با دکمه
    toggleBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        if (isMobile()) {
            // در موبایل: toggle کلاس open و نمایش overlay
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        } else {
            // در دسکتاپ: toggle حالت collapse
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }
    });

    // بستن سایدبار با کلیک روی overlay (فقط موبایل)
    overlay.addEventListener('click', function () {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    });

    // بستن سایدبار موبایل هنگام کلیک روی آیتم‌های منو (به‌جز دکمه‌های دارای زیرمنو)
    const navItems = document.querySelectorAll('.sidebar .nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', function (e) {
            if (isMobile() && !this.classList.contains('has-sub')) {
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
            }
        });
    });

    // بستن سایدبار موبایل در صورت تغییر اندازه به دسکتاپ
    window.addEventListener('resize', function () {
        if (!isMobile()) {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
            // اگر حالت collapse قبلاً فعال نشده باشد، mainContent را ریست می‌کنیم
            if (!sidebar.classList.contains('collapsed')) {
                mainContent.classList.remove('expanded');
            }
        }
    });
});