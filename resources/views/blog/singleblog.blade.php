@extends('layout.master')

@section('title')
    {{ $blog->title }} | {{ $siteTexts['footer_brand']->value ?? 'مانا' }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/singleblog.css') }}">
@endsection

@section('main')

    <!-- ============ HERO SINGLE POST ============ -->
    <section class="single-hero">
        <div class="container-x">

            <!-- Meta -->
            <div class="post-meta-top reveal in">

                @if($blog->category)
                    <span class="cat-tag">
                        {{ $blog->category->name }}
                    </span>
                @endif

                <span>
                    <i class="fa-regular fa-calendar"></i>

                    {{ verta($blog->created_at)->format('d F Y') }}
                </span>

                @if($blog->{'reading-time'})
                    <span>
                        <i class="fa-regular fa-clock"></i>

                        {{ $blog->{'reading-time'} }}
                        دقیقه مطالعه
                    </span>
                @endif

                <span>
                    <i class="fa-regular fa-eye"></i>

                    {{ number_format($blog->number ?? 0) }}
                    بازدید
                </span>

                <span>
                    <i
                        class="fa-regular fa-heart"
                        style="color: var(--accent); cursor: pointer"
                        id="likeBtn"
                    ></i>

                    ۰
                </span>

            </div>

            <!-- Title -->
            <h1 class="reveal in">
                {{ $blog->title }}
            </h1>

            <!-- Description -->
            <p
                class="section-sub reveal in reveal-delay-1"
                style="max-width: 700px"
            >
                {{ \Illuminate\Support\Str::limit(strip_tags($blog->text), 250) }}
            </p>

            <!-- Author -->
            <div class="single-author-box reveal in reveal-delay-2">

                <div class="avatar">
                    <img
                        src="{{ asset('img/contect3.jpg') }}"
                        alt="مانا"
                    >
                </div>

                <div class="info">
                    <h5>
                        تیم مانا
                    </h5>

                    <p>
                        تیم مانا | ارائه‌دهنده خدمات طراحی و توسعه محصولات دیجیتال
                    </p>
                </div>

                <div class="social-links">

                    <a href="#">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>

                    <a href="#">
                        <i class="fa-brands fa-twitter"></i>
                    </a>

                    <a href="#">
                        <i class="fa-brands fa-telegram"></i>
                    </a>

                </div>

            </div>

        </div>
    </section>


    <!-- ============ CONTENT + SIDEBAR ============ -->
    <section style="padding: 20px 0 60px">

        <div class="container-x">

            <div class="row g-5">

                <!-- ===== MAIN CONTENT ===== -->
                <div class="col-lg-8">

                    <div class="post-body reveal">

                        {{-- تصویر اصلی مقاله --}}
                        @if($blog->image_url)

                            <div class="post-img">

                                <img
                                    src="{{ asset('storage/' . $blog->image_url) }}"
                                    alt="{{ $blog->title }}"
                                >

                                <div class="caption">
                                    <i class="fa-regular fa-image"></i>

                                    {{ $blog->title }}
                                </div>

                            </div>

                        @endif


                        {{-- متن کامل مقاله --}}
                        {!! $blog->text !!}


                        <!-- ===== تگ‌های مقاله ===== -->
                        @if($blog->tags->count())

                            <div class="post-tags">

                                @foreach($blog->tags as $tag)

                                    <a href="#">
                                        {{ $tag->text }}
                                    </a>

                                @endforeach

                            </div>

                        @endif


                        <!-- ===== اشتراک‌گذاری ===== -->
                        <div class="share-bar">

                            <span>
                                <i class="fa-regular fa-share-from-square"></i>
                                اشتراک‌گذاری:
                            </span>

                            <a
                                href="https://t.me/share/url?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                                class="telegram"
                                target="_blank"
                            >
                                <i class="fa-brands fa-telegram"></i>
                            </a>

                            <a
                                href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                                class="twitter"
                                target="_blank"
                            >
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>

                            <a
                                href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                class="linkedin"
                                target="_blank"
                            >
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>

                            <a
                                href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}"
                                class="whatsapp"
                                target="_blank"
                            >
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>

                        </div>

                    </div>


                    <!-- ===== نظرات ===== -->
                    <div class="comments-section" id="comments">

                        <div class="section-title-sm">

                            <i class="fa-regular fa-comment-dots"></i>

                            نظرات

                            (<span id="commentCount">۰</span>)

                        </div>


                        <div id="commentList">

                            <div class="comment-item">

                                <div
                                    class="cav"
                                    style="
                                        background: linear-gradient(
                                            135deg,
                                            var(--brand),
                                            var(--accent-2)
                                        );
                                    "
                                >
                                    م
                                </div>

                                <div class="cbody">

                                    <h6>
                                        هنوز نظری ثبت نشده است
                                    </h6>

                                    <p>
                                        اولین نفری باشید که درباره این مقاله نظر می‌دهد.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <!-- ===== فرم نظر ===== -->
                        <div class="comment-form" id="commentForm">

                            <h5 style="font-weight: 700; margin-bottom: 20px">

                                <i
                                    class="fa-regular fa-pen-to-square"
                                    style="color: var(--accent-2)"
                                ></i>

                                نظر خود را بنویسید

                            </h5>


                            <form onsubmit="return false;">

                                <div class="row">

                                    <div class="col-sm-6">

                                        <input
                                            type="text"
                                            id="commentName"
                                            placeholder="نام و نام‌خانوادگی"
                                            required
                                        >

                                    </div>


                                    <div class="col-sm-6">

                                        <input
                                            type="email"
                                            id="commentEmail"
                                            placeholder="ایمیل"
                                            required
                                        >

                                    </div>

                                </div>


                                <textarea
                                    id="commentText"
                                    placeholder="متن نظر شما..."
                                    required
                                ></textarea>


                                <button
                                    class="btn-flow mt-3"
                                    id="submitComment"
                                    style="border: none"
                                >
                                    ارسال نظر

                                    <i class="fa-solid fa-arrow-left"></i>

                                </button>

                            </form>


                            <div
                                id="commentSuccess"
                                style="
                                    display: none;
                                    margin-top: 16px;
                                    color: var(--accent-2);
                                    font-weight: 600;
                                "
                            >

                                <i class="fa-regular fa-circle-check"></i>

                                نظر شما با موفقیت ثبت شد!

                            </div>

                        </div>

                    </div>

                </div>


                <!-- ===== SIDEBAR ===== -->
                <div class="col-lg-4">


                    <!-- ===== مقالات مرتبط ===== -->
                    <div class="sidebar-card reveal">

                        <h5>
                            <i class="fa-solid fa-link"></i>
                            مقالات مرتبط
                        </h5>


                        @php

                            $relatedBlogs = \App\Models\Blogs::with('category')
                                ->where('id', '!=', $blog->id)
                                ->when(
                                    $blog->cat_id,
                                    function ($query) use ($blog) {
                                        $query->where('cat_id', $blog->cat_id);
                                    }
                                )
                                ->latest()
                                ->limit(3)
                                ->get();

                        @endphp


                        @forelse($relatedBlogs as $relatedBlog)

                            <a
                                href="{{ route('singleBlog', $relatedBlog->id) }}"
                                style="text-decoration: none; color: inherit"
                            >

                                <div class="related-item mb-3">

                                    <div class="thumb t1">

                                        @if($relatedBlog->image_url)

                                            <img
                                                src="{{ asset('storage/' . $relatedBlog->image_url) }}"
                                                alt="{{ $relatedBlog->title }}"
                                            >

                                        @else

                                            <img
                                                src="{{ asset('img/blog1.jpg') }}"
                                                alt="{{ $relatedBlog->title }}"
                                            >

                                        @endif

                                    </div>


                                    <div class="rinfo">

                                        <h6>
                                            {{ $relatedBlog->title }}
                                        </h6>

                                        @if($relatedBlog->{'reading-time'})

                                            <span>
                                                {{ $relatedBlog->{'reading-time'} }}
                                                دقیقه مطالعه
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </a>

                        @empty

                            <p style="color: var(--text-dim)">
                                مقاله مرتبطی وجود ندارد.
                            </p>

                        @endforelse

                    </div>


                    <!-- ===== دسته‌بندی‌ها ===== -->
                    <div class="sidebar-card reveal reveal-delay-1">

                        <h5>
                            <i class="fa-solid fa-layer-group"></i>
                            دسته‌بندی‌ها
                        </h5>


                        <div class="sidebar-cat-list">

                            @php

                                $categories = \App\Models\Categories::withCount('blogs')
                                    ->get();

                            @endphp


                            @foreach($categories as $category)

                                <a href="#">

                                    {{ $category->name }}

                                    <span>
                                        {{ $category->blogs_count }}
                                    </span>

                                </a>

                            @endforeach

                        </div>

                    </div>


                    <!-- ===== برچسب‌ها ===== -->
                    <div class="sidebar-card reveal reveal-delay-2">

                        <h5>
                            <i class="fa-solid fa-tags"></i>
                            برچسب‌ها
                        </h5>


                        <div
                            class="tag-cloud"
                            style="
                                display: flex;
                                flex-wrap: wrap;
                                gap: 8px;
                            "
                        >

                            @forelse($blog->tags as $tag)

                                <a
                                    href="#"
                                    style="
                                        padding: 8px 15px;
                                        border-radius: 99px;
                                        background: var(--surface-2);
                                        border: 1px solid var(--line);
                                        font-size: 0.78rem;
                                        color: var(--text-dim);
                                        text-decoration: none;
                                        transition: 0.3s;
                                    "
                                >
                                    {{ $tag->text }}
                                </a>

                            @empty

                                <span style="color: var(--text-dim)">
                                    برچسبی برای این مقاله ثبت نشده است.
                                </span>

                            @endforelse

                        </div>

                    </div>


                    <!-- ===== خبرنامه ===== -->
                    <div
                        class="sidebar-card reveal reveal-delay-3"
                        style="
                            background: linear-gradient(
                                135deg,
                                color-mix(in srgb, var(--brand) 15%, transparent),
                                color-mix(in srgb, var(--accent-2) 10%, transparent)
                            );

                            border-color: color-mix(
                                in srgb,
                                var(--accent-2) 30%,
                                transparent
                            );
                        "
                    >

                        <h5>

                            <i class="fa-solid fa-envelope"></i>

                            خبرنامه

                        </h5>


                        <p
                            style="
                                font-size: 0.85rem;
                                color: var(--text-dim);
                                margin-bottom: 16px;
                            "
                        >
                            جدیدترین مقالات رو یک‌بار در هفته دریافت کن.
                        </p>


                        <form
                            onsubmit="return false;"
                            style="display: flex; gap: 8px"
                        >

                            <input
                                type="email"
                                placeholder="ایمیل شما"
                                style="
                                    flex: 1;
                                    background: var(--bg);
                                    border: 1px solid var(--line);
                                    border-radius: 99px;
                                    padding: 10px 16px;
                                    color: var(--text);
                                    font-family: inherit;
                                    font-size: 0.82rem;
                                "
                            >


                            <button
                                style="
                                    background: var(--accent-2);
                                    color: var(--oncta);
                                    border: none;
                                    border-radius: 99px;
                                    padding: 10px 16px;
                                    font-weight: 700;
                                    font-size: 0.82rem;
                                    white-space: nowrap;
                                "
                            >
                                عضویت
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- ============ FINAL CTA ============ -->
    <section class="final-cta">

        <div class="container-x">

            <div class="cta-banner reveal">

                <h2>
                    ایده‌ای برای پروژه‌ی بعدی‌تان دارید؟
                </h2>

                <p>
                    تیم مانا آماده است تا در کنار شما، ایده را به یک محصول دیجیتال واقعی
                    تبدیل کند.
                </p>

                <a
                    href="{{ url('/#contact') }}"
                    class="btn-flow"
                >
                    شروع گفتگو

                    <i class="fa-solid fa-arrow-left"></i>
                </a>

            </div>

        </div>

    </section>

@endsection


@section('js')

<script src="{{ asset('js/client/singleblog.js') }}"></script>

@endsection