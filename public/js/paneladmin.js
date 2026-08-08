document.addEventListener('DOMContentLoaded', function() {
    loadDashboardStats();
    loadVisitsChart();
    loadGenderChart();
    loadVisitorsByRegion();
    loadRecentComments();
});

// لود آمار کلی
function loadDashboardStats() {
    fetch('/api/admin/dashboard/stats')
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                const data = result.data;
                document.getElementById('statViews').textContent = data.profile_views;
                document.getElementById('statFollowers').textContent = data.followers;
                document.getElementById('statSaved').textContent = data.saved;
                document.getElementById('statComments').textContent = data.comments;
            }
        })
        .catch(error => console.error('Error loading stats:', error));
}

// لود نمودار بازدید
function loadVisitsChart(period = 'month') {
    fetch(`/api/admin/dashboard/visits-chart?period=${period}`)
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                const ctx = document.getElementById('visitsChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: result.data.labels,
                        datasets: [
                            {
                                label: 'بازدید',
                                data: result.data.visits,
                                borderColor: '#6366f1',
                                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                                tension: 0.4,
                                fill: true
                            },
                            {
                                label: 'بازدیدکننده',
                                data: result.data.visitors,
                                borderColor: '#8b5cf6',
                                backgroundColor: 'rgba(139, 92, 246, 0.1)',
                                tension: 0.4,
                                fill: true
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
        });
}

// لود نمودار جنسیت
function loadGenderChart() {
    fetch('/api/admin/dashboard/gender-chart')
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                const ctx = document.getElementById('genderChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: result.data.labels,
                        datasets: [{
                            data: result.data.values,
                            backgroundColor: ['#6366f1', '#ec4899', '#94a3b8']
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }
        });
}

// لود بازدیدکنندگان بر اساس منطقه
function loadVisitorsByRegion() {
    fetch('/api/admin/dashboard/visitors-by-region')
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // اینجا می‌تونی داده‌ها رو به صفحه اضافه کنی
                console.log('Visitors by region:', result.data);
            }
        });
}

// لود نظرات اخیر
function loadRecentComments() {
    fetch('/api/admin/dashboard/recent-comments')
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // اینجا می‌تونی نظرات رو به صفحه اضافه کنی
                console.log('Recent comments:', result.data);
            }
        });
}

// Sidebar Toggle
document.getElementById('sidebarToggle')?.addEventListener('click', function() {
    document.getElementById('sidebar')?.classList.toggle('collapsed');
    document.getElementById('sidebarOverlay')?.classList.toggle('active');
});

// Theme Toggle
document.getElementById('themeSwitch')?.addEventListener('click', function() {
    const html = document.documentElement;
    const theme = html.getAttribute('data-theme');
    const newTheme = theme === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', newTheme);

    const icon = document.getElementById('themeIcon');
    if (icon) {
        icon.className = newTheme === 'dark' ? 'fa-solid fa-moon' : 'fa-solid fa-sun';
    }
});

// Submenu Toggle
document.querySelectorAll('.has-sub').forEach(button => {
    button.addEventListener('click', function() {
        const subMenu = this.nextElementSibling;
        const arrow = this.querySelector('.arrow i');

        subMenu?.classList.toggle('open');
        if (arrow) {
            arrow.classList.toggle('fa-chevron-left');
            arrow.classList.toggle('fa-chevron-down');
        }
    });
});
