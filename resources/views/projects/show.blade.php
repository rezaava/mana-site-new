<!doctype html>
<html lang="fa" dir="rtl" data-theme="dark">
  <head>
    <link rel="icon" type="image/x-icon" href="/img/mana.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }} | {{ \App\Models\SiteText::get('footer_brand', 'مانا') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
  </head>
  <body>
    <div class="cur-dot" id="curDot"></div>
    <div class="cur-ring" id="curRing"></div>
    <div class="scroll-progress" id="scrollProgress"></div>

    {{-- Header --}}
    <header class="site-header" id="siteHeader">
      <div class="container-x nav-wrap">
        <a href="{{ url('/') }}" class="brand"><span class="mark"><img src="/img/mana.png" alt=""></span></a>
        <nav class="main-nav">
          <a href="{{ url('/') }}#home">{{ \App\Models\SiteText::get('nav_home', 'خانه') }}</a>
          <a href="{{ url('/') }}#services">{{ \App\Models\SiteText::get('services_badge', 'خدمات') }}</a>
          <a href="{{ url('/') }}#folio" class="active">{{ \App\Models\SiteText::get('folio_badge', 'نمونه‌کار') }}</a>
          <a href="{{ url('/') }}#team">{{ \App\Models\SiteText::get('team_badge', 'تیم') }}</a>
          <a href="{{ url('/') }}#contact">{{ \App\Models\SiteText::get('contact_badge', 'تماس') }}</a>
          <a href="{{ url('/') }}#blog">{{ \App\Models\SiteText::get('blog_nav', 'وبلاگ') }}</a>
        </nav>
        <div class="header-cta">
          <div class="theme-switch" id="themeSwitch"><div class="knob"><i class="fa-solid fa-moon" id="themeIcon"></i></div></div>
          <a href="{{ url('/') }}#contact" class="btn-flow"><i class="fa-solid fa-arrow-left"></i> {{ \App\Models\SiteText::get('hero_cta', 'مشاوره رایگان') }}</a>
          <button class="burger" id="burgerBtn"><i class="fa-solid fa-bars"></i></button>
        </div>
      </div>
    </header>

    {{-- Mobile Navigation --}}
    <div class="mnav-backdrop" id="mnavBackdrop"></div>
    <div class="mnav-panel" id="mnavPanel">
      <div class="mnav-handle"></div>
      <div class="top"><h6>{{ \App\Models\SiteText::get('nav_quick', 'منوی سریع') }}</h6><button class="burger" id="closeDrawer"><i class="fa-solid fa-xmark"></i></button></div>
      <nav>
        <a href="{{ url('/') }}#home" data-close><i class="fa-solid fa-house"></i> {{ \App\Models\SiteText::get('nav_home', 'خانه') }}</a>
        <a href="{{ url('/') }}#services" data-close><i class="fa-solid fa-layer-group"></i> {{ \App\Models\SiteText::get('services_badge', 'خدمات') }}</a>
        <a href="{{ url('/') }}#folio" class="active" data-close><i class="fa-solid fa-briefcase"></i> {{ \App\Models\SiteText::get('folio_badge', 'نمونه‌کار') }}</a>
        <a href="{{ url('/') }}#team" data-close><i class="fa-solid fa-people-group"></i> {{ \App\Models\SiteText::get('team_badge', 'تیم') }}</a>
        <a href="{{ url('/') }}#blog" data-close><i class="fa-solid fa-pen-nib"></i> {{ \App\Models\SiteText::get('blog_nav', 'وبلاگ') }}</a>
        <a href="{{ url('/') }}#contact" data-close><i class="fa-solid fa-phone"></i> {{ \App\Models\SiteText::get('contact_badge', 'تماس') }}</a>
      </nav>
      <div class="foot">
        <div class="theme-switch" id="themeSwitchMobile"><div class="knob"><i class="fa-solid fa-moon"></i></div></div>
        <a href="{{ url('/') }}#contact" class="btn-flow" data-close>{{ \App\Models\SiteText::get('hero_cta', 'مشاوره رایگان') }} <i class="fa-solid fa-arrow-left"></i></a>
      </div>
    </div>

    {{-- Project Hero / Breadcrumb --}}
    <section class="hero" style="min-height: auto; padding: 140px 0 60px;">
      <div class="container-x">
        <div class="reveal in">
          <span class="eyebrow">
            <i class="fa-solid fa-briefcase"></i> {{ $project->category->name ?? $project->category ?? \App\Models\SiteText::get('folio_badge', 'نمونه‌کار') }}
          </span>
          <h1 style="font-size: 2.5rem; font-weight: 800; margin-top: 15px;">{{ $project->title }}</h1>
          @if(!empty($project->brief))
            <p class="lead-x" style="max-width: 800px; margin-top: 15px;">{{ $project->brief }}</p>
          @endif
        </div>
      </div>
    </section>

    {{-- Main Project Details Section --}}
    <section class="project-details" style="padding: 40px 0 100px;">
      <div class="container-x">
        <div class="row g-4">
          
          {{-- Main Image & Description --}}
          <div class="col-lg-8">
            <div class="reveal mb-4">
              @php
                $mainImagePath = $project->image_url ?? $project->image ?? null;
                $mainImageUrl = $mainImagePath ? asset('storage/' . $mainImagePath) : asset('img/mana.png');
              @endphp
              <div style="border-radius: 20px; overflow: hidden; border: 1px solid var(--border-color); background: var(--card-bg);">
                <img src="{{ $mainImageUrl }}" alt="{{ $project->title }}" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
              </div>
            </div>

            <div class="reveal mb-5" style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 20px; padding: 30px;">
              <h3 style="font-weight: 700; margin-bottom: 20px; font-size: 1.5rem;">توضیحات پروژه</h3>
              <div style="color: var(--text-dim); line-height: 1.9; font-size: 1.05rem;">
                {!! nl2br(e($project->desc ?? $project->description ?? $project->text ?? 'توضیحاتی برای این پروژه ثبت نشده است.')) !!}
              </div>
            </div>

            {{-- Project Gallery Images --}}
            @if(isset($images) && count($images) > 0)
              <div class="reveal mb-5">
                <h4 style="font-weight: 700; margin-bottom: 20px;">تصاویر پروژه</h4>
                <div class="row g-3">
                  @foreach($images as $img)
                    <div class="col-md-6">
                      <div style="border-radius: 15px; overflow: hidden; border: 1px solid var(--border-color);">
                        <img src="{{ asset('storage/' . $img->url) }}" alt="تصویر پروژه" class="img-fluid w-100" style="height: 220px; object-fit: cover;">
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif

            {{-- Project Features --}}
            @if(isset($features) && count($features) > 0)
              <div class="reveal mb-5">
                <h4 style="font-weight: 700; margin-bottom: 20px;">ویژگی‌های کلیدی پروژه</h4>
                <ul class="why-list">
                  @foreach($features as $index => $feature)
                    <li class="reveal reveal-delay-{{ $index % 4 + 1 }}">
                      <div class="ico"><i class="fa-solid fa-check"></i></div>
                      <div>
                        <p style="margin: 0; font-weight: 600; color: var(--text-main);">{{ $feature->text }}</p>
                      </div>
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>

          {{-- Sidebar Meta Information --}}
          <div class="col-lg-4">
            <div class="reveal" style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 20px; padding: 30px; position: sticky; top: 100px;">
              <h4 style="font-weight: 700; margin-bottom: 25px; font-size: 1.3rem;">اطلاعات شناسنامه‌ای</h4>
              
              <ul style="list-style: none; padding: 0; margin: 0 0 30px 0;">
                <li style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--border-color);">
                  <span style="color: var(--text-dim);"><i class="fa-solid fa-folder me-2"></i> دسته‌بندی:</span>
                  <span style="font-weight: 600;">{{ $project->category->name ?? $project->category ?? 'عمومی' }}</span>
                </li>
                @if(!empty($project->created_at))
                  <li style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--border-color);">
                    <span style="color: var(--text-dim);"><i class="fa-solid fa-calendar me-2"></i> تاریخ انتشار:</span>
                    <span style="font-weight: 600;">{{ \Morilog\Jalali\Jalalian::fromCarbon($project->created_at)->format('Y/m/d') }}</span>
                  </li>
                @endif
              </ul>

              @if(!empty($project->link))
                <a href="{{ $project->link }}" target="_blank" class="btn-flow w-100 justify-content-center mb-3">
                  مشاهده آنلاین پروژه <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                </a>
              @endif

              <a href="{{ url('/') }}#contact" class="btn-ghost w-100 justify-content-center">
                سفارش پروژه مشابه <i class="fa-solid fa-headset ms-2"></i>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>

   

    {{-- Footer --}}
    <footer class="site-footer">
      <div class="footer-inner">
        <div class="container-x">
          <div class="footer-island reveal">
            <div class="dots"></div>
            <div class="footer-newsletter">
              <div class="fn-text">
                <div class="fn-ic"><i class="fa-solid fa-envelope-open-text"></i></div>
                <div><strong>{{ \App\Models\SiteText::get('newsletter_title') }}</strong><span class="sub">{{ \App\Models\SiteText::get('newsletter_sub') }}</span></div>
              </div>
              <form onsubmit="return false;"><input type="email" placeholder="آدرس ایمیل شما..." /><button type="submit">ارسال</button></form>
            </div>
            <div class="footer-3col">
              <div class="footer-col">
                <h5>{{ \App\Models\SiteText::get('footer_links') }}</h5>
                <ul>
                  <li><a href="{{ url('/') }}#home"><i class="fa-solid fa-caret-left"></i> خانه</a></li>
                  <li><a href="{{ url('/') }}#folio"><i class="fa-solid fa-caret-left"></i> نمونه‌کارها</a></li>
                  <li><a href="{{ url('/') }}#team"><i class="fa-solid fa-caret-left"></i> تیم ما</a></li>
                  <li><a href="{{ url('/') }}#contact"><i class="fa-solid fa-caret-left"></i> تماس با ما</a></li>
                  <li><a href="{{ url('/') }}#blog"><i class="fa-solid fa-caret-left"></i> وبلاگ</a></li>
                </ul>
              </div>
              <div class="footer-col footer-center">
                <a href="{{ url('/') }}#home" class="footer-brand">{{ \App\Models\SiteText::get('footer_brand') }}</a>
                <p class="footer-tag">{{ \App\Models\SiteText::get('footer_tag') }}</p>
                <div class="footer-social">
                  <a href="#"><i class="fa-brands fa-telegram"></i></a>
                  <a href="#"><i class="fa-brands fa-instagram"></i></a>
                  <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                  <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                  <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
              </div>
              <div class="footer-col">
                <h5>{{ \App\Models\SiteText::get('footer_services') }}</h5>
                <ul>
                  <li><a href="{{ url('/') }}#services"><i class="fa-solid fa-caret-left"></i> هوش مصنوعی</a></li>
                  <li><a href="{{ url('/') }}#services"><i class="fa-solid fa-caret-left"></i> طراحی وب‌سایت</a></li>
                  <li><a href="{{ url('/') }}#services"><i class="fa-solid fa-caret-left"></i> اپلیکیشن موبایل</a></li>
                  <li><a href="{{ url('/') }}#services"><i class="fa-solid fa-caret-left"></i> زیرساخت ابری</a></li>
                  <li><a href="tel:02117545678"><i class="fa-solid fa-phone"></i> ۰۲۱-۱۷۵۴۵۶۷۸</a></li>
                </ul>
              </div>
            </div>
            <div class="footer-badges">
              <div class="fb-item"><i class="fa-solid fa-shield-halved"></i> {{ \App\Models\SiteText::get('badge1') }}</div>
              <div class="fb-item"><i class="fa-solid fa-headset"></i> {{ \App\Models\SiteText::get('badge2') }}</div>
              <div class="fb-item"><i class="fa-solid fa-bolt"></i> {{ \App\Models\SiteText::get('badge3') }}</div>
              <div class="fb-item"><i class="fa-solid fa-tags"></i> {{ \App\Models\SiteText::get('badge4') }}</div>
            </div>
          </div>
          <div class="footer-bottom">
            <p>{{ \App\Models\SiteText::get('copyright') }}</p>
            <div class="legal"><a href="#">حریم خصوصی</a><a href="#">شرایط استفاده</a></div>
          </div>
        </div>
      </div>
    </footer>

    <button class="to-top" id="toTop"><i class="fa-solid fa-arrow-up"></i></button>
    <a href="{{ url('/') }}#contact" class="chat-fab" id="chatFab"><i class="fa-solid fa-comment-dots"></i></a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
  </body>
</html>