<!doctype html>
<html lang="fa" dir="rtl" data-theme="dark">
  <head>
     <link rel="icon" type="image/x-icon" href="{{ asset('img/mana.png') }}">
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>{{ $siteTexts['footer_brand'] ?? 'مانا' }} | راهکارهای هوشمند دیجیتال</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" >
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
  </head>
  <body>
    <div class="cur-dot" id="curDot"></div>
    <div class="cur-ring" id="curRing"></div>
    <div class="scroll-progress" id="scrollProgress"></div>

    <header class="site-header" id="siteHeader">
      <div class="container-x nav-wrap">
        <a href="#home" class="brand"><span class="mark"><img src="{{ asset('img/mana.png') }}" alt="logo"></span></a>
        <nav class="main-nav">
          <a href="#home" class="active">{{ $siteTexts['nav_home'] ?? 'خانه' }}</a>
          <a href="#services">{{ $siteTexts['services_badge'] ?? 'خدمات' }}</a>
          <a href="#folio">{{ $siteTexts['folio_badge'] ?? 'نمونه‌کار' }}</a>
          <a href="#team">{{ $siteTexts['team_badge'] ?? 'تیم' }}</a>
          <a href="#contact">{{ $siteTexts['contact_badge'] ?? 'تماس' }}</a>
          <a href="#blog">{{ $siteTexts['blog_nav'] ?? 'وبلاگ' }}</a>
        </nav>
        <div class="header-cta">
          <div class="theme-switch" id="themeSwitch"><div class="knob"><i class="fa-solid fa-moon" id="themeIcon"></i></div></div>
          <a href="#contact" class="btn-flow"><i class="fa-solid fa-arrow-left"></i> {{ $siteTexts['hero_cta'] ?? 'مشاوره رایگان' }}</a>
          <button class="burger" id="burgerBtn"><i class="fa-solid fa-bars"></i></button>
        </div>
      </div>
    </header>

    <div class="mnav-backdrop" id="mnavBackdrop"></div>
    <div class="mnav-panel" id="mnavPanel">
      <div class="mnav-handle"></div>
      <div class="top"><h6>{{ $siteTexts['nav_quick'] ?? 'منوی سریع' }}</h6><button class="burger" id="closeDrawer"><i class="fa-solid fa-xmark"></i></button></div>
      <nav>
        <a href="#home" class="active" data-close><i class="fa-solid fa-house"></i> {{ $siteTexts['nav_home'] ?? 'خانه' }}</a>
        <a href="#services" data-close><i class="fa-solid fa-layer-group"></i> {{ $siteTexts['services_badge'] ?? 'خدمات' }}</a>
        <a href="#folio" data-close><i class="fa-solid fa-briefcase"></i> {{ $siteTexts['folio_badge'] ?? 'نمونه‌کار' }}</a>
        <a href="#team" data-close><i class="fa-solid fa-people-group"></i> {{ $siteTexts['team_badge'] ?? 'تیم' }}</a>
        <a href="#blog" data-close><i class="fa-solid fa-pen-nib"></i> {{ $siteTexts['blog_nav'] ?? 'وبلاگ' }}</a>
        <a href="#contact" data-close><i class="fa-solid fa-phone"></i> {{ $siteTexts['contact_badge'] ?? 'تماس' }}</a>
      </nav>
      <div class="foot">
        <div class="theme-switch" id="themeSwitchMobile"><div class="knob"><i class="fa-solid fa-moon"></i></div></div>
        <a href="#contact" class="btn-flow" data-close>{{ $siteTexts['hero_cta'] ?? 'مشاوره رایگان' }} <i class="fa-solid fa-arrow-left"></i></a>
      </div>
    </div>

    <!doctype html>
