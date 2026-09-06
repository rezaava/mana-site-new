@extends('layout.master')

@section('title')
{{ $project->title }} | {{ $siteTexts['footer_brand']->value ?? 'مانا' }}
@endsection

@section('head') 
<link rel="stylesheet" href="{{ asset('css/project.css') }}"> <style>
.gal-item-empty {
border-radius: 20px;
overflow: hidden;
border: 1px solid var(--line);
aspect-ratio: 4/3;
background: var(--surface-2);
display: flex;
align-items: center;
justify-content: center;
color: var(--text-dimmer);
font-size: 0.9rem;
flex-direction: column;
gap: 8px;
}
.gal-item-empty i {
font-size: 2.5rem;
opacity: 0.3;
}
.gal-item-empty span {
opacity: 0.6;
}
.sim-thumb img {
width: 100%;
height: 100%;
object-fit: cover;
}
.browser-screen img {
width: 100%;
height: 100%;
object-fit: cover;
}
.phone-frame img {
width: 100%;
height: 100%;
object-fit: cover;
}
.pinfo-services {
display: flex;
flex-wrap: wrap;
gap: 16px;
justify-content: center;
margin-top: 24px;
}
.pinfo-services span {
font-size: 0.88rem;
font-weight: 600;
color: var(--text-dim);
} </style>
@endsection

@section('main')

<div class="side-nav" id="sideNav">
    <a href="#overview" class="active"><span>معرفی پروژه</span></a>
    <a href="#gallery"><span>گالری تصاویر</span></a>
    <a href="#features"><span>ویژگی‌ها</span></a>
    <a href="#techstack"><span>تکنولوژی‌ها</span></a>
    <a href="#pinfo"><span>اطلاعات پروژه</span></a>
    <a href="#similar"><span>پروژه‌های مشابه</span></a>
</div>

<section class="case-hero" id="top">
    <div class="container-x">
        <div class="breadcrumb-x reveal in">
            <a href="/">خانه</a>
            <i class="fa-solid fa-chevron-left"></i>
            <a href="/#folio">نمونه‌کارها</a>
            <i class="fa-solid fa-chevron-left"></i>
            <span class="cur">{{ $project->title }}</span>
        </div>


    <div class="row align-items-center g-4">
        <div class="col-lg-6">
            <span class="eyebrow reveal in">
                <i class="fa-solid fa-gauge-high"></i>
                {{ $project->category->name ?? 'نمونه کار' }}
            </span>

            <h1 class="reveal in">{{ $project->title }}</h1>

            <p class="section-sub reveal in reveal-delay-1" style="margin-bottom:0">
                {{ $project->brief ?? 'توضیح مختصری برای این پروژه ثبت نشده است.' }}
            </p>

            <div class="case-meta-row reveal in reveal-delay-2">
                @if($project->client_name)
                    <div class="case-meta-chip">
                        <i class="fa-solid fa-building"></i> {{ $project->client_name }}
                    </div>
                @endif

                @if($project->launch_year)
                    <div class="case-meta-chip">
                        <i class="fa-regular fa-calendar"></i> سال {{ $project->launch_year }}
                    </div>
                @endif

                @if($project->duration)
                    <div class="case-meta-chip">
                        <i class="fa-regular fa-clock"></i> {{ $project->duration }}
                    </div>
                @endif
            </div>

            <div class="case-hero-btns reveal in reveal-delay-3">
                @if($project->project_link)
                    <a href="{{ $project->project_link }}" class="btn-flow" target="_blank">
                        مشاهده سایت <i class="fa-solid fa-arrow-up-left"></i>
                    </a>
                @endif

                <a href="{{ url('/') }}" class="btn-ghost">
                    <i class="fa-solid fa-house"></i> صفحه اصلی
                </a>

                <a href="{{ url('/') }}#folio" class="btn-ghost">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت به نمونه‌کارها
                </a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mockup-wrap reveal in reveal-delay-1">
                <div class="browser-frame">
                    <div class="browser-bar">
                        <span class="dot r"></span>
                        <span class="dot y"></span>
                        <span class="dot g"></span>
                        <div class="url">{{ $project->project_link ?? 'www.example.com' }}</div>
                    </div>

                    <div class="browser-screen">
                        @if($project->image_url)
                            <img src="{{ asset('storage/' . $project->image_url) }}" alt="{{ $project->title }}">
                        @else
                            <i class="fa-solid fa-chart-pie"></i>
                        @endif
                    </div>
                </div>

                <div class="phone-frame">
                    @if($project->image_url)
                        <img src="{{ asset('storage/' . $project->image_url) }}" alt="{{ $project->title }}">
                    @else
                        <i class="fa-solid fa-mobile-screen"></i>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


