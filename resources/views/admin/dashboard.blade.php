@extends('admin.panel')

@section('content')
    <!-- ===== STATS ===== -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fa-solid fa-eye"></i>
            </div>
            <h3 id="statViews">۱۱۲,۰۰۰</h3>
            <span>بازدید پروفایل</span>
            <span class="change up">
                <i class="fa-solid fa-arrow-up"></i> ۱۲.۵٪
            </span>
            <div class="stat-bg">
                <i class="fa-regular fa-eye"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h3 id="statFollowers">۱۸۳,۰۰۰</h3>
            <span>دنبال‌کنندگان</span>
            <span class="change up">
                <i class="fa-solid fa-arrow-up"></i> ۸.۲٪
            </span>
            <div class="stat-bg">
                <i class="fa-regular fa-user"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon yellow">
                <i class="fa-solid fa-bookmark"></i>
            </div>
            <h3 id="statSaved">۱۱۲</h3>
            <span>ذخیره‌شده‌ها</span>
            <span class="change down">
                <i class="fa-solid fa-arrow-down"></i> ۲.۱٪
            </span>
            <div class="stat-bg">
                <i class="fa-regular fa-bookmark"></i>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fa-solid fa-comment"></i>
            </div>
            <h3 id="statComments">۴۵</h3>
            <span>نظرات جدید</span>
            <span class="change up">
                <i class="fa-solid fa-arrow-up"></i> ۲۳.۷٪
            </span>
            <div class="stat-bg">
                <i class="fa-regular fa-comment"></i>
            </div>
        </div>
    </div>
    <!-- ===== CHARTS ===== -->
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
    <!-- ===== BOTTOM ROW ===== -->
    <div class="bottom-row">
        <!-- بازدیدکنندگان -->
        <div class="visitor-card">
            <h6>
                <i class="fa-solid fa-earth-asia"></i> بازدید بر اساس منطقه
            </h6>
            <div class="visitor-item">
                <span class="label">اروپا</span>
                <div class="bar-track">
                    <div class="bar-fill" style="width: 45%"></div>
                </div>
                <span class="value">۸۶۲</span>
            </div>
            <div class="visitor-item">
                <span class="label">آمریکا</span>
                <div class="bar-track">
                    <div class="bar-fill orange" style="width: 30%"></div>
                </div>
                <span class="value">۳۷۵</span>
            </div>
            <div class="visitor-item">
                <span class="label">هند</span>
                <div class="bar-track">
                    <div class="bar-fill green" style="width: 55%"></div>
                </div>
                <span class="value">۶۲۵</span>
            </div>
            <div class="visitor-item">
                <span class="label">اندونزی</span>
                <div class="bar-track">
                    <div class="bar-fill purple" style="width: 75%"></div>
                </div>
                <span class="value">۱,۰۲۵</span>
            </div>
            <div class="visitor-item">
                <span class="label">ایران</span>
                <div class="bar-track">
                    <div class="bar-fill pink" style="width: 60%"></div>
                </div>
                <span class="value">۸۴۲</span>
            </div>
        </div>
        <!-- نظرات اخیر -->
        <div class="comments-card">
            <h6>
                <i class="fa-regular fa-comment-dots"></i> آخرین نظرات
            </h6>
            <div class="comment-item">
                <div class="cav" style="background: linear-gradient(135deg, var(--brand), var(--accent-2))">س.ع</div>
                <div class="cbody">
                    <h6>سارا عزیزی</h6>
                    <p>تبریک می‌گم بابت فارغ‌التحصیلی! موفق باشید ✨</p>
                    <span class="time">۲ ساعت پیش</span>
                </div>
            </div>
            <div class="comment-item">
                <div class="cav" style="background: linear-gradient(135deg, var(--accent), var(--brand))">م.ر</div>
                <div class="cbody">
                    <h6>محمد رضایی</h6>
                    <p>طراحی فوق‌العاده‌ای! میشه یه آموزش دیگه از این سبک بذارید؟</p>
                    <span class="time">۵ ساعت پیش</span>
                </div>
            </div>
            <div class="comment-item">
                <div class="cav" style="background: linear-gradient(135deg, var(--accent-2), var(--brand))">ن.ک</div>
                <div class="cbody">
                    <h6>نیما کریمی</h6>
                    <p>چه طراحی خیره‌کننده‌ای! خیلی خلاق و استعداد دارید 😍</p>
                    <span class="time">روز گذشته</span>
                </div>
            </div>
            <div class="comment-item">
                <div class="cav" style="background: linear-gradient(135deg, #8b5cf6, #a78bfa)">ز.م</div>
                <div class="cbody">
                    <h6>زهرا محمدی</h6>
                    <p>طراحیتون رو خیلی دوست دارم! خیلی زیبا و منحصربه‌فرد است 🌟</p>
                    <span class="time">۲ روز پیش</span>
                </div>
            </div>
        </div>
    </div>
@endsection
