// ============================================
// THEME
// ============================================
const root = document.documentElement;
const themeIcon = document.getElementById("themeIcon");

function applyTheme(t) {
  root.setAttribute("data-theme", t);
  themeIcon.className = t === "dark" ? "fa-solid fa-moon" : "fa-solid fa-sun";
  try {
    localStorage.setItem("mana-theme", t);
  } catch (e) {}
  setTimeout(() => {
    if (window.visitsChart) window.visitsChart.update();
    if (window.genderChart) window.genderChart.update();
  }, 100);
}

let savedTheme = "dark";
try {
  savedTheme = localStorage.getItem("mana-theme") || "dark";
} catch (e) {}
applyTheme(savedTheme);

document.getElementById("themeSwitch").addEventListener("click", () => {
  applyTheme(root.getAttribute("data-theme") === "dark" ? "light" : "dark");
});

// ============================================
// SIDEBAR TOGGLE
// ============================================
const sidebar = document.getElementById("sidebar");
const mainContent = document.getElementById("mainContent");
const overlay = document.getElementById("sidebarOverlay");
const toggleBtn = document.getElementById("sidebarToggle");

let isSidebarOpen = true;
let isMobile = window.innerWidth < 992;

function checkMobile() {
  isMobile = window.innerWidth < 992;
  if (isMobile) {
    sidebar.classList.remove("collapsed");
    sidebar.classList.remove("open");
    mainContent.classList.remove("expanded");
    overlay.classList.remove("show");
    isSidebarOpen = false;
  } else {
    sidebar.classList.remove("open");
    overlay.classList.remove("show");
    if (!isSidebarOpen) {
      sidebar.classList.add("collapsed");
      mainContent.classList.add("expanded");
    } else {
      sidebar.classList.remove("collapsed");
      mainContent.classList.remove("expanded");
    }
  }
}

toggleBtn.addEventListener("click", () => {
  if (isMobile) {
    sidebar.classList.toggle("open");
    overlay.classList.toggle("show");
  } else {
    isSidebarOpen = !isSidebarOpen;
    sidebar.classList.toggle("collapsed", !isSidebarOpen);
    mainContent.classList.toggle("expanded", !isSidebarOpen);
  }
});

overlay.addEventListener("click", () => {
  sidebar.classList.remove("open");
  overlay.classList.remove("show");
});

window.addEventListener("resize", checkMobile);
checkMobile();

// ============================================
// SUB-MENU TOGGLE (هم در دسکتاپ و هم موبایل)
// ============================================
document.querySelectorAll(".has-sub").forEach((btn) => {
  btn.addEventListener("click", function (e) {
    e.stopPropagation();
    const sub = this.nextElementSibling;
    if (sub && sub.classList.contains("sub-menu")) {
      sub.classList.toggle("open");
      this.classList.toggle("open");
    }
  });
});

// ============================================
// NAVIGATION
// ============================================
const navItems = document.querySelectorAll(".nav-item:not(.has-sub)");
const pageTitle = document.getElementById("pageTitle");
const pageContent = document.getElementById("pageContent");

