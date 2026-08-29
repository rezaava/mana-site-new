<!doctype html>
<html lang="fa" dir="rtl" data-theme="dark">
  <head>
     <link rel="icon" type="image/x-icon" href="/img/mana.png">
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>{{ \App\Models\SiteText::get('footer_brand', 'مانا') }} | راهکارهای هوشمند دیجیتال</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" >
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="{{asset('css/index.css')}}" />
  </head>
  <body>
    <div class="cur-dot" id="curDot"></div>
    <div class="cur-ring" id="curRing"></div>
    <div class="scroll-progress" id="scrollProgress"></div>

    <header class="site-header" id="siteHeader">
      <div class="container-x nav-wrap">
        <a href="#home" class="brand"><span class="mark"><img src="/img/mana.png" alt=""></span></a>
        <nav class="main-nav">
          <a href="#home" class="active">{{ \App\Models\SiteText::get('nav_home', 'خانه') }}</a>
          <a href="#services">{{ \App\Models\SiteText::get('services_badge', 'خدمات') }}</a>
          <a href="#folio">{{ \App\Models\SiteText::get('folio_badge', 'نمونه‌کار') }}</a>
          <a href="#team">{{ \App\Models\SiteText::get('team_badge', 'تیم') }}</a>
          <a href="#contact">{{ \App\Models\SiteText::get('contact_badge', 'تماس') }}</a>
          <a href="#blog">{{ \App\Models\SiteText::get('blog_nav', 'وبلاگ') }}</a>
        </nav>
        <div class="header-cta">
          <div class="theme-switch" id="themeSwitch"><div class="knob"><i class="fa-solid fa-moon" id="themeIcon"></i></div></div>
          <a href="#contact" class="btn-flow"><i class="fa-solid fa-arrow-left"></i> {{ \App\Models\SiteText::get('hero_cta', 'مشاوره رایگان') }}</a>
          <button class="burger" id="burgerBtn"><i class="fa-solid fa-bars"></i></button>
        </div>
      </div>
    </header>

    <div class="mnav-backdrop" id="mnavBackdrop"></div>
    <div class="mnav-panel" id="mnavPanel">
      <div class="mnav-handle"></div>
      <div class="top"><h6>{{ \App\Models\SiteText::get('nav_quick', 'منوی سریع') }}</h6><button class="burger" id="closeDrawer"><i class="fa-solid fa-xmark"></i></button></div>
      <nav>
        <a href="#home" class="active" data-close><i class="fa-solid fa-house"></i> {{ \App\Models\SiteText::get('nav_home', 'خانه') }}</a>
        <a href="#services" data-close><i class="fa-solid fa-layer-group"></i> {{ \App\Models\SiteText::get('services_badge', 'خدمات') }}</a>
        <a href="#folio" data-close><i class="fa-solid fa-briefcase"></i> {{ \App\Models\SiteText::get('folio_badge', 'نمونه‌کار') }}</a>
        <a href="#team" data-close><i class="fa-solid fa-people-group"></i> {{ \App\Models\SiteText::get('team_badge', 'تیم') }}</a>
        <a href="#blog" data-close><i class="fa-solid fa-pen-nib"></i> {{ \App\Models\SiteText::get('blog_nav', 'وبلاگ') }}</a>
        <a href="#contact" data-close><i class="fa-solid fa-phone"></i> {{ \App\Models\SiteText::get('contact_badge', 'تماس') }}</a>
      </nav>
      <div class="foot">
        <div class="theme-switch" id="themeSwitchMobile"><div class="knob"><i class="fa-solid fa-moon"></i></div></div>
        <a href="#contact" class="btn-flow" data-close>{{ \App\Models\SiteText::get('hero_cta', 'مشاوره رایگان') }} <i class="fa-solid fa-arrow-left"></i></a>
      </div>
    </div>

    <section class="hero" id="home">
      <div class="container-x">
        <div class="hero-grid">
          <div class="hero-text reveal in">
            <span class="eyebrow"><i class="fa-solid fa-sparkles"></i> {{ \App\Models\SiteText::get('hero_badge') }}</span>
            <h1>{{ \App\Models\SiteText::get('hero_title') }}</h1>
            <p class="lead-x">{{ \App\Models\SiteText::get('hero_desc') }}</p>
            <div class="hero-btns">
              <a href="#contact" class="btn-flow">{{ \App\Models\SiteText::get('hero_start', 'شروع پروژه') }} <i class="fa-solid fa-arrow-left"></i></a>
              <a href="#folio" class="btn-ghost"><i class="fa-solid fa-play"></i> {{ \App\Models\SiteText::get('hero_view', 'مشاهده نمونه‌کارها') }}</a>
            </div>
            <div class="hero-trust mb-4">
              <div class="avatar-stack"><span>ع.ک</span><span>ف.م</span><span>س.ا</span><span>+۵۰</span></div>
              <span>{{ \App\Models\SiteText::get('hero_trust') }}</span>
            </div>
          </div>
          <div class="hero-visual">
            <div class="orbit-ring r1"></div><div class="orbit-ring r2"></div>
            <div class="core-cube"><i class="fa-solid fa-cube"></i></div>
            <div class="float-chip c1"><i class="fa-solid fa-code"></i></div>
            <div class="float-chip c2"><i class="fa-solid fa-chart-line"></i></div>
            <div class="float-chip c3"><i class="fa-solid fa-cloud"></i></div>
            <div class="float-chip c4"><i class="fa-solid fa-shield-halved"></i></div>
          </div>
        </div>
      </div>
    </section>

    <div class="stat-strip-outer">
      <div class="container-x">
        <div class="stat-strip reveal">
          <div class="row g-3">
            <div class="col-6 col-md-3 stat-item"><h3><span class="count-num" data-target="{{ \App\Models\SiteText::get('stat1_num', '250') }}">۰</span><span class="grad-text">+</span></h3><span>{{ \App\Models\SiteText::get('stat1_text') }}</span></div>
            <div class="col-6 col-md-3 stat-item"><h3><span class="count-num" data-target="{{ \App\Models\SiteText::get('stat2_num', '98') }}">۰</span><span class="grad-text">%</span></h3><span>{{ \App\Models\SiteText::get('stat2_text') }}</span></div>
            <div class="col-6 col-md-3 stat-item"><h3><span class="count-num" data-target="{{ \App\Models\SiteText::get('stat3_num', '50') }}">۰</span><span class="grad-text">+</span></h3><span>{{ \App\Models\SiteText::get('stat3_text') }}</span></div>
            <div class="col-6 col-md-3 stat-item"><h3><span class="count-num" data-target="{{ \App\Models\SiteText::get('stat4_num', '24') }}">۰</span><span class="grad-text">/۷</span></h3><span>{{ \App\Models\SiteText::get('stat4_text') }}</span></div>
          </div>
        </div>
      </div>
    </div>

    <section class="services" id="services">
      <div class="container-x">
        <div class="services-head reveal">
          <div>
            <span class="eyebrow"><i class="fa-solid fa-layer-group"></i> {{ \App\Models\SiteText::get('services_badge') }}</span>
            <h2 class="section-title">{!! nl2br(e(\App\Models\SiteText::get('services_title'))) !!}</h2>
          </div>
          <p class="section-sub">{{ \App\Models\SiteText::get('services_sub') }}</p>
        </div>

        <div class="flow-wrap">
          <svg class="flow-svg" viewBox="0 0 1200 500" preserveAspectRatio="none">
            <path d="M0,250 C200,100 300,400 600,250 C900,100 1000,400 1200,250" stroke="url(#g1)" stroke-width="1.5" fill="none" />
            <defs>
              <linearGradient id="g1" x1="0" y1="0" x2="1" y2="0">
                <stop offset="0%" stop-color="#2f7dfb" />
                <stop offset="100%" stop-color="#17c3b2" />
              </linearGradient>
            </defs>
          </svg>

          <div class="svc-grid">
            @forelse($services as $index => $service)
              <div class="svc-card reveal reveal-delay-{{ $index % 3 + 1 }}" data-tilt>
                <span class="svc-num">{{ persianNum(str_pad($index + 1, 2, '0', STR_PAD_LEFT)) }}</span>
                <div class="svc-icon">
                  @if($service->image_url)
                    <img src="{{ asset('storage/' . $service->image_url) }}" style="width: 35px; height: 35px; object-fit: contain;">
                  @elseif($service->icon)
                    <i class="fa-solid {{ $service->icon }}"></i>
                  @else
                    <i class="fa-solid fa-layer-group"></i>
                  @endif
                </div>
                <h3>{{ $service->title }}</h3>
                <p>{!! nl2br(e(Str::limit($service->text, 150))) !!}</p>
              </div>
            @empty
              <p style="color: var(--text-dim); text-align: center; grid-column: 1/-1;">خدمتی یافت نشد</p>
            @endforelse
          </div>
        </div>
      </div>
    </section>

    <section class="why">
      <div class="container-x">
        <div class="row align-items-center g-4 why-grid">
          <div class="col-lg-5">
            <div class="why-visual reveal">
              <div class="why-photo"><img src="/img/mana1.png" alt=""></div>
              <div class="badge-float">
                <span class="num">{{ \App\Models\SiteText::get('exp_num') }}</span>
                <div>
                  <div style="font-size: 0.82rem; font-weight: 600">{{ \App\Models\SiteText::get('exp_title') }}</div>
                  <div style="font-size: 0.74rem; color: var(--text-dim)">{{ \App\Models\SiteText::get('exp_desc') }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <span class="eyebrow reveal"><i class="fa-solid fa-star"></i> {{ \App\Models\SiteText::get('why_badge') }}</span>
            <h2 class="section-title reveal reveal-delay-1">{{ \App\Models\SiteText::get('why_title') }}</h2>
            <ul class="why-list">
              <li class="reveal reveal-delay-1"><div class="ico"><i class="fa-solid fa-user-graduate"></i></div><div><h4>{{ \App\Models\SiteText::get('why1_title') }}</h4><p>{{ \App\Models\SiteText::get('why1_desc') }}</p></div></li>
              <li class="reveal reveal-delay-2"><div class="ico"><i class="fa-solid fa-medal"></i></div><div><h4>{{ \App\Models\SiteText::get('why2_title') }}</h4><p>{{ \App\Models\SiteText::get('why2_desc') }}</p></div></li>
              <li class="reveal reveal-delay-3"><div class="ico"><i class="fa-solid fa-headset"></i></div><div><h4>{{ \App\Models\SiteText::get('why3_title') }}</h4><p>{{ \App\Models\SiteText::get('why3_desc') }}</p></div></li>
              <li class="reveal reveal-delay-4"><div class="ico"><i class="fa-solid fa-tags"></i></div><div><h4>{{ \App\Models\SiteText::get('why4_title') }}</h4><p>{{ \App\Models\SiteText::get('why4_desc') }}</p></div></li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    @php
    $projects = \App\Models\Projects::all();
    @endphp

<section class="folio" id="folio">
  <div class="container-x">
    <div class="row align-items-end mb-4 reveal">
      <div class="col-md-8">
        <span class="eyebrow"><i class="fa-solid fa-briefcase"></i> {{ \App\Models\SiteText::get('folio_badge') }}</span>
        <h2 class="section-title">{{ \App\Models\SiteText::get('folio_title') }}</h2>
      </div>
      <div class="col-md-4"><p class="section-sub" style="margin-top: 12px">{{ \App\Models\SiteText::get('folio_sub') }}</p></div>
    </div>
    
    <div class="folio-shell reveal">
      {{-- تب‌های سمت راست (دسکتاپ) --}}
      <div class="folio-tabs" id="folioTabs">
        @foreach($projects as $index => $project)
          <div class="folio-tab {{ $loop->first ? 'active' : '' }}" data-project-id="{{ $project->id }}">
            <div class="ft-ic"><i class="{{ $project->icon ?? 'fa-solid fa-layer-group' }}"></i></div>
            <div>
              <h5>{{ $project->title }}</h5>
              <span>{{ $project->category ?? 'نمونه کار' }}</span>
            </div>
            <div class="bar"></div>
          </div>
        @endforeach
      </div>

      {{-- تب‌های موبایل --}}
      <div class="folio-mobile-tabs" id="folioMobileTabs">
        @foreach($projects as $index => $project)
          <button class="fmt-btn {{ $loop->first ? 'active' : '' }}" data-project-id="{{ $project->id }}">
            {{ $project->title }}
          </button>
        @endforeach
      </div>

      {{-- پیش‌نمایش کارت پروژه فعال --}}
      <div class="folio-preview" id="folioPreview">
        <div class="fp-dots" id="fpDots">
          @foreach($projects as $index => $project)
            <span class="dot {{ $loop->first ? 'active' : '' }}" data-project-id="{{ $project->id }}"></span>
          @endforeach
        </div>

        @foreach($projects as $index => $project)
          @php
            $imagePath = $project->image_url ?? $project->image ?? null;
            $imageUrl = $imagePath ? asset('storage/' . $imagePath) : asset('img/mana.png');
          @endphp
          <div class="fp-item {{ $loop->first ? 'active' : '' }}" id="project-card-{{ $project->id }}" data-project-id="{{ $project->id }}">
            <div class="fp-bg" style="background-image: url('{{ $imageUrl }}');"></div>
            <div class="fp-content">
              <span class="fp-cat">{{ $project->category ?? 'نمونه کار' }}</span>
              <h3 class="fp-title">{{ $project->title }}</h3>
              <p class="fp-desc">{{ Str::limit(strip_tags($project->description ?? $project->text ?? ''), 140) }}</p>
              
              <div class="fp-actions">
                <a href="{{ route('projects.show', $project->id) }}" class="btn-flow">
                  مشاهده جزئیات <i class="fa-solid fa-arrow-left"></i>
                </a>
                @if(!empty($project->link))
                  <a href="{{ $project->link }}" target="_blank" class="btn-ghost">
                    لینک مستقیم <i class="fa-solid fa-arrow-up-right-from-square"></i>
                  </a>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

    <section class="team" id="team">
      <div class="container-x">
        <div class="text-center mb-5 reveal">
          <span class="eyebrow"><i class="fa-solid fa-people-group"></i> {{ \App\Models\SiteText::get('team_badge') }}</span>
          <h2 class="section-title">{{ \App\Models\SiteText::get('team_title') }}</h2>
        </div>
        <div class="team-grid">
          @forelse($teams as $team)
            <div class="team-card reveal">
              <div class="team-ring">
                <div class="team-avatar tc1">
                  @if($team->image_url)
                    <img src="{{ asset('storage/' . $team->image_url) }}" alt="{{ $team->name }}">
                  @else
                    <img src="/img/contact5.jpg" alt="contect">
                  @endif
                  <div class="ov">
                    @if($team->linkedin)<a href="{{ $team->linkedin }}"><i class="fa-brands fa-linkedin-in"></i></a>@endif
                    @if($team->instagram)<a href="{{ $team->instagram }}"><i class="fa-brands fa-instagram"></i></a>@endif
                    @if($team->telegram)<a href="{{ $team->telegram }}"><i class="fa-brands fa-telegram"></i></a>@endif
                    @if($team->github)<a href="{{ $team->github }}"><i class="fa-brands fa-github"></i></a>@endif
                    @if($team->twitter)<a href="{{ $team->twitter }}"><i class="fa-brands fa-twitter"></i></a>@endif
                    @if($team->whatsapp)<a href="{{ $team->whatsapp }}"><i class="fa-brands fa-whatsapp"></i></a>@endif
                  </div>
                </div>
              </div>
              <h4>{{ $team->name }}</h4>
              <p>{{ $team->title }}</p>
            </div>
          @empty
            <p style="color: var(--text-dim); text-align: center; grid-column: 1/-1;">عضوی یافت نشد</p>
          @endforelse
        </div>
      </div>
    </section>

    <section class="testi">
      <div class="container-x">
        <div class="testi-track">
          @forelse($comments as $comment)
            <div class="testi-card reveal">
              <i class="fa-solid fa-quote-right quote"></i>
              <p>{{ $comment->content }}</p>
              <div class="testi-person">
                <div class="av" style="background: linear-gradient(135deg, var(--brand), var(--accent-2));">{{ Str::substr($comment->user_name, 0, 2) }}</div>
                <div><h5>{{ $comment->user_name }}</h5><span>مشتری</span></div>
              </div>
            </div>
          @empty
            <p style="color: var(--text-dim); text-align: center;">نظری ثبت نشده</p>
          @endforelse
        </div>
      </div>
    </section>

    <section class="faqc" id="contact">
  <div class="container-x">
    <div class="row g-4">
      <div class="col-lg-6">
        <span class="eyebrow reveal"><i class="fa-solid fa-circle-question"></i> {{ \App\Models\SiteText::get('faq_badge') }}</span>
        <h2 class="section-title reveal reveal-delay-1 mb-4">{{ \App\Models\SiteText::get('faq_title') }}</h2>
        <div class="acc-list">
          @forelse($questions as $index => $question)
            <div class="acc-item {{ $loop->first ? 'open' : '' }} reveal reveal-delay-{{ $index % 4 }}">
              <button class="acc-btn">
                {{ $question->title }}
                <i class="fa-solid fa-plus"></i>
              </button>
              <div class="acc-panel">
                <p>{!! nl2br(e($question->answer)) !!}</p>
              </div>
            </div>
          @empty
            <p style="color: var(--text-dim);">سوالی یافت نشد.</p>
          @endforelse
        </div>
      </div>
      <div class="col-lg-6">
        <div class="contact-card reveal reveal-delay-2">
          <span class="eyebrow"><i class="fa-solid fa-paper-plane"></i> {{ \App\Models\SiteText::get('contact_badge') }}</span>
          <h3 style="font-weight: 800; font-size: 1.5rem; margin-bottom: 6px">{{ \App\Models\SiteText::get('contact_title') }}</h3>
          <p class="section-sub" style="margin-bottom: 26px">{{ \App\Models\SiteText::get('contact_sub') }}</p>
          <form onsubmit="return false;">
            <div class="row"><div class="col-sm-6"><input class="form-control-x" placeholder="نام و نام‌خانوادگی" /></div><div class="col-sm-6"><input class="form-control-x" placeholder="شماره تماس" /></div></div>
            <input class="form-control-x" placeholder="ایمیل" /><textarea class="form-control-x" placeholder="شرح پروژه شما"></textarea>
            <button class="btn-flow w-100 justify-content-center" style="border: none">{{ \App\Models\SiteText::get('contact_btn') }} <i class="fa-solid fa-paper-plane"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- ============ BLOG ============ -->
<section class="blog" id="blog">
  <div class="container-x">
    <div class="blog-shell">
      <span class="blob b1"></span><span class="blob b2"></span><span class="blob b3"></span>
      <div class="blog-top reveal">
        <div class="blog-avatar"><i class="fa-solid fa-pen-nib"></i></div>
        <div>
          <h2 class="section-title" style="margin-bottom: 6px; color: #fff;">
  @php
    $fullTitle = \App\Models\SiteText::get('blog_title', 'مقالات و نکات دنیای دیجیتال');
    $words = explode(' ', $fullTitle);
    if (count($words) >= 2) {
        $lastTwo = array_splice($words, -2);
        $firstPart = implode(' ', $words);
        $styledLastTwo = implode(' ', $lastTwo);
    } else {
        $firstPart = $fullTitle;
        $styledLastTwo = '';
    }
  @endphp

  {{ $firstPart }}
  @if($styledLastTwo)
    <span style="background: linear-gradient(135deg, #00f2fe 0%, #4facfe 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
      {{ $styledLastTwo }}
    </span>
  @endif
</h2>
          <p class="section-sub" style="margin-bottom: 0">
            {{ \App\Models\SiteText::get('blog_sub', 'آخرین یافته‌ها، راهنماها و تجربیات تیم فنی') }}
          </p>
        </div>
      </div>

      <div class="blog-layout">
        <div class="blog-list reveal">
          @forelse($blogs->take(4) as $blog)
            <a href="{{ route('blogs.singleBlog', $blog->id) }}" class="blog-list-item">
              {{ Str::limit($blog->title, 50) }}
              <span class="arr"><i class="fa-solid fa-arrow-up-left"></i></span>
            </a>
          @empty
            <p style="color: var(--text-dim);">مقاله‌ای ثبت نشده</p>
          @endforelse
        </div>

        @php 
          $featuredBlog = $blogs->skip(4)->first() ?? $blogs->first(); 
        @endphp
        @if($featuredBlog)
          <div class="blog-feature reveal reveal-delay-1">
            <div class="deco">
              <img src="{{ $featuredBlog->image_url ? asset('storage/' . $featuredBlog->image_url) : asset('img/mana2.jpg') }}" alt="{{ $featuredBlog->title }}">
            </div>
            <div class="blog-feature-inner">
              <div class="meta">
                <i class="fa-regular fa-clock"></i> زمان مطالعه: {{ $featuredBlog->{'reading-time'} ?? 5 }} دقیقه
              </div>
              <h5>{{ Str::limit($featuredBlog->title, 60) }}</h5>
              <a href="{{ route('blogs.singleBlog', $featuredBlog->id) }}" class="pill">
                مطالعه مقاله <i class="fa-solid fa-arrow-up-left"></i>
              </a>
            </div>
          </div>
        @endif

        <div class="blog-side">
          @php 
            $sideBlogs = $blogs->count() > 5 ? $blogs->skip(5)->take(2) : $blogs->take(2); 
          @endphp

          @foreach($sideBlogs as $index => $blog)
            <div class="blog-side-card reveal reveal-delay-{{ $index + 2 }}">
              <div class="thumb {{ $loop->first ? 'a' : 'b' }}">
                <i class="fa-solid {{ $loop->first ? 'fa-robot' : 'fa-mobile-screen' }}"></i>
              </div>
              <a href="{{ route('blogs.singleBlog', $blog->id) }}">
                <div>
                  <span class="tag">مقاله</span>
                  <h6>{{ Str::limit($blog->title, 40) }}</h6>
                  <span class="time">{{ $blog->{'reading-time'} ?? 5 }} دقیقه مطالعه</span>
                </div>
              </a>
            </div>
          @endforeach
        </div>
      </div>

      <div class="blog-more reveal">
        <a href="{{ route('blogs.all_blogs') }}" class="btn-ghost">
          {{ \App\Models\SiteText::get('blog_more', 'مشاهده همه مقالات') }} <i class="fa-solid fa-arrow-left"></i>
        </a>
      </div>
    </div>
  </div>
</section>

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
              <div class="footer-col"><h5>{{ \App\Models\SiteText::get('footer_links') }}</h5><ul><li><a href="#home"><i class="fa-solid fa-caret-left"></i> خانه</a></li><li><a href="#folio"><i class="fa-solid fa-caret-left"></i> نمونه‌کارها</a></li><li><a href="#team"><i class="fa-solid fa-caret-left"></i> تیم ما</a></li><li><a href="#contact"><i class="fa-solid fa-caret-left"></i> تماس با ما</a></li><li><a href="#blog"><i class="fa-solid fa-caret-left"></i> وبلاگ</a></li></ul></div>
              <div class="footer-col footer-center"><a href="#home" class="footer-brand">{{ \App\Models\SiteText::get('footer_brand') }}</a><p class="footer-tag">{{ \App\Models\SiteText::get('footer_tag') }}</p><div class="footer-social"><a href="#"><i class="fa-brands fa-telegram"></i></a><a href="#"><i class="fa-brands fa-instagram"></i></a><a href="#"><i class="fa-brands fa-whatsapp"></i></a><a href="#"><i class="fa-brands fa-x-twitter"></i></a><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></div></div>
              <div class="footer-col"><h5>{{ \App\Models\SiteText::get('footer_services') }}</h5><ul><li><a href="#services"><i class="fa-solid fa-caret-left"></i> هوش مصنوعی</a></li><li><a href="#services"><i class="fa-solid fa-caret-left"></i> طراحی وب‌سایت</a></li><li><a href="#services"><i class="fa-solid fa-caret-left"></i> اپلیکیشن موبایل</a></li><li><a href="#services"><i class="fa-solid fa-caret-left"></i> زیرساخت ابری</a></li><li><a href="tel:02117545678"><i class="fa-solid fa-phone"></i> ۰۲۱-۱۷۵۴۵۶۷۸</a></li></ul></div>
            </div>
            <div class="footer-badges"><div class="fb-item"><i class="fa-solid fa-shield-halved"></i> {{ \App\Models\SiteText::get('badge1') }}</div><div class="fb-item"><i class="fa-solid fa-headset"></i> {{ \App\Models\SiteText::get('badge2') }}</div><div class="fb-item"><i class="fa-solid fa-bolt"></i> {{ \App\Models\SiteText::get('badge3') }}</div><div class="fb-item"><i class="fa-solid fa-tags"></i> {{ \App\Models\SiteText::get('badge4') }}</div></div>
          </div>
          <div class="footer-bottom"><p>{{ \App\Models\SiteText::get('copyright') }}</p><div class="legal"><a href="#">حریم خصوصی</a><a href="#">شرایط استفاده</a></div></div>
        </div>
      </div>
    </footer>

    <button class="to-top" id="toTop"><i class="fa-solid fa-arrow-up"></i></button>
    <a href="#contact" class="chat-fab" id="chatFab"><i class="fa-solid fa-comment-dots"></i></a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>
  </body>
</html>