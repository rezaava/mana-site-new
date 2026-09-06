@extends('layout.master')

@section('title')
    وبلاگ | {{ $siteTexts['footer_brand']->value ?? 'مانا' }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/singleblog.css') }}">
@endsection

@section('main')

    <!-- ============ BLOG HERO ============ -->

    <section class="blog-hero">

        <div class="container-x">

            <div class="breadcrumb-x reveal in">

                <a href="{{ url('/') }}">
                    خانه
                </a>

                <i class="fa-solid fa-chevron-left"></i>

                <span class="cur">
                    وبلاگ
                </span>

            </div>


            <span class="eyebrow reveal in">

                <i class="fa-solid fa-pen-nib"></i>

                {{ $siteTexts['blog_badge']->value ?? 'وبلاگ مانا' }}

            </span>


            <h1 class="reveal in">

                {{ $siteTexts['blog_title']->value ?? 'مقالات، راهنماها و' }}

                <span class="grad-text">

                    {{ $siteTexts['blog_title_highlight']->value ?? 'تجربه‌های فنی تیم ما' }}

                </span>

            </h1>


            <p class="section-sub reveal in reveal-delay-1">

                {{ $siteTexts['blog_description']->value ?? 'آخرین یافته‌ها درباره‌ی هوش مصنوعی، طراحی محصول، توسعه‌ی نرم‌افزار و رشد دیجیتال کسب‌وکارها را اینجا بخوانید.' }}

            </p>


            <div class="blog-search reveal in reveal-delay-2">

                <input
                    type="text"
                    id="searchInput"
                    placeholder="جست‌وجو در مقالات..."
                >

                <i class="fa-solid fa-magnifying-glass"></i>

            </div>

        </div>

    </section>


    <!-- ============ FEATURED POST ============ -->

    @if($blogs->count() > 0)

        @php
            $featured = $blogs->first();
        @endphp

        <section class="featured-wrap">

            <div class="container-x">

                <div class="featured-card reveal">


                    <!-- تصویر -->

                    <div class="featured-visual">

                        <div class="deco"></div>

                        <span class="fbadge">
                            مقاله ویژه
                        </span>


                        @if($featured->image_url)

                            <img
                                src="{{ asset('storage/' . $featured->image_url) }}"
                                alt="{{ $featured->title }}"
                            >

                        @else

                            <img
                                src="{{ asset('img/blog8.jpg') }}"
                                alt="{{ $featured->title }}"
                            >

                        @endif

                    </div>


                    <!-- محتوا -->

                    <div class="featured-body">


                        <!-- دسته‌بندی -->

                        <span class="tag">

                            @if($featured->category)

                                {{ $featured->category->name }}

                            @else

                                عمومی

                            @endif

                        </span>


                        <!-- عنوان -->

                        <h2>
                            {{ $featured->title }}
                        </h2>


                        <!-- خلاصه -->

                        <p>

                            {{ Str::limit(
                                strip_tags($featured->text),
                                160
                            ) }}

                        </p>


                        <!-- اطلاعات -->

                        <div class="featured-meta">

                            <span>

                                <i class="fa-regular fa-calendar"></i>

                                {{ verta($featured->created_at)->format('d F Y') }}

                            </span>


                            @if($featured->{'reading-time'})

                                <span>

                                    <i class="fa-regular fa-clock"></i>

                                    {{ $featured->{'reading-time'} }}

                                    دقیقه مطالعه

                                </span>

                            @endif

                        </div>


                        <!-- مشاهده -->

                        <a
                            href="{{ route('blogs.singleBlog', $featured->id) }}"
                            class="btn-flow"
                        >

                            مطالعه مقاله

                            <i class="fa-solid fa-arrow-left"></i>

                        </a>

                    </div>

                </div>

            </div>

        </section>

    @endif


    <!-- ============ FILTER BAR ============ -->

    <section class="filter-bar">

        <div class="container-x">

            <div class="filter-row reveal">

                <div
                    class="filter-tabs"
                    id="filterTabs"
                >

                    <!-- همه مقالات -->

                    <button
                        class="filter-tab active"
                        data-cat="all"
                        type="button"
                    >
                        همه مقالات
                    </button>


                    <!-- دسته‌بندی‌ها -->

                    @php
                        $categories = \App\Models\Categories::withCount('blogs')
                            ->orderBy('name')
                            ->get();
                    @endphp


                    @foreach($categories as $category)

                        <button
                            class="filter-tab"
                            data-cat="{{ $category->id }}"
                            type="button"
                        >
                            {{ $category->name }}
                        </button>

                    @endforeach

                </div>


                <!-- تعداد مقالات -->

                <span
                    class="filter-count"
                    id="filterCount"
                >
                    {{ $blogs->count() }} مقاله
                </span>

            </div>

        </div>

    </section>


    <!-- ============ ARTICLES GRID ============ -->

    <section class="articles">

        <div class="container-x">

            <div
                class="art-grid"
                id="artGrid"
            >

                @php

                    $gradients = [
                        'g1',
                        'g2',
                        'g3',
                        'g4',
                        'g5',
                        'g6',
                        'g7',
                        'g8',
                        'g9'
                    ];

                @endphp


                @forelse($blogs as $index => $blog)

                    <a
                        href="{{ route('blogs.singleBlog', $blog->id) }}"
                        class="art-card"
                        data-cat="{{ $blog->category?->id ?? 'all' }}"
                        data-title="{{ $blog->title }}"
                    >


                        <!-- تصویر مقاله -->

                        <div
                            class="art-thumb {{ $gradients[$index % count($gradients)] }}"
                        >

                            <!-- دسته‌بندی -->

                            <span class="cat">

                                @if($blog->category)

                                    {{ $blog->category->name }}

                                @else

                                    مقاله

                                @endif

                            </span>


                            @if($blog->image_url)

                                <img
                                    src="{{ asset('storage/' . $blog->image_url) }}"
                                    alt="{{ $blog->title }}"
                                >

                            @else

                                <img
                                    src="{{ asset('img/blog1.jpg') }}"
                                    alt="{{ $blog->title }}"
                                >

                            @endif

                        </div>


                        <!-- محتوای کارت -->

                        <div class="art-body">


                            <!-- تاریخ و زمان -->

                            <div class="art-meta">

                                <span>

                                    <i class="fa-regular fa-calendar"></i>

                                    {{ verta($blog->created_at)->format('d F Y') }}

                                </span>


                                @if($blog->{'reading-time'})

                                    <span>

                                        <i class="fa-regular fa-clock"></i>

                                        {{ $blog->{'reading-time'} }}

                                        دقیقه

                                    </span>

                                @endif

                            </div>


                            <!-- عنوان -->

                            <h4>

                                {{ Str::limit(
                                    $blog->title,
                                    45
                                ) }}

                            </h4>


                            <!-- خلاصه -->

                            <p>

                                {{ Str::limit(
                                    strip_tags($blog->text),
                                    90
                                ) }}

                            </p>


                            <!-- تگ‌ها -->

                            @if($blog->tags->count() > 0)

                                <div
                                    class="article-tags"
                                    style="
                                        display:flex;
                                        flex-wrap:wrap;
                                        gap:5px;
                                        margin-top:10px;
                                    "
                                >

                                    @foreach($blog->tags->take(3) as $tag)

                                        <span
                                            style="
                                                font-size:.72rem;
                                                padding:4px 9px;
                                                border-radius:20px;
                                                background:var(--surface-2);
                                                color:var(--text-dim);
                                            "
                                        >

                                            #{{ $tag->text }}

                                        </span>

                                    @endforeach

                                </div>

                            @endif


                            <!-- لینک -->

                            <span class="art-link">

                                مطالعه مقاله

                                <i class="fa-solid fa-arrow-up-left"></i>

                            </span>

                        </div>

                    </a>

                @empty

                    <div
                        style="
                            width:100%;
                            text-align:center;
                            padding:80px 20px;
                        "
                    >

                        <i
                            class="fa-regular fa-newspaper"
                            style="
                                font-size:50px;
                                margin-bottom:20px;
                                color:var(--accent);
                            "
                        ></i>


                        <h4>
                            هنوز مقاله‌ای منتشر نشده است
                        </h4>


                        <p style="color:var(--text-dim);">

                            به‌زودی مقالات جدید در وبلاگ مانا منتشر می‌شوند.

                        </p>

                    </div>

                @endforelse

            </div>


            <!-- ============ LOAD MORE ============ -->

            <div
                class="load-more-wrap reveal"
                id="loadMoreWrap"
            >

                <a
                    href="#"
                    class="btn-ghost"
                    id="loadMoreBtn"
                >

                    <i class="fa-solid fa-rotate"></i>

                    نمایش مقالات بیشتر

                </a>

            </div>

        </div>

    </section>


    <!-- ============ SIDEBAR EXTRAS ============ -->

    <section class="blog-extra">

        <div class="container-x">

            <div class="row g-4">


                <!-- محبوب‌ترین مقالات -->

                <div class="col-lg-4">

                    <div class="extra-card reveal">

                        <h5>

                            <i class="fa-solid fa-fire"></i>

                            محبوب‌ترین مقالات

                        </h5>


                        @foreach($blogs->take(3) as $index => $popular)

                            <div class="pop-item">

                                <div class="pn">

                                    {{ sprintf('%02d', $index + 1) }}

                                </div>

                                <a
                                    href="{{ route('blogs.singleBlog', $popular->id) }}"
                                >

                                    <div>

                                        <h6>
                                            {{ $popular->title }}
                                        </h6>

                                        @if($popular->{'reading-time'})

                                            <span>
                                                {{ $popular->{'reading-time'} }}
                                                دقیقه مطالعه
                                            </span>

                                        @endif

                                    </div>

                                </a>

                            </div>

                        @endforeach

                    </div>

                </div>


                <!-- دسته‌بندی‌ها -->

                <div class="col-lg-4">

                    <div class="extra-card reveal reveal-delay-1">

                        <h5>

                            <i class="fa-solid fa-layer-group"></i>

                            دسته‌بندی‌ها

                        </h5>


                        <div class="cat-list">

                            @foreach($categories as $category)

                                <a href="#">

                                    {{ $category->name }}

                                    <span class="cnt">
                                        {{ $category->blogs_count }}
                                    </span>

                                </a>

                            @endforeach

                        </div>

                    </div>

                </div>


                <!-- برچسب‌ها -->

                <div class="col-lg-4">

                    <div class="extra-card reveal reveal-delay-2">

                        <h5>

                            <i class="fa-solid fa-tags"></i>

                            برچسب‌های پرطرفدار

                        </h5>


                        <div class="tag-cloud">

                            @php
                                $popularTags = \App\Models\BlogTag::query()
                                    ->select('text')
                                    ->distinct()
                                    ->limit(12)
                                    ->get();
                            @endphp


                            @foreach($popularTags as $tag)

                                <a href="#">

                                    {{ $tag->text }}

                                </a>

                            @endforeach

                        </div>

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

                    {{ $siteTexts['blog_cta_title']->value ?? 'ایده‌ای برای پروژه‌ی بعدی‌تان دارید؟' }}

                </h2>


                <p>

                    {{ $siteTexts['blog_cta_description']->value ?? 'تیم مانا آماده است تا در کنار شما، ایده را به یک محصول دیجیتال واقعی تبدیل کند.' }}

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

<script src="{{ asset('js/client/blog.js') }}"></script>

@endsection