const pageData = {
  dashboard: {
    title: "داشبورد",
    html: `
            <div class="stats-grid">
              <div class="stat-card">
                <div class="stat-icon blue"><i class="fa-solid fa-eye"></i></div>
                <h3>۱۱۲,۰۰۰</h3>
                <span>بازدید پروفایل</span>
                <span class="change up"><i class="fa-solid fa-arrow-up"></i> ۱۲.۵٪</span>
                <div class="stat-bg"><i class="fa-regular fa-eye"></i></div>
              </div>
              <div class="stat-card">
                <div class="stat-icon green"><i class="fa-solid fa-user-plus"></i></div>
                <h3>۱۸۳,۰۰۰</h3>
                <span>دنبال‌کنندگان</span>
                <span class="change up"><i class="fa-solid fa-arrow-up"></i> ۸.۲٪</span>
                <div class="stat-bg"><i class="fa-regular fa-user"></i></div>
              </div>
              <div class="stat-card">
                <div class="stat-icon yellow"><i class="fa-solid fa-bookmark"></i></div>
                <h3>۱۱۲</h3>
                <span>ذخیره‌شده‌ها</span>
                <span class="change down"><i class="fa-solid fa-arrow-down"></i> ۲.۱٪</span>
                <div class="stat-bg"><i class="fa-regular fa-bookmark"></i></div>
              </div>
              <div class="stat-card">
                <div class="stat-icon purple"><i class="fa-solid fa-comment"></i></div>
                <h3>۴۵</h3>
                <span>نظرات جدید</span>
                <span class="change up"><i class="fa-solid fa-arrow-up"></i> ۲۳.۷٪</span>
                <div class="stat-bg"><i class="fa-regular fa-comment"></i></div>
              </div>
            </div>
            <div class="charts-row">
              <div class="chart-card">
                <div class="card-header">
                  <h6><i class="fa-regular fa-calendar" style="color: var(--accent-2)"></i> آمار بازدید ماهانه</h6>
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
                  <h6><i class="fa-solid fa-circle-pie" style="color: var(--accent)"></i> ترکیب بازدیدکنندگان</h6>
                </div>
                <canvas id="genderChart"></canvas>
              </div>
            </div>
            <div class="bottom-row">
              <div class="visitor-card">
                <h6><i class="fa-solid fa-earth-asia"></i> بازدید بر اساس منطقه</h6>
                <div class="visitor-item">
                  <span class="label">اروپا</span>
                  <div class="bar-track"><div class="bar-fill" style="width: 45%"></div></div>
                  <span class="value">۸۶۲</span>
                </div>
                <div class="visitor-item">
                  <span class="label">آمریکا</span>
                  <div class="bar-track"><div class="bar-fill orange" style="width: 30%"></div></div>
                  <span class="value">۳۷۵</span>
                </div>
                <div class="visitor-item">
                  <span class="label">هند</span>
                  <div class="bar-track"><div class="bar-fill green" style="width: 55%"></div></div>
                  <span class="value">۶۲۵</span>
                </div>
                <div class="visitor-item">
                  <span class="label">اندونزی</span>
                  <div class="bar-track"><div class="bar-fill purple" style="width: 75%"></div></div>
                  <span class="value">۱,۰۲۵</span>
                </div>
                <div class="visitor-item">
                  <span class="label">ایران</span>
                  <div class="bar-track"><div class="bar-fill pink" style="width: 60%"></div></div>
                  <span class="value">۸۴۲</span>
                </div>
              </div>
              <div class="comments-card">
                <h6><i class="fa-regular fa-comment-dots"></i> آخرین نظرات</h6>
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
          `,
  },
  visitors: {
    title: "آمار بازدیدکنندگان",
    html: `
            <div class="chart-card" style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 28px; box-shadow: var(--shadow-strong);">
              <h5 style="font-weight: 700; margin-bottom: 18px;"><i class="fa-solid fa-users" style="color: var(--accent-2)"></i> آمار بازدیدکنندگان</h5>
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                <div style="background: var(--surface-2); border-radius: 14px; padding: 16px; border: 1px solid var(--line); text-align: center;">
                  <div style="font-size: 0.7rem; color: var(--text-dimmer);">مجموع بازدید</div>
                  <div style="font-size: 1.6rem; font-weight: 800; color: var(--brand);">۱,۲۴۷</div>
                </div>
                <div style="background: var(--surface-2); border-radius: 14px; padding: 16px; border: 1px solid var(--line); text-align: center;">
                  <div style="font-size: 0.7rem; color: var(--text-dimmer);">بازدید منحصربه‌فرد</div>
                  <div style="font-size: 1.6rem; font-weight: 800; color: var(--accent-2);">۸۹۲</div>
                </div>
                <div style="background: var(--surface-2); border-radius: 14px; padding: 16px; border: 1px solid var(--line); text-align: center;">
                  <div style="font-size: 0.7rem; color: var(--text-dimmer);">میانگین زمان بازدید</div>
                  <div style="font-size: 1.6rem; font-weight: 800; color: var(--accent);">۴:۲۳</div>
                </div>
                <div style="background: var(--surface-2); border-radius: 14px; padding: 16px; border: 1px solid var(--line); text-align: center;">
                  <div style="font-size: 0.7rem; color: var(--text-dimmer);">نرخ پرش</div>
                  <div style="font-size: 1.6rem; font-weight: 800; color: #ef4444;">۳۴٪</div>
                </div>
              </div>
              <div style="height: 200px; background: var(--surface-2); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: var(--text-dimmer); border: 1px solid var(--line); flex-direction: column; gap: 12px;">
                <i class="fa-solid fa-chart-bar" style="font-size: 3rem; opacity: 0.2;"></i>
                <span style="font-size: 0.85rem;">نمودار بازدید در اینجا قرار می‌گیرد</span>
              </div>
            </div>
          `,
  },
  sales: {
    title: "آمار فروش",
    html: `
            <div class="chart-card" style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 28px; box-shadow: var(--shadow-strong);">
              <h5 style="font-weight: 700; margin-bottom: 18px;"><i class="fa-solid fa-coins" style="color: var(--accent)"></i> آمار فروش</h5>
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div style="background: var(--surface-2); border-radius: 14px; padding: 16px; border: 1px solid var(--line); text-align: center;">
                  <div style="font-size: 0.7rem; color: var(--text-dimmer);">فروش امروز</div>
                  <div style="font-size: 1.4rem; font-weight: 800; color: var(--accent-2);">۱۲.۴M</div>
                </div>
                <div style="background: var(--surface-2); border-radius: 14px; padding: 16px; border: 1px solid var(--line); text-align: center;">
                  <div style="font-size: 0.7rem; color: var(--text-dimmer);">فروش این هفته</div>
                  <div style="font-size: 1.4rem; font-weight: 800; color: var(--brand);">۸۷.۲M</div>
                </div>
                <div style="background: var(--surface-2); border-radius: 14px; padding: 16px; border: 1px solid var(--line); text-align: center;">
                  <div style="font-size: 0.7rem; color: var(--text-dimmer);">فروش این ماه</div>
                  <div style="font-size: 1.4rem; font-weight: 800; color: var(--accent);">۳۴۲.۵M</div>
                </div>
                <div style="background: var(--surface-2); border-radius: 14px; padding: 16px; border: 1px solid var(--line); text-align: center;">
                  <div style="font-size: 0.7rem; color: var(--text-dimmer);">تعداد تراکنش‌ها</div>
                  <div style="font-size: 1.4rem; font-weight: 800; color: #8b5cf6;">۴۵۶</div>
                </div>
              </div>
              <div style="height: 160px; background: var(--surface-2); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: var(--text-dimmer); border: 1px solid var(--line); flex-direction: column; gap: 12px;">
                <i class="fa-solid fa-chart-simple" style="font-size: 3rem; opacity: 0.2;"></i>
                <span style="font-size: 0.85rem;">نمودار فروش در اینجا قرار می‌گیرد</span>
              </div>
            </div>
          `,
  },
  "users-stats": {
    title: "آمار کاربران",
    html: `
            <div class="chart-card" style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 28px; box-shadow: var(--shadow-strong);">
              <h5 style="font-weight: 700; margin-bottom: 18px;"><i class="fa-solid fa-users" style="color: var(--brand)"></i> آمار کاربران</h5>
              <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div style="background: var(--surface-2); border-radius: 14px; padding: 16px; border: 1px solid var(--line); text-align: center;">
                  <div style="font-size: 0.7rem; color: var(--text-dimmer);">کل کاربران</div>
                  <div style="font-size: 1.6rem; font-weight: 800; color: var(--brand);">۱۲,۴۵۶</div>
                </div>
                <div style="background: var(--surface-2); border-radius: 14px; padding: 16px; border: 1px solid var(--line); text-align: center;">
                  <div style="font-size: 0.7rem; color: var(--text-dimmer);">کاربران جدید (ماه)</div>
                  <div style="font-size: 1.6rem; font-weight: 800; color: var(--accent-2);">۸۹۲</div>
                </div>
                <div style="background: var(--surface-2); border-radius: 14px; padding: 16px; border: 1px solid var(--line); text-align: center;">
                  <div style="font-size: 0.7rem; color: var(--text-dimmer);">کاربران فعال</div>
                  <div style="font-size: 1.6rem; font-weight: 800; color: var(--accent);">۷,۸۳۴</div>
                </div>
              </div>
              <div style="height: 160px; background: var(--surface-2); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: var(--text-dimmer); border: 1px solid var(--line); flex-direction: column; gap: 12px;">
                <i class="fa-solid fa-user-group" style="font-size: 3rem; opacity: 0.2;"></i>
                <span style="font-size: 0.85rem;">نمودار رشد کاربران در اینجا قرار می‌گیرد</span>
              </div>
            </div>
          `,
  },
  users: {
    title: "مدیریت کاربران",
    html: `
            <div class="chart-card" style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 28px; box-shadow: var(--shadow-strong);">
              <h5 style="font-weight: 700; margin-bottom: 18px;"><i class="fa-solid fa-users" style="color: var(--brand)"></i> لیست کاربران</h5>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>رضا آواره</strong> <span style="color: var(--text-dimmer); font-size: 0.8rem;">@reza_avareh</span></span>
                <span style="color: var(--accent-2); font-size: 0.8rem; background: color-mix(in srgb, var(--accent-2) 15%, transparent); padding: 2px 12px; border-radius: 99px;">مدیر</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>سارا عزیزی</strong> <span style="color: var(--text-dimmer); font-size: 0.8rem;">@sara_azizi</span></span>
                <span style="color: var(--accent); font-size: 0.8rem; background: color-mix(in srgb, var(--accent) 15%, transparent); padding: 2px 12px; border-radius: 99px;">نویسنده</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>محمد رضایی</strong> <span style="color: var(--text-dimmer); font-size: 0.8rem;">@mohammad_rezaei</span></span>
                <span style="color: var(--text-dimmer); font-size: 0.8rem; background: var(--surface); padding: 2px 12px; border-radius: 99px;">کاربر</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>نیما کریمی</strong> <span style="color: var(--text-dimmer); font-size: 0.8rem;">@nima_karimi</span></span>
                <span style="color: var(--text-dimmer); font-size: 0.8rem; background: var(--surface); padding: 2px 12px; border-radius: 99px;">کاربر</span>
              </div>
            </div>
          `,
  },
  posts: {
    title: "مدیریت مقالات",
    html: `
            <div class="chart-card" style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 28px; box-shadow: var(--shadow-strong);">
              <h5 style="font-weight: 700; margin-bottom: 18px;"><i class="fa-regular fa-file-lines" style="color: var(--accent-2)"></i> مقالات</h5>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>چک‌لیست راه‌اندازی محصول دیجیتال</strong></span>
                <span style="color: var(--accent-2); font-size: 0.75rem; background: color-mix(in srgb, var(--accent-2) 15%, transparent); padding: 2px 12px; border-radius: 99px;">منتشر شده</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>راهنمای انتخاب استک فنی</strong></span>
                <span style="color: var(--accent); font-size: 0.75rem; background: color-mix(in srgb, var(--accent) 15%, transparent); padding: 2px 12px; border-radius: 99px;">پیش‌نویس</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>چگونه هوش مصنوعی فروش را متحول می‌کند؟</strong></span>
                <span style="color: var(--accent-2); font-size: 0.75rem; background: color-mix(in srgb, var(--accent-2) 15%, transparent); padding: 2px 12px; border-radius: 99px;">منتشر شده</span>
              </div>
            </div>
          `,
  },
  pages: {
    title: "مدیریت صفحات",
    html: `
            <div class="chart-card" style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 28px; box-shadow: var(--shadow-strong);">
              <h5 style="font-weight: 700; margin-bottom: 18px;"><i class="fa-regular fa-copy" style="color: var(--brand)"></i> صفحات</h5>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>صفحه اصلی</strong></span>
                <span style="color: var(--accent-2); font-size: 0.75rem;">فعال</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>درباره ما</strong></span>
                <span style="color: var(--accent-2); font-size: 0.75rem;">فعال</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>تماس با ما</strong></span>
                <span style="color: var(--text-dimmer); font-size: 0.75rem;">غیرفعال</span>
              </div>
            </div>
          `,
  },
  comments: {
    title: "مدیریت نظرات",
    html: `
            <div class="chart-card" style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 28px; box-shadow: var(--shadow-strong);">
              <h5 style="font-weight: 700; margin-bottom: 18px;"><i class="fa-regular fa-comments" style="color: var(--accent)"></i> نظرات (۱۲)</h5>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>سارا عزیزی</strong> <span style="color: var(--text-dimmer); font-size: 0.8rem;">تبریک می‌گم...</span></span>
                <span style="color: var(--accent-2); font-size: 0.75rem; background: color-mix(in srgb, var(--accent-2) 15%, transparent); padding: 2px 12px; border-radius: 99px;">تأیید شده</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>محمد رضایی</strong> <span style="color: var(--text-dimmer); font-size: 0.8rem;">طراحی فوق‌العاده‌ای...</span></span>
                <span style="color: var(--accent); font-size: 0.75rem; background: color-mix(in srgb, var(--accent) 15%, transparent); padding: 2px 12px; border-radius: 99px;">در انتظار</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>نیما کریمی</strong> <span style="color: var(--text-dimmer); font-size: 0.8rem;">چه طراحی خیره‌کننده‌ای...</span></span>
                <span style="color: var(--accent-2); font-size: 0.75rem; background: color-mix(in srgb, var(--accent-2) 15%, transparent); padding: 2px 12px; border-radius: 99px;">تأیید شده</span>
              </div>
            </div>
          `,
  },
  settings: {
    title: "تنظیمات",
    html: `
            <div class="chart-card" style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 28px; box-shadow: var(--shadow-strong);">
              <h5 style="font-weight: 700; margin-bottom: 18px;"><i class="fa-solid fa-gear" style="color: var(--brand)"></i> تنظیمات سیستم</h5>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><i class="fa-solid fa-circle-half-stroke" style="color: var(--accent-2); margin-left: 10px;"></i> حالت تیره/روشن</span>
                <span style="color: var(--accent-2); font-size: 0.8rem;">فعال</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><i class="fa-regular fa-envelope" style="color: var(--accent); margin-left: 10px;"></i> اعلان‌های ایمیل</span>
                <span style="color: var(--text-dimmer); font-size: 0.8rem;">غیرفعال</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><i class="fa-solid fa-headset" style="color: var(--brand); margin-left: 10px;"></i> پشتیبانی خودکار</span>
                <span style="color: var(--accent-2); font-size: 0.8rem;">فعال</span>
              </div>
            </div>
          `,
  },
  support: {
    title: "پشتیبانی",
    html: `
            <div class="chart-card" style="background: var(--surface); border: 1px solid var(--line); border-radius: 18px; padding: 28px; box-shadow: var(--shadow-strong);">
              <h5 style="font-weight: 700; margin-bottom: 18px;"><i class="fa-solid fa-headset" style="color: var(--accent-2)"></i> تیکت‌های پشتیبانی (۳)</h5>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>مشکل در ورود</strong> <span style="color: var(--text-dimmer); font-size: 0.8rem;">کاربر ۱۲۳۴</span></span>
                <span style="color: var(--accent); font-size: 0.75rem; background: color-mix(in srgb, var(--accent) 15%, transparent); padding: 2px 12px; border-radius: 99px;">در حال بررسی</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; margin-bottom: 10px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>مشکل در پرداخت</strong> <span style="color: var(--text-dimmer); font-size: 0.8rem;">کاربر ۵۶۷۸</span></span>
                <span style="color: var(--accent-2); font-size: 0.75rem; background: color-mix(in srgb, var(--accent-2) 15%, transparent); padding: 2px 12px; border-radius: 99px;">حل شده</span>
              </div>
              <div style="background: var(--surface-2); border-radius: 12px; padding: 14px 18px; border: 1px solid var(--line); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <span><strong>درخواست تغییر پلن</strong> <span style="color: var(--text-dimmer); font-size: 0.8rem;">کاربر ۹۰۱۲</span></span>
                <span style="color: var(--text-dimmer); font-size: 0.75rem; background: var(--surface); padding: 2px 12px; border-radius: 99px;">جدید</span>
              </div>
            </div>
          `,
  },
};

