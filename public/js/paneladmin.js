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