<html lang="fa" dir="rtl" data-theme="dark">
  <head>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/mana.png') }}">
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>{{ $blog->title ?? 'جزئیات مقاله' }} | {{ $siteTexts['footer_brand'] ?? 'مانا' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" >
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />

    <style>
      .blog-single-hero {
        padding-top: 140px;
        padding-bottom: 80px;
        min-height: 70vh;
      }
      .blog-single-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 24px;
        padding: 2.5rem;
        backdrop-filter: blur(12px);
      }
      .blog-cover-img {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        border-radius: 16px;
        margin-bottom: 2rem;
      }
      .blog-meta-bar {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        color: #94a3b8;
        font-size: 0.9rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding-bottom: 1.2rem;
        margin-bottom: 2rem;
      }
      .blog-meta-bar i {
        color: #00f2fe;
        margin-left: 6px;
      }
      .blog-main-text {
        color: #e2e8f0;
        line-height: 2.2;
        font-size: 1.1rem;
      }
      .blog-main-text p {
        margin-bottom: 1.5rem;
      }
      .blog-main-text img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 1.5rem 0;
      }
      .blog-main-text h1, 
      .blog-main-text h2, 
      .blog-main-text h3, 
      .blog-main-text h4 {
        color: #ffffff;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
      }
      .blog-main-text blockquote {
        border-right: 4px solid #00f2fe;
        padding: 1rem 1.5rem;
        background: rgba(0, 242, 254, 0.05);
        border-radius: 0 12px 12px 0;
        margin: 1.5rem 0;
      }
    </style>
  </head>
  <body>
    <div class="cur-dot" id="curDot"></div>
    <div class="cur-ring" id="curRing"></div>
    <div class="scroll-progress" id="scrollProgress"></div>

    <header class="site-header" id="siteHeader">
      <div class="container-x nav-wrap">
        <a href="{{ route('home') }}" class="brand"><span class="mark"><img src="{{ asset('img/mana.png') }}" alt="logo"></span></a>
        <nav class="main-nav">
          <a href="{{ route('home') }}#home">{{ $siteTexts['nav_home'] ?? 'خانه' }}</a>
          <a href="{{ route('home') }}#services">{{ $siteTexts['services_badge'] ?? 'خدمات' }}</a>
          <a href="{{ route('home') }}#folio">{{ $siteTexts['folio_badge'] ?? 'نمونه‌کار' }}</a>
          <a href="{{ route('home') }}#team">{{ $siteTexts['team_badge'] ?? 'تیم' }}</a>
          <a href="{{ route('home') }}#contact">{{ $siteTexts['contact_badge'] ?? 'تماس' }}</a>
          <a href="{{ route('home') }}#blog" class="active">{{ $siteTexts['blog_nav'] ?? 'وبلاگ' }}</a>
        </nav>
        <div class="header-cta">
          <div class="theme-switch" id="themeSwitch"><div class="knob"><i class="fa-solid fa-moon" id="themeIcon"></i></div></div>
          <a href="{{ route('home') }}#contact" class="btn-flow"><i class="fa-solid fa-arrow-left"></i> {{ $siteTexts['hero_cta'] ?? 'مشاوره رایگان' }}</a>
          <button class="burger" id="burgerBtn"><i class="fa-solid fa-bars"></i></button>
        </div>
      </div>
    </header>

    <div class="mnav-backdrop" id="mnavBackdrop"></div>
    <div class="mnav-panel" id="mnavPanel">
      <div class="mnav-handle"></div>
      <div class="top"><h6>{{ $siteTexts['nav_quick'] ?? 'منوی سریع' }}</h6><button class="burger" id="closeDrawer"><i class="fa-solid fa-xmark"></i></button></div>
      <nav>
        <a href="{{ route('home') }}#home" data-close><i class="fa-solid fa-house"></i> {{ $siteTexts['nav_home'] ?? 'خانه' }}</a>
        <a href="{{ route('home') }}#services" data-close><i class="fa-solid fa-layer-group"></i> {{ $siteTexts['services_badge'] ?? 'خدمات' }}</a>
        <a href="{{ route('home') }}#folio" data-close><i class="fa-solid fa-briefcase"></i> {{ $siteTexts['folio_badge'] ?? 'نمونه‌کار' }}</a>
        <a href="{{ route('home') }}#team" data-close><i class="fa-solid fa-people-group"></i> {{ $siteTexts['team_badge'] ?? 'تیم' }}</a>
        <a href="{{ route('home') }}#blog" class="active" data-close><i class="fa-solid fa-pen-nib"></i> {{ $siteTexts['blog_nav'] ?? 'وبلاگ' }}</a>
        <a href="{{ route('home') }}#contact" data-close><i class="fa-solid fa-phone"></i> {{ $siteTexts['contact_badge'] ?? 'تماس' }}</a>
      </nav>
      <div class="foot">
        <div class="theme-switch" id="themeSwitchMobile"><div class="knob"><i class="fa-solid fa-moon"></i></div></div>
        <a href="{{ route('home') }}#contact" class="btn-flow" data-close>{{ $siteTexts['hero_cta'] ?? 'مشاوره رایگان' }} <i class="fa-solid fa-arrow-left"></i></a>
      </div>
    </div>

    <!-- بخش اصلی مقاله -->
    <main class="blog-single-hero">
      <div class="container-x">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <article class="blog-single-card">
              
              {{-- کاور مقاله --}}
              @if(!empty($blog->image_url))
                <img src="{{ asset('storage/' . $blog->image_url) }}" alt="{{ $blog->title }}" class="blog-cover-img">
              @endif

              {{-- عنوان مقاله --}}
              <h1 class="text-white fw-bold mb-4" style="line-height: 1.4; font-size: 2.2rem;">
                {{ $blog->title }}
              </h1>

              {{-- اطلاعات متاداده --}}
              <div class="blog-meta-bar">
                @if(isset($blog->created_at))
                  <span><i class="fa-regular fa-calendar"></i> {{ \Morilog\Jalali\Jalalian::fromDateTime($blog->created_at)->format('Y/m/d') }}</span>
                @endif
                
                @if(!empty($blog->{'reading-time'}))
                  <span><i class="fa-regular fa-clock"></i> زمان مطالعه: {{ $blog->{'reading-time'} }} دقیقه</span>
                @endif
              </div>

              {{-- متن مقاله --}}
              <div class="blog-main-text">
                {!! $blog->text !!}
              </div>

              {{-- دکمه بازگشت --}}
              <div class="mt-5 pt-4 border-top border-secondary border-opacity-25 d-flex justify-content-between align-items-center">
                <a href="{{ route('home') }}#blog" class="btn-flow">
                  <i class="fa-solid fa-arrow-right me-2"></i> بازگشت به وبلاگ
                </a>
              </div>

            </article>
          </div>
        </div>
      </div>
    </main>

    <footer class="site-footer">
      <div class="footer-inner">
        <div class="container-x">
          <div class="footer-island reveal">
            <div class="dots"></div>
            <div class="footer-newsletter">
              <div class="fn-text">
                <div class="fn-ic"><i class="fa-solid fa-envelope-open-text"></i></div>
                <div><strong>{{ $siteTexts['newsletter_title'] ?? '' }}</strong><span class="sub">{{ $siteTexts['newsletter_sub'] ?? '' }}</span></div>
              </div>
              <form onsubmit="return false;"><input type="email" placeholder="آدرس ایمیل شما..." /><button type="submit">ارسال</button></form>
            </div>
            <div class="footer-3col">
              <div class="footer-col"><h5>{{ $siteTexts['footer_links'] ?? 'لینک‌های سریع' }}</h5><ul><li><a href="{{ route('home') }}#home"><i class="fa-solid fa-caret-left"></i> خانه</a></li><li><a href="{{ route('home') }}#folio"><i class="fa-solid fa-caret-left"></i> نمونه‌کارها</a></li><li><a href="{{ route('home') }}#team"><i class="fa-solid fa-caret-left"></i> تیم ما</a></li><li><a href="{{ route('home') }}#contact"><i class="fa-solid fa-caret-left"></i> تماس با ما</a></li><li><a href="{{ route('home') }}#blog"><i class="fa-solid fa-caret-left"></i> وبلاگ</a></li></ul></div>
              <div class="footer-col footer-center"><a href="{{ route('home') }}" class="footer-brand">{{ $siteTexts['footer_brand'] ?? 'مانا' }}</a><p class="footer-tag">{{ $siteTexts['footer_tag'] ?? '' }}</p><div class="footer-social"><a href="#"><i class="fa-brands fa-telegram"></i></a><a href="#"><i class="fa-brands fa-instagram"></i></a><a href="#"><i class="fa-brands fa-whatsapp"></i></a><a href="#"><i class="fa-brands fa-x-twitter"></i></a><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></div></div>
              <div class="footer-col"><h5>{{ $siteTexts['footer_services'] ?? 'خدمات ما' }}</h5><ul><li><a href="{{ route('home') }}#services"><i class="fa-solid fa-caret-left"></i> هوش مصنوعی</a></li><li><a href="{{ route('home') }}#services"><i class="fa-solid fa-caret-left"></i> طراحی وب‌سایت</a></li><li><a href="{{ route('home') }}#services"><i class="fa-solid fa-caret-left"></i> اپلیکیشن موبایل</a></li><li><a href="{{ route('home') }}#services"><i class="fa-solid fa-caret-left"></i> زیرساخت ابری</a></li><li><a href="tel:02117545678"><i class="fa-solid fa-phone"></i> ۰۲۱-۱۷۵۴۵۶۷۸</a></li></ul></div>
            </div>
            <div class="footer-badges"><div class="fb-item"><i class="fa-solid fa-shield-halved"></i> {{ $siteTexts['badge1'] ?? '' }}</div><div class="fb-item"><i class="fa-solid fa-headset"></i> {{ $siteTexts['badge2'] ?? '' }}</div><div class="fb-item"><i class="fa-solid fa-bolt"></i> {{ $siteTexts['badge3'] ?? '' }}</div><div class="fb-item"><i class="fa-solid fa-tags"></i> {{ $siteTexts['badge4'] ?? '' }}</div></div>
          </div>
          <div class="footer-bottom"><p>{{ $siteTexts['copyright'] ?? '' }}</p><div class="legal"><a href="#">حریم خصوصی</a><a href="#">شرایط استفاده</a></div></div>
        </div>
      </div>
    </footer>

    <button class="to-top" id="toTop"><i class="fa-solid fa-arrow-up"></i></button>
    <a href="{{ route('home') }}#contact" class="chat-fab" id="chatFab"><i class="fa-solid fa-comment-dots"></i></a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
  </body>