</section>

<div class="stat-strip-outer">
    <div class="container-x">
        <div class="stat-strip reveal">
            @if($project->stats->count() > 0)
                <div class="row g-3">
                    @foreach($project->stats as $stat)
                        <div class="col-6 col-md-3 stat-item">
                            <h3>
                                <span class="count-num" data-target="{{ preg_replace('/[^0-9]/', '', $stat->value) }}">۰</span>
                                <span class="grad-text">{{ preg_replace('/[0-9]/', '', $stat->value) }}</span>
                            </h3>
                            <span>{{ $stat->label }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-4" style="color:var(--text-dim);">
                    <i class="fa-solid fa-chart-simple"></i> آمار این پروژه هنوز ثبت نشده است.
                </div>
            @endif
        </div>
    </div>
</div>

<section class="overview" id="overview">
    <div class="container-x">
        <div class="row g-5">
            <div class="col-lg-7 cs-block reveal">
                <span class="eyebrow">
                    <i class="fa-solid fa-file-lines"></i> معرفی پروژه
                </span>


            <h2 class="section-title" style="margin-bottom:26px">
                پروژه چیست و چرا ساختیمش؟
            </h2>

            @if($project->desc)
                <h2>پروژه چیست؟</h2>
                <p>{{ $project->desc }}</p>
            @endif

            @if($project->project_goal)
                <h2>هدف از طراحی چه بود؟</h2>
                <p>{{ $project->project_goal }}</p>
            @endif

            @if($project->testimonial)
                <div class="quote-card reveal reveal-delay-1">
                    <i class="fa-solid fa-quote-right q"></i>
                    <div>
                        <p>{{ $project->testimonial }}</p>

                        <div class="who">
                            <div class="av">
                                {{ $project->client_name ? substr($project->client_name, 0, 2) : 'م' }}
                            </div>

                            <div>
                                <h6>{{ $project->client_name ?? 'کارفرما' }}</h6>
                                <span>{{ $project->client_role ?? '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-5">
            <div class="cs-cards">
                @if($project->challenge)
                    <div class="cs-card challenge reveal reveal-delay-1">
                        <div class="ic">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <h4>چالش اصلی</h4>
                        <p>{{ $project->challenge }}</p>
                    </div>
                @else
                    <div class="cs-card challenge reveal reveal-delay-1">
                        <div class="ic">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <h4>چالش اصلی</h4>
                        <p>چالشی برای این پروژه ثبت نشده است.</p>
                    </div>
                @endif

                @if($project->solution)
                    <div class="cs-card solution reveal reveal-delay-2">
                        <div class="ic">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                        <h4>راه‌حل ما</h4>
                        <p>{{ $project->solution }}</p>
                    </div>
                @else
                    <div class="cs-card solution reveal reveal-delay-2">
                        <div class="ic">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                        <h4>راه‌حل ما</h4>
                        <p>راه‌حلی برای این پروژه ثبت نشده است.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


</section>

<section class="gallery" id="gallery">
    <div class="container-x">
        <div class="text-center mb-5 reveal" style="text-align:right">
            <span class="eyebrow">
                <i class="fa-solid fa-images"></i> گالری تصاویر
            </span>
            <h2 class="section-title">نگاهی نزدیک به صفحات پروژه</h2>
        </div>


    @php
        $desktop = $project->galleries->where('category', 'desktop');
        $mobile = $project->galleries->where('category', 'mobile');
        $key = $project->galleries->where('category', 'key_pages');
    @endphp

    <div class="gal-tabs reveal">
        <button class="gal-tab active" data-tab="desktop">دسکتاپ</button>
        <button class="gal-tab" data-tab="mobile">موبایل</button>
        <button class="gal-tab" data-tab="key">صفحات کلیدی</button>
    </div>

    <div class="gal-grid" data-panel="desktop">
        @forelse($desktop as $image)
            <div class="gal-item reveal">
                <div class="ph g1">
                    <img src="{{ asset('storage/' . $image->image_url) }}" alt="دسکتاپ">
                </div>
                <div class="zoom-ic">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                </div>
            </div>
        @empty
            @for($i = 0; $i < 3; $i++)
                <div class="gal-item-empty reveal">
                    <i class="fa-regular fa-image"></i>
                    <span>تصویر موجود نیست</span>
                </div>
            @endfor
        @endforelse
    </div>

    <div class="gal-grid hidden" data-panel="mobile">
        @forelse($mobile as $image)
            <div class="gal-item reveal">
                <div class="ph g2">
                    <img src="{{ asset('storage/' . $image->image_url) }}" alt="موبایل">
                </div>
                <div class="zoom-ic">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                </div>
            </div>
        @empty
            @for($i = 0; $i < 3; $i++)
                <div class="gal-item-empty reveal">
                    <i class="fa-regular fa-image"></i>
                    <span>تصویر موجود نیست</span>
                </div>
            @endfor
        @endforelse
    </div>

    <div class="gal-grid hidden" data-panel="key">
        @forelse($key as $image)
            <div class="gal-item reveal">
                <div class="ph g3">
                    <img src="{{ asset('storage/' . $image->image_url) }}" alt="صفحه کلیدی">
                </div>
                <div class="zoom-ic">
                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                </div>
            </div>
        @empty
            @for($i = 0; $i < 3; $i++)
                <div class="gal-item-empty reveal">
                    <i class="fa-regular fa-image"></i>
                    <span>تصویر موجود نیست</span>
                </div>
            @endfor
        @endforelse
    </div>
</div>


</section>

<div class="lightbox" id="lightbox">
    <div class="lightbox-inner" id="lightboxInner">
        <button class="lightbox-close" id="lightboxClose">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
</div>

<section class="features" id="features">
    <div class="container-x">
        <div class="mb-5 reveal">
            <span class="eyebrow">
                <i class="fa-solid fa-layer-group"></i> ویژگی‌های کلیدی
            </span>
            <h2 class="section-title">امکاناتی که این پروژه را متفاوت می‌کند</h2>
        </div>


    <div class="svc-grid">
        @if($project->features && $project->features->count() > 0)
            @foreach($project->features as $index => $feature)
                <div class="svc-card reveal reveal-delay-{{ ($index % 3) + 1 }}">
                    <div class="svc-icon">
                        <i class="fa-solid {{ $feature->icon }}"></i>
                    </div>

                    <h3>{{ $feature->title }}</h3>
                    <p>{{ $feature->text ?? 'توضیحی برای این ویژگی ثبت نشده است.' }}</p>
                </div>
            @endforeach
        @else
            <div class="svc-card reveal" style="grid-column:1/-1;text-align:center;padding:60px 20px;">
                <div class="svc-icon">
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                <h3>ویژگی ثبت نشده</h3>
                <p>هنوز ویژگی‌های کلیدی برای این پروژه ثبت نشده است.</p>
            </div>
        @endif
    </div>
</div>


</section>

<section class="techstack" id="techstack">
    <div class="container-x text-center">
        <div class="mb-5 reveal">
            <span class="eyebrow">
                <i class="fa-solid fa-code"></i> تکنولوژی‌های استفاده‌شده
            </span>
            <h2 class="section-title">ابزارهایی که این پروژه را ساختند</h2>
        </div>


    <div class="tech-row reveal">
        @if($project->technologies && $project->technologies->count() > 0)
            @foreach($project->technologies as $tech)
                <div class="tech-pill">
                    @if($tech->icon)
                        <i class="fa-{{ $tech->icon }}"></i>
                    @else
                        <i class="fa-solid fa-cube"></i>
                    @endif
                    {{ $tech->name }}
                </div>
            @endforeach
        @else
            <div style="color:var(--text-dim);padding:20px;width:100%;">
                <i class="fa-solid fa-info-circle"></i>
                تکنولوژی‌های استفاده‌شده ثبت نشده است.
            </div>
        @endif
    </div>
</div>


</section>

<section class="pinfo" id="pinfo">
    <div class="container-x">
        <div class="text-center mb-5 reveal">
            <span class="eyebrow">
                <i class="fa-solid fa-circle-info"></i> اطلاعات پروژه
            </span>
            <h2 class="section-title">جزئیات کلی همکاری</h2>
        </div>


    <div class="pinfo-grid">
        <div class="pinfo-card reveal reveal-delay-1">
            <i class="fa-solid fa-building"></i>
            <h6>کارفرما</h6>
            <p>{{ $project->client_name ?? 'نامشخص' }}</p>
        </div>

        <div class="pinfo-card reveal reveal-delay-2">
            <i class="fa-regular fa-calendar"></i>
            <h6>سال اجرا</h6>
            <p>{{ $project->launch_year ?? 'نامشخص' }}</p>
        </div>

        <div class="pinfo-card reveal reveal-delay-3">
            <i class="fa-regular fa-clock"></i>
            <h6>مدت زمان</h6>
            <p>{{ $project->duration ?? 'نامشخص' }}</p>
        </div>

        <div class="pinfo-card reveal reveal-delay-4">
            <i class="fa-solid fa-diagram-project"></i>
            <h6>نوع پروژه</h6>
            <p>{{ $project->category->name ?? 'عمومی' }}</p>
        </div>
    </div>

    <div class="pinfo-services reveal">
        @if($project->services->count() > 0)
            @foreach($project->services as $service)
                <span>
                    <i class="fa-solid fa-check" style="color:var(--accent-2);margin-left:6px;"></i>
                    {{ $service->name }}
                </span>
            @endforeach
        @else
            <span style="color:var(--text-dim);">
                هیچ خدمتی برای این پروژه ثبت نشده است.
            </span>
        @endif
    </div>
</div>


</section>

@if($relatedProjects && $relatedProjects->count() > 0)

<section class="similar" id="similar">
    <div class="container-x">
        <div class="text-center mb-5 reveal">
            <span class="eyebrow">
                <i class="fa-solid fa-shapes"></i> پروژه‌های مشابه
            </span>
            <h2 class="section-title">ادامه‌ی گشت‌وگذار در نمونه‌کارها</h2>
        </div>


    <div class="sim-grid">
        @foreach($relatedProjects as $index => $rel)
            <div class="sim-card reveal reveal-delay-{{ ($index % 3) + 1 }}">
                <div class="sim-thumb t{{ ($index % 3) + 1 }}">
                    @if($rel->image_url)
                        <img src="{{ asset('storage/' . $rel->image_url) }}" alt="{{ $rel->title }}">
                    @else
                        <i class="fa-solid fa-briefcase"></i>
                    @endif
                </div>

                <div class="sim-body">
                    <span class="tag">{{ $rel->category->name ?? 'نمونه کار' }}</span>
                    <h4>{{ $rel->title }}</h4>
                    <a href="{{ route('projects.show', $rel->id) }}">
                        مشاهده جزئیات
                        <i class="fa-solid fa-arrow-up-left"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>


</section>
@endif

<section class="final-cta">
    <div class="container-x">
        <div class="cta-banner reveal">
            <h2>پروژه بعدی شما همین‌جا شروع می‌شود</h2>
            <p>اگر ایده‌ای شبیه به این پروژه یا کاملاً متفاوت دارید، تیم مانا آماده‌ی شنیدن آن است.</p>
            <a href="{{ url('/') }}#contact" class="btn-flow">
                شروع گفتگو <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>


    <div class="d-flex gap-3 justify-content-center mt-4">
        <a href="{{ url('/') }}" class="btn-flow">
            <i class="fa-solid fa-house"></i> صفحه اصلی
        </a>

        <a href="{{ url('/') }}#folio" class="btn-ghost">
            <i class="fa-solid fa-briefcase"></i> بازگشت به نمونه‌کارها
        </a>
    </div>
</div>


</section>

@endsection

@section('js')
<script src="{{ asset('js/client/project.js') }}"></script>
@endsection