navItems.forEach((item) => {
  item.addEventListener("click", function () {
    const page = this.dataset.page;
    if (page && pageData[page]) {
      navItems.forEach((n) => n.classList.remove("active"));
      this.classList.add("active");

      pageTitle.textContent = pageData[page].title;
      pageContent.innerHTML = pageData[page].html;

      // ری‌استارت انیمیشن ورود محتوا هنگام تعویض صفحه
      pageContent.style.animation = "none";
      void pageContent.offsetWidth;
      pageContent.style.animation = "";

      setTimeout(() => {
        initCharts();
      }, 200);

      if (window.innerWidth < 992) {
        sidebar.classList.remove("open");
        overlay.classList.remove("show");
      }
    }
  });
});

// ============================================
// CHARTS
// ============================================
let visitsChartInstance = null;
let genderChartInstance = null;

function initCharts() {
  const visitsCanvas = document.getElementById("visitsChart");
  const genderCanvas = document.getElementById("genderChart");

  if (visitsChartInstance) {
    visitsChartInstance.destroy();
    visitsChartInstance = null;
  }
  if (genderChartInstance) {
    genderChartInstance.destroy();
    genderChartInstance = null;
  }

  if (!visitsCanvas || !genderCanvas) return;

  const isDark = root.getAttribute("data-theme") === "dark";
  const textColor = isDark ? "#9aa3c8" : "#4b5678";
  const gridColor = isDark ? "rgba(255,255,255,0.06)" : "rgba(0,0,0,0.06)";

  const ctx1 = visitsCanvas.getContext("2d");
  visitsChartInstance = new Chart(ctx1, {
    type: "line",
    data: {
      labels: [
        "فروردین",
        "اردیبهشت",
        "خرداد",
        "تیر",
        "مرداد",
        "شهریور",
        "مهر",
        "آبان",
        "آذر",
        "دی",
        "بهمن",
        "اسفند",
      ],
      datasets: [
        {
          label: "بازدید",
          data: [
            4200, 5100, 4800, 6200, 5800, 7100, 6900, 8200, 7800, 9100, 10500,
            11200,
          ],
          borderColor: "#2f7dfb",
          backgroundColor: isDark
            ? "rgba(47,125,251,0.15)"
            : "rgba(47,125,251,0.1)",
          fill: true,
          tension: 0.4,
          pointRadius: 4,
          pointBackgroundColor: "#17c3b2",
          borderWidth: 3,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: isDark ? "#0f1730" : "#ffffff",
          titleColor: isDark ? "#f4f6fb" : "#0a152e",
          bodyColor: isDark ? "#9aa3c8" : "#4b5678",
          borderColor: isDark ? "rgba(255,255,255,0.09)" : "rgba(0,0,0,0.09)",
          borderWidth: 1,
          cornerRadius: 12,
          padding: 12,
        },
      },
      scales: {
        y: {
          beginAtZero: true,
          grid: { color: gridColor, drawBorder: false },
          ticks: { color: textColor, font: { family: "Vazirmatn" } },
        },
        x: {
          grid: { display: false },
          ticks: { color: textColor, font: { family: "Vazirmatn", size: 10 } },
        },
      },
    },
  });

  const ctx2 = genderCanvas.getContext("2d");
  genderChartInstance = new Chart(ctx2, {
    type: "doughnut",
    data: {
      labels: ["مرد", "زن"],
      datasets: [
        {
          data: [70, 30],
          backgroundColor: ["#2f7dfb", "#17c3b2"],
          borderWidth: 0,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      cutout: "65%",
      plugins: {
        legend: {
          position: "bottom",
          labels: {
            color: textColor,
            font: { family: "Vazirmatn", size: 12 },
            padding: 16,
            usePointStyle: true,
            pointStyle: "circle",
          },
        },
        tooltip: {
          backgroundColor: isDark ? "#0f1730" : "#ffffff",
          titleColor: isDark ? "#f4f6fb" : "#0a152e",
          bodyColor: isDark ? "#9aa3c8" : "#4b5678",
          borderColor: isDark ? "rgba(255,255,255,0.09)" : "rgba(0,0,0,0.09)",
          borderWidth: 1,
          cornerRadius: 12,
          padding: 12,
          callbacks: {
            label: function (context) {
              return context.label + ": " + context.parsed + "%";
            },
          },
        },
      },
    },
  });

  document.querySelectorAll(".filter-btns button").forEach((btn) => {
    btn.addEventListener("click", function () {
      document
        .querySelectorAll(".filter-btns button")
        .forEach((b) => b.classList.remove("active"));
      this.classList.add("active");
      const period = this.dataset.period;
      const dataMap = {
        month: [
          4200, 5100, 4800, 6200, 5800, 7100, 6900, 8200, 7800, 9100, 10500,
          11200,
        ],
        week: [1200, 1400, 1100, 1600, 1500, 1900, 2100],
        year: [35000, 42000, 38000, 45000, 48000, 52000, 58000],
      };
      const labelsMap = {
        month: [
          "فروردین",
          "اردیبهشت",
          "خرداد",
          "تیر",
          "مرداد",
          "شهریور",
          "مهر",
          "آبان",
          "آذر",
          "دی",
          "بهمن",
          "اسفند",
        ],
        week: [
          "شنبه",
          "یکشنبه",
          "دوشنبه",
          "سه‌شنبه",
          "چهارشنبه",
          "پنج‌شنبه",
          "جمعه",
        ],
        year: ["۱۳۹۹", "۱۴۰۰", "۱۴۰۱", "۱۴۰۲", "۱۴۰۳", "۱۴۰۴", "۱۴۰۵"],
      };
      if (visitsChartInstance) {
        visitsChartInstance.data.labels = labelsMap[period] || labelsMap.month;
        visitsChartInstance.data.datasets[0].data =
          dataMap[period] || dataMap.month;
        visitsChartInstance.update();
      }
    });
  });
}

// ============================================
// NOTIFICATION
// ============================================
document.getElementById("notifBtn").addEventListener("click", function () {
  const dot = this.querySelector(".dot");
  dot.style.display = "none";
  alert(
    "🔔 ۳ اعلان خوانده‌نشده دارید:\n\n1. نظر جدید از سارا عزیزی\n2. پیام جدید از محمد رضایی\n3. به‌روزرسانی سیستم",
  );
});

// ============================================
// CUSTOM CURSOR
// ============================================
if (window.matchMedia("(pointer:fine)").matches) {
  document.body.classList.add("has-cursor");
  const dot = document.getElementById("curDot");
  const ring = document.getElementById("curRing");
  let mx = 0,
    my = 0,
    rx = 0,
    ry = 0;
  window.addEventListener("mousemove", (e) => {
    mx = e.clientX;
    my = e.clientY;
    dot.style.transform = `translate(${mx}px,${my}px) translate(-50%,-50%)`;
  });

  function loop() {
    rx += (mx - rx) * 0.16;
    ry += (my - ry) * 0.16;
    ring.style.transform = `translate(${rx}px,${ry}px) translate(-50%,-50%)`;
    requestAnimationFrame(loop);
  }
  loop();

  document
    .querySelectorAll(
      "a, button, .stat-card, .chart-card, .visitor-card, .comments-card, .comment-item, .nav-item, .user-card, .notif-btn, .theme-switch",
    )
    .forEach((el) => {
      el.addEventListener("mouseenter", () => ring.classList.add("hover"));
      el.addEventListener("mouseleave", () => ring.classList.remove("hover"));
    });
}

// ============================================
// INIT
// ============================================
setTimeout(() => {
  initCharts();
}, 300);

console.log("🚀 پنل مدیریت مانا با موفقیت بارگذاری شد!");