</html>

    <footer class="site-footer">
      <div class="footer-inner">
        <div class="container-x">
          <div class="footer-island reveal">
            <div class="dots"></div>
            <div class="footer-newsletter">
              <div class="fn-text">
                <div class="fn-ic"><i class="fa-solid fa-envelope-open-text"></i></div>
                <div><strong>{{ $siteTexts['newsletter_title'] ?? '' }}</strong><span class="sub">{{ $siteTexts['newsletter_sub'] ?? '' }}</span></div>
              </div>
              <form onsubmit="return false;"><input type="email" placeholder="آدرس ایمیل شما..." /><button type="submit">ارسال</button></form>
            </div>
            <div class="footer-3col">
              <div class="footer-col"><h5>{{ $siteTexts['footer_links'] ?? 'لینک‌های سریع' }}</h5><ul><li><a href="#home"><i class="fa-solid fa-caret-left"></i> خانه</a></li><li><a href="#folio"><i class="fa-solid fa-caret-left"></i> نمونه‌کارها</a></li><li><a href="#team"><i class="fa-solid fa-caret-left"></i> تیم ما</a></li><li><a href="#contact"><i class="fa-solid fa-caret-left"></i> تماس با ما</a></li><li><a href="#blog"><i class="fa-solid fa-caret-left"></i> وبلاگ</a></li></ul></div>
              <div class="footer-col footer-center"><a href="#home" class="footer-brand">{{ $siteTexts['footer_brand'] ?? 'مانا' }}</a><p class="footer-tag">{{ $siteTexts['footer_tag'] ?? '' }}</p><div class="footer-social"><a href="#"><i class="fa-brands fa-telegram"></i></a><a href="#"><i class="fa-brands fa-instagram"></i></a><a href="#"><i class="fa-brands fa-whatsapp"></i></a><a href="#"><i class="fa-brands fa-x-twitter"></i></a><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></div></div>
              <div class="footer-col"><h5>{{ $siteTexts['footer_services'] ?? 'خدمات ما' }}</h5><ul><li><a href="#services"><i class="fa-solid fa-caret-left"></i> هوش مصنوعی</a></li><li><a href="#services"><i class="fa-solid fa-caret-left"></i> طراحی وب‌سایت</a></li><li><a href="#services"><i class="fa-solid fa-caret-left"></i> اپلیکیشن موبایل</a></li><li><a href="#services"><i class="fa-solid fa-caret-left"></i> زیرساخت ابری</a></li><li><a href="tel:02117545678"><i class="fa-solid fa-phone"></i> ۰۲۱-۱۷۵۴۵۶۷۸</a></li></ul></div>
            </div>
            <div class="footer-badges"><div class="fb-item"><i class="fa-solid fa-shield-halved"></i> {{ $siteTexts['badge1'] ?? '' }}</div><div class="fb-item"><i class="fa-solid fa-headset"></i> {{ $siteTexts['badge2'] ?? '' }}</div><div class="fb-item"><i class="fa-solid fa-bolt"></i> {{ $siteTexts['badge3'] ?? '' }}</div><div class="fb-item"><i class="fa-solid fa-tags"></i> {{ $siteTexts['badge4'] ?? '' }}</div></div>
          </div>
          <div class="footer-bottom"><p>{{ $siteTexts['copyright'] ?? '' }}</p><div class="legal"><a href="#">حریم خصوصی</a><a href="#">شرایط استفاده</a></div></div>
        </div>
      </div>
    </footer>

    <button class="to-top" id="toTop"><i class="fa-solid fa-arrow-up"></i></button>
    <a href="#contact" class="chat-fab" id="chatFab"><i class="fa-solid fa-comment-dots"></i></a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
  </body>
</html>