<!doctype html>
<html lang="fa" dir="rtl" data-theme="dark">
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/mana.png') }}">
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>مانا | راهکارهای هوشمند دیجیتال</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" >
    <link
        href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>
<body>
<div class="cur-dot" id="curDot"></div>
<div class="cur-ring" id="curRing"></div>

<div class="scroll-progress" id="scrollProgress"></div>

<!-- ============ HEADER ============ -->
<header class="site-header" id="siteHeader">
    <div class="container-x nav-wrap">
        <a href="#home" class="brand"
        ><span class="mark">
            <img src="{{ asset('img/mana.png') }}" alt="">
                </i></span></a>
        <nav class="main-nav">
            <a href="#home" class="active">خانه</a>
            <a href="#services">خدمات</a>
            <a href="#folio">نمونه‌کار</a>
            <a href="#team">تیم</a>
            <a href="#contact">تماس</a>
            <a href="#blog">وبلاگ</a>

        </nav>
        <div class="header-cta">
            <div class="theme-switch" id="themeSwitch">
                <div class="knob">
                    <i class="fa-solid fa-moon" id="themeIcon"></i>
                </div>
            </div>
            <a href="#contact" class="btn-flow"
            ><i class="fa-solid fa-arrow-left"></i> مشاوره رایگان</a
            >
            <button class="burger" id="burgerBtn">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
</header>

<div class="mnav-backdrop" id="mnavBackdrop"></div>
<div class="mnav-panel" id="mnavPanel">
    <div class="mnav-handle"></div>
    <div class="top">
        <h6>منوی سریع</h6>
        <button class="burger" id="closeDrawer">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <nav>
        <a href="#home" class="active" data-close
        ><i class="fa-solid fa-house"></i> خانه</a
        >
        <a href="#services" data-close
        ><i class="fa-solid fa-layer-group"></i> خدمات</a
        >
        <a href="#folio" data-close
        ><i class="fa-solid fa-briefcase"></i> نمونه‌کار</a
        >
        <a href="#team" data-close
        ><i class="fa-solid fa-people-group"></i> تیم</a
        >
        <a href="#blog" data-close><i class="fa-solid fa-pen-nib"></i> وبلاگ</a>
        <a href="#contact" data-close><i class="fa-solid fa-phone"></i> تماس</a>
    </nav>
    <div class="foot">
        <div class="theme-switch" id="themeSwitchMobile">
            <div class="knob"><i class="fa-solid fa-moon"></i></div>
        </div>
        <a href="#contact" class="btn-flow" data-close
        >مشاوره رایگان <i class="fa-solid fa-arrow-left"></i
            ></a>
    </div>
</div>

<!-- ============ MAIN CONTENT ============ -->
@yield('content')

<!-- ============ FOOTER ============ -->
<footer class="site-footer">
    <div class="footer-inner">
        <div class="container-x">
            <div class="footer-island reveal">
                <div class="dots"></div>
                <div class="footer-newsletter">
                    <div class="fn-text">
                        <div class="fn-ic">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                        <div>
                            <strong>از آخرین اخبار و تخفیف‌ها باخبر شوید!</strong>
                            <span class="sub">هر هفته یک ایمیل، بدون اسپم</span>
                        </div>
                    </div>
                    <form onsubmit="return false;">
                        <input type="email" placeholder="آدرس ایمیل شما..." />
                        <button type="submit">ارسال</button>
                    </form>
                </div>

                <div class="footer-3col">
                    <div class="footer-col">
                        <h5>لینک‌های سریع</h5>
                        <ul>
                            <li>
                                <a href="#home"
                                ><i class="fa-solid fa-caret-left"></i> خانه</a
                                >
                            </li>
                            <li>
                                <a href="#folio"
                                ><i class="fa-solid fa-caret-left"></i> نمونه‌کارها</a
                                >
                            </li>
                            <li>
                                <a href="#team"
                                ><i class="fa-solid fa-caret-left"></i> تیم ما</a
                                >
                            </li>

                            <li>
                                <a href="#contact"
                                ><i class="fa-solid fa-caret-left"></i> تماس با ما</a
                                >
                            </li>
                            <li>
                                <a href="#blog"
                                ><i class="fa-solid fa-caret-left"></i> وبلاگ</a
                                >
                            </li>
                        </ul>
                    </div>

                    <div class="footer-col footer-center">
                        <a href="#home" class="footer-brand">
                            مانا</a
                        >
                        <p class="footer-tag">
                            ارائه‌ی راهکارهای هوشمند دیجیتال؛ از ایده تا اجرا، همراه
                            کسب‌وکار شما برای ساختن آینده‌ای دیجیتال.
                        </p>
                        <div class="footer-social">
                            <a href="#"><i class="fa-brands fa-telegram"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                    </div>

                    <div class="footer-col">
                        <h5>خدمات</h5>
                        <ul>
                            <li>
                                <a href="#services"
                                ><i class="fa-solid fa-caret-left"></i> هوش مصنوعی</a
                                >
                            </li>
                            <li>
                                <a href="#services"
                                ><i class="fa-solid fa-caret-left"></i> طراحی وب‌سایت</a
                                >
                            </li>
                            <li>
                                <a href="#services"
                                ><i class="fa-solid fa-caret-left"></i> اپلیکیشن موبایل</a
                                >
                            </li>
                            <li>
                                <a href="#services"
                                ><i class="fa-solid fa-caret-left"></i> زیرساخت ابری</a
                                >
                            </li>
                            <li>
                                <a href="tel:02117545678"
                                ><i class="fa-solid fa-phone"></i> ۰۲۱-۱۷۵۴۵۶۷۸</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="footer-badges">
                    <div class="fb-item">
                        <i class="fa-solid fa-shield-halved"></i> قرارداد و محرمانگی NDA
                    </div>
                    <div class="fb-item">
                        <i class="fa-solid fa-headset"></i> پشتیبانی ۲۴/۷
                    </div>
                    <div class="fb-item">
                        <i class="fa-solid fa-bolt"></i> تحویل به‌موقع پروژه
                    </div>
                    <div class="fb-item">
                        <i class="fa-solid fa-tags"></i> قیمت‌گذاری شفاف
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© ۲۰۲۶ مانا. تمامی حقوق محفوظ است.</p>
                <div class="legal">
                    <a href="#">حریم خصوصی</a>
                    <a href="#">شرایط استفاده</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<button class="to-top" id="toTop">
    <i class="fa-solid fa-arrow-up"></i>
</button>
<a href="#contact" class="chat-fab" id="chatFab"
><i class="fa-solid fa-comment-dots"></i
    ></a>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
