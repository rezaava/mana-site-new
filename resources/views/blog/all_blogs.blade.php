<!doctype html>
<html lang="fa" dir="rtl" data-theme="dark">
<head>
    <link rel="icon" type="image/x-icon" href="/img/mana.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وبلاگ | مانا</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/rastikerdar/estedad-font@v7.0.0/dist/font-face.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="/css/blog.css">
</head>
<body>
    <div class="cur-dot" id="curDot"></div>
    <div class="cur-ring" id="curRing"></div>
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- ============ HEADER ============ -->
    <header class="site-header" id="siteHeader">
        <div class="container-x nav-wrap">
            <a href="{{ url('/') }}" class="brand">
                <span class="mark">
                    <img src="/img/mana.png" alt="mana">
                </span>
            </a>
            <nav class="main-nav">
                <a href="{{ url('/') }}">خانه</a>
                <a href="{{ url('/#services') }}">خدمات</a>
                <a href="{{ url('/#folio') }}">نمونه‌کار</a>
                <a href="{{ url('/#team') }}">تیم</a>
                <a href="{{ url('/#contact') }}">تماس</a>
                <a href="{{ route('blogs.index') }}" class="active">وبلاگ</a>
            </nav>
            <div class="header-cta">
                <div class="theme-switch" id="themeSwitch">
                    <div class="knob">
                        <i class="fa-solid fa-moon" id="themeIcon"></i>
                    </div>
                </div>
                <a href="{{ url('/#contact') }}" class="btn-flow">
                    <i class="fa-solid fa-arrow-left"></i> مشاوره رایگان
                </a>
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
            <a href="{{ url('/') }}" data-close><i class="fa-solid fa-house"></i> خانه</a>
            <a href="{{ url('/#services') }}" data-close><i class="fa-solid fa-layer-group"></i> خدمات</a>
            <a href="{{ url('/#folio') }}" data-close><i class="fa-solid fa-briefcase"></i> نمونه‌کار</a>
            <a href="{{ url('/#team') }}" data-close><i class="fa-solid fa-people-group"></i> تیم</a>
            <a href="{{ route('blogs.index') }}" class="active" data-close><i class="fa-solid fa-pen-nib"></i> وبلاگ</a>
            <a href="{{ url('/#contact') }}" data-close><i class="fa-solid fa-phone"></i> تماس</a>
        </nav>
        <div class="foot">
            <div class="theme-switch" id="themeSwitchMobile">
                <div class="knob">
                    <i class="fa-solid fa-moon"></i>
                </div>
            </div>
            <a href="{{ url('/#contact') }}" class="btn-flow" data-close>
                مشاوره رایگان <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
    </div>

    <!-- ============ BLOG HERO ============ -->
    <section class="blog-hero">
        <div class="container-x">
            <div class="breadcrumb-x reveal in">
                <a href="{{ url('/') }}">خانه</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="cur">وبلاگ</span>
            </div>
            <span class="eyebrow reveal in">
                <i class="fa-solid fa-pen-nib"></i> وبلاگ مانا
            </span>
            <h1 class="reveal in">
                مقالات، راهنماها و
                <span class="grad-text">تجربه‌های فنی تیم ما</span>
            </h1>
            <p class="section-sub reveal in reveal-delay-1">
                آخرین یافته‌ها درباره‌ی هوش مصنوعی، طراحی محصول، توسعه‌ی نرم‌افزار و رشد دیجیتال کسب‌وکارها را اینجا بخوانید.
            </p>
            <div class="blog-search reveal in reveal-delay-2">
                <input type="text" id="searchInput" placeholder="جست‌وجو در مقالات...">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
    </section>

    <!-- ============ FEATURED POST ============ -->
    @if(isset($blogs) && $blogs->count() > 0)
        @php $featured = $blogs->first(); @endphp
        <section class="featured-wrap">
            <div class="container-x">
                <div class="featured-card reveal">
                    <div class="featured-visual">
                        <div class="deco"></div>
                        <span class="fbadge">مقاله ویژه</span>
                        <img src="{{ asset($featured->image ?? '/img/blog8.jpg') }}" alt="{{ $featured->title }}">
                    </div>
                    <div class="featured-body">
                        <span class="tag">{{ $featured->category ?? 'عمومی' }}</span>
                        <h2>{{ $featured->title }}</h2>
                        <p>{{ Str::limit(strip_tags($featured->content), 160) }}</p>
                        <div class="featured-meta">
                            <span>
                                <i class="fa-regular fa-calendar"></i>
                                {{ \Morilog\Jalali\Jalalian::fromDateTime($featured->created_at)->format('d F Y') }}
                            </span>
                            <span>
                                <i class="fa-regular fa-clock"></i>
                                {{ $featured->{'reading-time'} ?? 5 }} دقیقه مطالعه
                            </span>
                        </div>
                        <a href="{{ route('blogs.singleBlog', $featured->id) }}" class="btn-flow">
                            مطالعه مقاله <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ============ ARTICLES GRID ============ -->
    <section class="articles">
        <div class="container-x">
            <div class="art-grid" id="artGrid">
                @php $gradients = ['g1', 'g2', 'g3', 'g4', 'g5', 'g6', 'g7', 'g8', 'g9']; @endphp
                @foreach($blogs as $index => $blog)
                    <a href="{{ route('blogs.singleBlog', $blog->id) }}"
                       class="art-card"
                       data-cat="all"
                       data-title="{{ $blog->title }}">
                        <div class="art-thumb {{ $gradients[$index % count($gradients)] }}">
                            <span class="cat">{{ $blog->category ?? 'مقاله' }}</span>
                            <img src="{{ asset($blog->image ?? '/img/blog1.jpg') }}" alt="{{ $blog->title }}">
                        </div>
                        <div class="art-body">
                            <div class="art-meta">
                                <span>
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ \Morilog\Jalali\Jalalian::fromDateTime($blog->created_at)->format('d F Y') }}
                                </span>
                                <span>
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $blog->{'reading-time'} ?? 5 }} دقیقه
                                </span>
                            </div>
                            <h4>{{ Str::limit($blog->title, 45) }}</h4>
                            <p>{{ Str::limit(strip_tags($blog->content), 90) }}</p>
                            <span class="art-link">
                                مطالعه مقاله <i class="fa-solid fa-arrow-up-left"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ============ FINAL CTA ============ -->
    <section class="final-cta">
        <div class="container-x">
            <div class="cta-banner reveal">
                <h2>ایده‌ای برای پروژه‌ی بعدی‌تان دارید؟</h2>
                <p>تیم مانا آماده است تا در کنار شما، ایده را به یک محصول دیجیتال واقعی تبدیل کند.</p>
                <a href="{{ url('/#contact') }}" class="btn-flow">
                    شروع گفتگو <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ============ FOOTER ============ -->
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="container-x">
                <div class="footer-island reveal">
                    <div class="dots"></div>
                    <div class="footer-bottom">
                        <p>© ۲۰۲۶ مانا. تمامی حقوق محفوظ است.</p>
                        <div class="legal">
                            <a href="#">حریم خصوصی</a>
                            <a href="#">شرایط استفاده</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <button class="to-top" id="toTop">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="/js/blog.js"></script>
</body>
</html>