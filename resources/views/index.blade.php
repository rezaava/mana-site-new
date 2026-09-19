@extends('layout.master')

@section('title')
    شرکت مانا | طراحی سایت،سئو و هوش مصنوعی
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <style>
        .svc-card p {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ============ LEAD MODAL (auto-open phone capture) ============ */
        .lead-modal-content {
            position: relative;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 30px;
            box-shadow: var(--shadow-strong);
            padding: 8px;
        }

        .lead-modal-content .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.45;
            z-index: 0;
            pointer-events: none;
        }

        .lead-modal-content .blob.b1 {
            width: 260px;
            height: 260px;
            background: var(--brand);
            top: -110px;
            right: -80px;
            animation: blobMove1 16s ease-in-out infinite;
        }

        .lead-modal-content .blob.b2 {
            width: 220px;
            height: 220px;
            background: var(--accent-2);
            bottom: -100px;
            left: -70px;
            animation: blobMove2 19s ease-in-out infinite;
        }

        .lead-modal-close {
            position: absolute;
            z-index: 3;
            top: 18px;
            left: 18px;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: color-mix(in srgb, var(--text) 4%, transparent);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.25s var(--ease);
        }

        .lead-modal-close:hover {
            border-color: var(--accent-2);
            color: var(--accent-2);
            transform: rotate(90deg);
        }

        .lead-modal-body {
            position: relative;
            z-index: 1;
            padding: 44px 40px 34px;
            text-align: center;
        }

        .lead-modal-body .eyebrow {
            margin-bottom: 14px;
        }

        .lead-modal-body h3 {
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 12px;
        }

        .lead-modal-body>p {
            color: var(--text-dim);
            font-size: 0.94rem;
            line-height: 1.9;
            max-width: 380px;
            margin: 0 auto 26px;
        }

        .lead-modal-body .form-control-x {
            text-align: center;
            margin-bottom: 14px;
        }

        .lead-modal-skip {
            display: block;
            margin: 16px auto 4px;
            background: none;
            border: none;
            color: var(--text-dimmer);
            font-size: 0.82rem;
            text-decoration: underline;
            text-underline-offset: 4px;
            cursor: pointer;
        }

        .lead-modal-success {
            display: none;
            padding: 10px 0 6px;
        }

        .lead-modal-success.show {
            display: block;
            animation: orderPop 0.5s var(--ease);
        }

        .lead-modal-success i {
            font-size: 3rem;
            color: var(--accent-2);
            margin-bottom: 14px;
        }

        .lead-modal-success h4 {
            font-weight: 800;
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .lead-modal-success p {
            color: var(--text-dim);
            font-size: 0.9rem;
            line-height: 1.8;
            max-width: 320px;
            margin: 0 auto;
        }

        .lead-modal-body .btn-flow {
            width: 100%;
            justify-content: center;
            border: none;
        }

        @keyframes orderPop {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 576px) {
            .lead-modal-body {
                padding: 38px 22px 28px;
            }

            .lead-modal-body h3 {
                font-size: 1.3rem;
            }
        }
    </style>
@endsection

@section('main')

    <section class="hero" id="home">
        <div class="container-x">
            <div class="hero-grid">
                <div class="hero-text reveal in">
                    <span class="eyebrow">
                        <i class="fa-solid fa-sparkles"></i>
                        {{ $siteTexts['hero_badge']->value ?? 'استودیوی محصولات دیجیتال' }}
                    </span>
                    <h1>
                        {{ $siteTexts['hero_title']->value ?? 'ساختن آینده دیجیتال شما،' }}
                        <span
                            class="grad-text">{{ $siteTexts['hero_title_highlight']->value ?? 'امروز شروع می‌شود' }}</span>
                    </h1>
                    <p class="lead-x">
                        {{ $siteTexts['hero_desc']->value ?? 'از ایده تا محصول؛ تیم نوین‌آی با ترکیب هوش مصنوعی، طراحی مدرن و مهندسی دقیق، محصولاتی می‌سازد که کسب‌وکار شما را برای فردا آماده می‌کند.' }}
                    </p>
                    <div class="hero-btns">
                        <a href="#contact" class="btn-flow">{{ $siteTexts['hero_cta']->value ?? 'شروع پروژه' }} <i
                                class="fa-solid fa-arrow-left"></i></a>
                        <a href="#folio" class="btn-ghost"><i
                                class="fa-solid fa-play"></i>{{ $siteTexts['hero_secondary_cta']->value ?? 'مشاهده نمونه‌کارها' }}</a>
                    </div>
                    <div class="hero-trust mb-4">
                        <div class="avatar-stack">
                            <span>ع.ک</span>
                            <span>ف.م</span>
                            <span>س.ا</span>
                            <span>+۵۰</span>
                        </div>
                        <span>{{ $siteTexts['hero_trust']->value ?? 'مورد اعتماد بیش از ۵۰ کسب‌وکار موفق' }}</span>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="orbit-ring r1"></div>
                    <div class="orbit-ring r2"></div>
                    <div class="core-cube"><i class="fa-solid fa-cube"></i></div>
                    <div class="float-chip c1"><i class="fa-solid fa-code"></i></div>
                    <div class="float-chip c2"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="float-chip c3"><i class="fa-solid fa-cloud"></i></div>
                    <div class="float-chip c4"><i class="fa-solid fa-shield-halved"></i></div>
                </div>
            </div>
        </div>
    </section>

    @php
        $projectsCount = $stats['projects_count'] ?? Projects::count();
        $customersCount = $stats['customers_count'] ?? '۵۰+';
        $supportHours = $stats['support_hours'] ?? '۲۴/۷';
        $satisfaction = $stats['satisfaction'] ?? '۹۸%';
        $toEnglishNumber = function ($number) {
            return strtr((string) $number, ['۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9']);
        };
        $projectsTarget = preg_replace('/[^0-9]/', '', $toEnglishNumber($projectsCount)) ?: '0';
        $customersTarget = preg_replace('/[^0-9]/', '', $toEnglishNumber($customersCount)) ?: '0';
        $supportTarget = preg_replace('/[^0-9]/', '', $toEnglishNumber($supportHours)) ?: '0';
        $satisfactionTarget = preg_replace('/[^0-9]/', '', $toEnglishNumber($satisfaction)) ?: '0';
    @endphp

    <div class="stat-strip-outer">
        <div class="container-x">
            <div class="stat-strip reveal">
                <div class="row g-3">
                    <div class="col-6 col-md-3 stat-item">
                        <h3><span class="count-num"
                                data-target="{{ $projectsTarget }}">۰</span>@if(str_contains((string) $projectsCount, '+'))<span
                                class="grad-text">+</span>@endif</h3>
                        <span>{{ $siteTexts['stat1_text']->value ?? 'پروژه موفق' }}</span>
                    </div>
                    <div class="col-6 col-md-3 stat-item">
                        <h3><span class="count-num" data-target="{{ $satisfactionTarget }}">۰</span><span
                                class="grad-text">%</span></h3>
                        <span>{{ $siteTexts['stat2_text']->value ?? 'رضایت مشتریان' }}</span>
                    </div>
                    <div class="col-6 col-md-3 stat-item">
                        <h3><span class="count-num" data-target="{{ $customersTarget }}">۰</span><span
                                class="grad-text">+</span></h3>
                        <span>{{ $siteTexts['stat3_text']->value ?? 'مشتری فعال' }}</span>
                    </div>
                    <div class="col-6 col-md-3 stat-item">
                        <h3><span class="count-num" data-target="{{ $supportTarget }}">۰</span><span
                                class="grad-text">/۷</span></h3>
                        <span>{{ $siteTexts['stat4_text']->value ?? 'پشتیبانی' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="services" id="services">
        <div class="container-x">
            <div class="services-head reveal row">
                <div class="col">
                    <span class="eyebrow"><i
                            class="fa-solid fa-layer-group"></i>{{ $siteTexts['services_badge']->value ?? 'خدمات ما' }}</span>
                    <h2 class="section-title">
                        {!! nl2br(e($siteTexts['services_title']->value ?? 'هر آنچه برای رشد دیجیتال نیاز دارید، اینجاست')) !!}
                    </h2>
                </div>
                <p class="section-sub col">
                    {{ $siteTexts['services_desc']->value ?? 'از هوش مصنوعی تا اپلیکیشن موبایل؛ راهکارهایی که بر پایه‌ی داده، طراحی و مهندسی مدرن ساخته شده‌اند.' }}
                </p>
            </div>
            <div class="flow-wrap">
                <svg class="flow-svg" viewBox="0 0 1200 500" preserveAspectRatio="none">
                    <path d="M0,250 C200,100 300,400 600,250 C900,100 1000,400 1200,250" stroke="url(#g1)"
                        stroke-width="1.5" fill="none" />
                    <defs>
                        <linearGradient id="g1" x1="0" y1="0" x2="1" y2="0">
                            <stop offset="0%" stop-color="#2f7dfb" />
                            <stop offset="100%" stop-color="#17c3b2" />
                        </linearGradient>
                    </defs>
                </svg>
                <div class="svc-grid">
                    @foreach($services as $index => $service)
                        <a href="{{ route('servise', ['slug' => $service->slug]) }}">
                            <div class="svc-card reveal reveal-delay-{{ ($index % 3) + 1 }}" data-tilt>
                                <span class="svc-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <div class="svc-icon"><i class="fa-solid {!! $service->icon !!}"></i></div>
                                <h3>{{ $service->title }}</h3>
                                <p>{{ $service->text }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="why">
        <div class="container-x">
            <div class="row align-items-center g-4 why-grid">
                <div class="col-lg-5">
                    <div class="why-visual reveal">
                        <div class="why-photo"><img src="{{ asset('img/mana1.png') }}" alt="Mana"></div>
                        <div class="badge-float">
                            <span class="num">{{ $siteTexts['experience_num']->value ?? '۱۵+' }}</span>
                            <div>
                                <div style="font-size:.82rem;font-weight:600">
                                    {{ $siteTexts['experience_title']->value ?? 'سال تجربه' }}
                                </div>
                                <div style="font-size:.74rem;color:var(--text-dim)">
                                    {{ $siteTexts['experience_desc']->value ?? 'در ساخت محصولات دیجیتال' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <span class="eyebrow reveal"><i
                            class="fa-solid fa-star"></i>{{ $siteTexts['why_badge']->value ?? 'چرا مانا' }}</span>
                    <h2 class="section-title reveal reveal-delay-1">
                        {{ $siteTexts['why_title']->value ?? 'شریکی که رشد دیجیتال شما را جدی می‌گیرد' }}
                    </h2>
                    <ul class="why-list">
                        <li class="reveal reveal-delay-1">
                            <div class="ico"><i class="fa-solid fa-user-graduate"></i></div>
                            <div>
                                <h4>{{ $siteTexts['why1_title']->value ?? 'تیمی متخصص و باتجربه' }}</h4>
                                <p>{{ $siteTexts['why1_desc']->value ?? 'متخصصانی با سال‌ها تجربه در پروژه‌های واقعی و پیچیده.' }}
                                </p>
                            </div>
                        </li>
                        <li class="reveal reveal-delay-2">
                            <div class="ico"><i class="fa-solid fa-medal"></i></div>
                            <div>
                                <h4>{{ $siteTexts['why2_title']->value ?? 'کیفیت تضمین‌شده' }}</h4>
                                <p>{{ $siteTexts['why2_desc']->value ?? 'تست و بازبینی دقیق در هر مرحله از توسعه‌ی پروژه.' }}
                                </p>
                            </div>
                        </li>
                        <li class="reveal reveal-delay-3">
                            <div class="ico"><i class="fa-solid fa-headset"></i></div>
                            <div>
                                <h4>{{ $siteTexts['why3_title']->value ?? 'پشتیبانی ۲۴/۷' }}</h4>
                                <p>{{ $siteTexts['why3_desc']->value ?? 'همراهی و پاسخگویی سریع در تمام ساعات شبانه‌روز.' }}
                                </p>
                            </div>
                        </li>
                        <li class="reveal reveal-delay-4">
                            <div class="ico"><i class="fa-solid fa-tags"></i></div>
                            <div>
                                <h4>{{ $siteTexts['why4_title']->value ?? 'قیمت‌گذاری شفاف' }}</h4>
                                <p>{{ $siteTexts['why4_desc']->value ?? 'بدون هزینه‌ی پنهان؛ برآورد دقیق پیش از شروع کار.' }}
                                </p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="folio" id="folio">
        <div class="container-x">
            <div class="row align-items-end mb-4 reveal">
                <div class="col-md-8">
                    <span class="eyebrow"><i
                            class="fa-solid fa-briefcase"></i>{{ $siteTexts['folio_badge']->value ?? 'نمونه‌کارها' }}</span>
                    <h2 class="section-title">{{ $siteTexts['folio_title']->value ?? 'بخشی از پروژه‌های موفق ما' }}</h2>
                </div>
                <div class="col-md-4">
                    <p class="section-sub" style="margin-top:12px">
                        {{ $siteTexts['folio_desc']->value ?? 'روی هر مورد کلیک کنید تا جزئیات پروژه را ببینید.' }}
                    </p>
                </div>
            </div>
            <div class="folio-shell reveal">
                <div class="folio-side">
                    <div class="folio-mobile-tabs" id="folioMobileTabs">
                        @foreach($projects as $i => $project)
                            <div class="fmt-chip {{ $i === 0 ? 'active' : '' }}" data-category="{{ $project->category->id }}">
                                {{ $project->category->name }}
                            </div>
                        @endforeach
                    </div>

                    {{-- لیست پروژه‌ها --}}
                    <div class="folio-tabs" id="folioTabs">
                        @foreach($projects as $index => $project)
                            <div class="folio-tab {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"
                                data-category="{{ $project->category->id ?? '' }}" data-project="{{ $project->id }}"
                                data-description="{{ $project->description }}" data-from="{{ $project->from ?? '#1d2a6b' }}"
                                data-to="{{ $project->to ?? '#0b1030' }}" data-image="{{ asset($project->image_url) }}"
                                data-url="{{ route('projects.show', ['slug' => $project->slug]) }}">
                                <div class="ft-ic"><i class="{{ $project->icon ?? 'fa-solid fa-briefcase' }}"></i></div>
                                <div>
                                    <h5>{{ $project->title }}</h5>
                                    <span>{{ $project->category->name ?? 'پروژه' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="folio-preview" id="folioPreview">
                    <div class="fp-dots" id="fpDots">
                        @foreach($projects as $index => $project)
                            <span class="{{ $index === 0 ? 'active' : '' }}"></span>
                        @endforeach
                    </div>
                    @php
                        $firstProject = $projects->first();
                    @endphp
                    @if($firstProject)
                        <img class="fp-bg" id="fpBg" src="{{ asset('storage/' . $firstProject->image) }}"
                            alt="{{ $firstProject->title }}">
                        <div class="fp-content" id="fpContent">
                            <span class="tag">{{ $firstProject->category->name ?? 'پروژه' }}</span>
                            <h4>{{ $firstProject->title }}</h4>
                            <p>{{ $firstProject->description }}</p>
                            <a href="{{ route('projects.show', ['slug' => $firstProject->slug]) }}" class="pill">مشاهده جزئیات
                                <i class="fa-solid fa-arrow-up-left"></i></a>
                        </div>
                    @else
                        <div class="fp-bg" id="fpBg"></div>
                        <div class="fp-content" id="fpContent"></div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="team" id="team">
        <div class="container-x">
            <div class="text-center mb-5 reveal">
                <span class="eyebrow"><i
                        class="fa-solid fa-people-group"></i>{{ $siteTexts['team_badge']->value ?? 'تیم ما' }}</span>
                <h2 class="section-title">{{ $siteTexts['team_title']->value ?? 'متخصصانی که ایده شما را می‌سازند' }}</h2>
            </div>
            <div class="team-layout">

                {{-- ===== OWNER (ثابت در راست) ===== --}}
                @php $owner = $teams->firstWhere('owner', 1); @endphp
                @if($owner)
                    <div class="team-owner reveal">
                        <div class="team-card owner-card">
                            <div class="team-ring-1">
                                <div class="team-avatar tc1">
                                    <img src="{{ asset($owner->image) }}" alt="{{ $owner->name }}">
                                    <div class="ov">
                                        @if($owner->linkedin)
                                            <a href="{{ $owner->linkedin }}"><i class="fa-brands fa-linkedin-in"></i></a>
                                        @endif
                                        @if($owner->instagram)
                                            <a href="{{ $owner->instagram }}"><i class="fa-brands fa-instagram"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <h4>{{ $owner->name }}</h4>
                            <p>{{ $owner->title }}</p>
                        </div>
                    </div>
                @endif

                {{-- ===== SLIDER (بقیه اعضا) ===== --}}
                @php $others = $teams->where('owner', '!=', 1)->values(); @endphp
                @if($others->count())
                    <div class="team-slider-wrapper reveal reveal-delay-1">
                        <div class="team-slider" id="teamSlider">
                            @foreach($others as $index => $member)
                                <div class="team-card slider-card">
                                    <div class="team-ring">
                                        <div class="team-avatar tc{{ ($index % 5) + 1 }}">
                                            <img src="{{ asset($member->image) }}" alt="{{ $member->name }}">
                                            <div class="ov">
                                                @if($member->linkedin)
                                                    <a href="{{ $member->linkedin }}"><i class="fa-brands fa-linkedin-in"></i></a>
                                                @endif
                                                @if($member->instagram)
                                                    <a href="{{ $member->instagram }}"><i class="fa-brands fa-instagram"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <h4>{{ $member->name }}</h4>
                                    <p>{{ $member->title }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

    {{-- <section class="testi">
        <div class="container-x">
            <div class="text-center mb-5 reveal">
                <span class="eyebrow"><i class="fa-solid fa-comment-dots"></i>{{ $siteTexts['comments_badge']->value ??
                    'نظرات مشتریان' }}</span>
                <h2 class="section-title">{{ $siteTexts['comments_title']->value ?? 'آنچه مشتریان ما می‌گویند' }}</h2>
            </div>
            <div class="testi-track">
                @foreach($comments as $index=>$comment)
                <div class="testi-card reveal reveal-delay-{{ ($index%4)+1 }}">
                    <i class="fa-solid fa-quote-right quote"></i>
                    <p>{{ $comment->comment }}</p>
                    <div class="testi-person">
                        <div class="av">{{ mb_substr($comment->name,0,2) }}</div>
                        <div>
                            <h5>{{ $comment->name }}</h5>
                            <span>{{ $comment->position }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section> --}}

    <section class="faqc" id="contact">
        <div class="container-x">
            <div class="row g-4">
                <div class="col-lg-6">
                    <span class="eyebrow reveal"><i
                            class="fa-solid fa-circle-question"></i>{{ $siteTexts['faq_badge']->value ?? 'سوالات متداول' }}</span>
                    <h2 class="section-title reveal reveal-delay-1 mb-4">
                        {{ $siteTexts['faq_title']->value ?? 'پاسخ سوالات رایج شما' }}
                    </h2>
                    <div class="acc-list">
                        @foreach($questions as $index => $question)
                            <div class="acc-item {{ $index === 0 ? 'open' : '' }} reveal reveal-delay-{{ ($index % 4) + 1 }}">
                                <button class="acc-btn">{{ $question->title }} <i class="fa-solid fa-plus"></i></button>
                                <div class="acc-panel">
                                    <p>{{ $question->answer }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="contact-card reveal reveal-delay-2">
                        <span class="eyebrow">
                            <i class="fa-solid fa-paper-plane"></i>
                            {{ $siteTexts['contact_badge']->value ?? 'تماس با ما' }}
                        </span>

                        <h3 style="font-weight:800;font-size:1.5rem;margin-bottom:6px">
                            {{ $siteTexts['contact_title']->value ?? 'برای مشاوره رایگان با ما تماس بگیرید' }}
                        </h3>

                        <p class="section-sub" style="margin-bottom:26px">
                            {{ $siteTexts['contact_desc']->value ?? 'فرم زیر را پر کنید تا در کمتر از ۲۴ ساعت با شما تماس بگیریم.' }}
                        </p>

                        <form id="ticketForm">
                            @csrf

                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="user_name" class="form-control-x"
                                        placeholder="{{ $siteTexts['contact_name_placeholder']->value ?? 'نام و نام‌خانوادگی' }}"
                                        required>
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" name="email" class="form-control-x"
                                        placeholder="{{ $siteTexts['contact_email_placeholder']->value ?? 'ایمیل' }}"
                                        required>
                                </div>
                            </div>

                            <input type="text" name="subject" class="form-control-x" placeholder="موضوع پیام" required>

                            <textarea name="message" class="form-control-x"
                                placeholder="{{ $siteTexts['contact_message_placeholder']->value ?? 'شرح پروژه شما' }}"
                                required></textarea>

                            <button type="submit" id="ticketSubmit" class="btn-flow w-100 justify-content-center"
                                style="border:none">
                                <span id="ticketSubmitText">
                                    {{ $siteTexts['contact_button']->value ?? 'ارسال پیام' }}
                                    <i class="fa-solid fa-paper-plane"></i>
                                </span>

                                <span id="ticketSubmitLoading" style="display:none;">
                                    در حال ارسال...
                                    <i class="fa-solid fa-spinner fa-spin"></i>
                                </span>
                            </button>

                            <div id="ticketMessage"
                                style="display:none;margin-top:15px;padding:12px 15px;border-radius:10px;"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="blog" id="blog">
        <div class="container-x">
            <div class="blog-shell">
                <span class="blob b1"></span>
                <span class="blob b2"></span>
                <span class="blob b3"></span>

                <div class="blog-top reveal">
                    <div class="blog-avatar"><i class="fa-solid fa-pen-nib"></i></div>
                    <div>
                        <h2 class="section-title" style="margin-bottom:6px">
                            {{ $siteTexts['blog_title']->value ?? 'مقالات و نکات' }} <span
                                class="grad-text">{{ $siteTexts['blog_title_highlight']->value ?? 'دنیای دیجیتال' }}</span>
                        </h2>
                        <p class="section-sub" style="margin-bottom:0">
                            {{ $siteTexts['blog_desc']->value ?? 'آخرین یافته‌ها، راهنماها و تجربیات تیم فنی نوین‌آی' }}
                        </p>
                    </div>
                </div>

                <div class="blog-layout">

                    {{-- لیست مقالات (۴ مقاله) --}}
                    <div class="blog-list reveal">
                        @foreach($blogList as $blog)
                            <a href="{{ url('/blog/' . $blog->slug) }}" class="blog-list-item">
                                {{ $blog->title }}
                                <span class="arr"><i class="fa-solid fa-arrow-up-left"></i></span>
                            </a>
                        @endforeach
                    </div>

                    {{-- مقاله ویژه (۱ مقاله) --}}
                    @if($blogFeature)
                        <div class="blog-feature reveal reveal-delay-1">
                            <div class="deco"><img src="{{  asset($blogFeature->image_url)}}" alt="Blog"></div>
                            <div class="blog-feature-inner">
                                <div class="meta">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $blogFeature->{'reading-time'} ? $blogFeature->{'reading-time'} . ' دقیقه مطالعه' : ($siteTexts['blog_read_time']->value ?? 'زمان مطالعه: ۵ دقیقه') }}
                                </div>
                                <h5>{{ $blogFeature->title }}</h5>
                                <a href="{{ url('/blog/' . $blogFeature->slug) }}" class="pill">
                                    {{ $siteTexts['blog_read_more']->value ?? 'مطالعه مقاله' }}
                                    <i class="fa-solid fa-arrow-up-left"></i>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- کارت کناری (۲ مقاله) --}}
                    <div class="blog-side">
                        @foreach($blogSide as $blog)
                            <div class="blog-side-card reveal reveal-delay-{{ $loop->iteration + 1 }}">
                                <div class="thumb {{ $loop->first ? 'a' : 'b' }}">
                                    <i class="fa-solid {{ $loop->first ? 'fa-robot' : 'fa-mobile-screen' }}"></i>
                                </div>
                                <a href="{{ url('/blog/' . $blog->slug) }}">
                                    <div>
                                        <span class="tag">{{ $blog->category->name ?? 'مقاله' }}</span>
                                        <h6>{{ $blog->title }}</h6>
                                        <span
                                            class="time">{{ $blog->{'reading-time'} ? $blog->{'reading-time'} . ' دقیقه مطالعه' : '۵ دقیقه مطالعه' }}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="blog-more reveal">
                    <a href="{{ route('blog') }}" class="btn-ghost">
                        {{ $siteTexts['blog_all']->value ?? 'مشاهده همه مقالات' }}
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ============ LEAD MODAL (بعد از ۱۰ ثانیه خودکار باز می‌شود) ============ -->
    <div class="modal fade" id="leadModal" tabindex="-1" aria-labelledby="leadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content lead-modal-content">
                <div class="blob b1"></div>
                <div class="blob b2"></div>
                <button type="button" class="lead-modal-close" data-bs-dismiss="modal" aria-label="بستن">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="lead-modal-body">
                    <span class="eyebrow">
                        <i class="fa-solid fa-bolt"></i> پیشنهاد ویژه
                    </span>
                    <h3 id="leadModalLabel">می‌خوای پروژه‌تو شروع کنی؟</h3>
                    <p>
                        برای ارتباط با پشتیبانی و ثبت سفارش پروژه‌ت، شماره‌تو بذار؛ کارشناس‌های
                        ما کمتر از ۲۴ ساعت باهات تماس می‌گیرن. 🚀
                    </p>
                    <form id="leadForm" onsubmit="return false;" novalidate>
                        <input class="form-control-x" type="tel" id="leadPhone" placeholder="مثلاً ۰۹۱۲۳۴۵۶۷۸۹" required
                            pattern="^0?9\d{9}$" inputmode="numeric">
                        <button type="submit" class="btn-flow">
                            ثبت شماره و شروع مشاوره رایگان
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </form>
                    <div class="lead-modal-success" id="leadModalSuccess">
                        <i class="fa-solid fa-circle-check"></i>
                        <h4>ممنون!</h4>
                        <p>شماره‌ت ثبت شد؛ به‌زودی همکاران ما باهات تماس می‌گیرن.</p>
                    </div>
                    <button type="button" class="lead-modal-skip" data-bs-dismiss="modal">
                        فعلاً نه، ممنون
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/client/index.js') }}"></script>
    <style>
        .ticket-toast {
            position: fixed;
            top: 25px;
            left: 50%;
            transform: translate(-50%, -30px) scale(.95);
            min-width: 320px;
            max-width: 90%;
            padding: 16px 20px;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 16px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 13px;
            z-index: 99999;
            opacity: 0;
            visibility: hidden;
            transition:
                opacity .35s ease,
                transform .35s cubic-bezier(.34, 1.56, .64, 1),
                visibility .35s;
            direction: rtl;
        }

        .ticket-toast.show {
            opacity: 1;
            visibility: visible;
            transform: translate(-50%, 0) scale(1);
        }

        .ticket-toast.hide {
            opacity: 0;
            visibility: hidden;
            transform: translate(-50%, -25px) scale(.95);
            transition:
                opacity .3s ease,
                transform .3s ease,
                visibility .3s;
        }

        .ticket-toast-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;
            border-radius: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            font-size: 20px;
            box-shadow: 0 7px 18px rgba(16, 185, 129, .3);
        }

        .ticket-toast-content {
            flex: 1;
        }

        .ticket-toast-title {
            font-size: 14px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 3px;
        }

        .ticket-toast-text {
            font-size: 12px;
            color: #6b7280;
            line-height: 1.7;
        }

        .ticket-toast-close {
            width: 28px;
            height: 28px;
            border: none;
            background: transparent;
            color: #9ca3af;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: .2s;
        }

        .ticket-toast-close:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .ticket-toast-progress {
            position: absolute;
            bottom: 0;
            right: 0;
            height: 3px;
            width: 100%;
            background: linear-gradient(90deg, #10b981, #34d399);
            border-radius: 0 0 16px 16px;
            transform-origin: right;
        }

        .ticket-toast.show .ticket-toast-progress {
            animation: ticketToastProgress 2s linear forwards;
        }

        @keyframes ticketToastProgress {
            from {
                transform: scaleX(1);
            }

            to {
                transform: scaleX(0);
            }
        }

        @media (max-width: 576px) {
            .ticket-toast {
                min-width: auto;
                width: calc(100% - 30px);
                top: 15px;
            }
        }
    </style>

    <div id="ticketToast" class="ticket-toast">
        <div class="ticket-toast-icon">
            <i class="fa-solid fa-check"></i>
        </div>

        <div class="ticket-toast-content">
            <div class="ticket-toast-title">
                پیام با موفقیت ارسال شد
            </div>

            <div class="ticket-toast-text" id="ticketToastText">
                درخواست شما ثبت شد.
            </div>
        </div>

        <button type="button" class="ticket-toast-close" id="ticketToastClose">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="ticket-toast-progress"></div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('ticketForm');
            const submitButton = document.getElementById('ticketSubmit');
            const submitText = document.getElementById('ticketSubmitText');
            const submitLoading = document.getElementById('ticketSubmitLoading');

            const toast = document.getElementById('ticketToast');
            const toastText = document.getElementById('ticketToastText');
            const toastClose = document.getElementById('ticketToastClose');
            const toastProgress = toast.querySelector('.ticket-toast-progress');

            let toastTimer = null;

            function showTicketToast(message) {

                clearTimeout(toastTimer);

                toastText.textContent = message;

                toast.classList.remove('hide');
                toast.classList.add('show');

                // ریست کردن انیمیشن Progress
                toastProgress.style.animation = 'none';
                void toastProgress.offsetWidth;
                toastProgress.style.animation = 'ticketToastProgress 2s linear forwards';

                toastTimer = setTimeout(function () {
                    hideTicketToast();
                }, 2000);
            }

            function hideTicketToast() {

                clearTimeout(toastTimer);

                toast.classList.remove('show');
                toast.classList.add('hide');

                setTimeout(function () {
                    toast.classList.remove('hide');
                }, 350);
            }

            toastClose.addEventListener('click', function () {
                hideTicketToast();
            });

            form.addEventListener('submit', function (e) {

                e.preventDefault();

                submitButton.disabled = true;
                submitText.style.display = 'none';
                submitLoading.style.display = 'inline';

                const formData = new FormData(form);

                fetch('{{ route('tickets.store') }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                    .then(async response => {

                        const data = await response.json();

                        if (!response.ok) {
                            throw {
                                status: response.status,
                                data: data
                            };
                        }

                        return data;
                    })
                    .then(data => {

                        form.reset();

                        showTicketToast(
                            data.message || 'تیکت شما با موفقیت ثبت شد.'
                        );
                    })
                    .catch(error => {

                        let errorMessage =
                            'ارسال پیام با خطا مواجه شد. لطفاً دوباره تلاش کنید.';

                        if (
                            error.data &&
                            error.data.errors
                        ) {
                            const firstError =
                                Object.values(error.data.errors)[0];

                            if (firstError && firstError.length) {
                                errorMessage = firstError[0];
                            }
                        }

                        alert(errorMessage);
                    })
                    .finally(() => {

                        submitButton.disabled = false;
                        submitText.style.display = 'inline';
                        submitLoading.style.display = 'none';

                    });

            });

            /* ============ LEAD MODAL (بعد از ۱۰ ثانیه خودکار باز می‌شود) ============ */
            (function () {
                const leadModalEl = document.getElementById("leadModal");
                if (!leadModalEl) return;

                const leadModal = new bootstrap.Modal(leadModalEl);
                const leadForm = document.getElementById("leadForm");
                const leadPhone = document.getElementById("leadPhone");
                const leadSuccess = document.getElementById("leadModalSuccess");

                // اگر می‌خواهید مودال در هر بار ورود به سایت (هر بار رفرش) نمایش داده شود
                // خط زیر و شرط «alreadyShown» را حذف کنید و به‌جایش فقط setTimeout را بگذارید.
                const alreadyShown = sessionStorage.getItem("manaLeadModalShown");

                if (!alreadyShown) {
                    setTimeout(() => {
                        leadModal.show();
                        sessionStorage.setItem("manaLeadModalShown", "1");
                    }, 10000); // 10 ثانیه
                }

                leadForm.addEventListener("submit", (e) => {
                    e.preventDefault();
                    if (!leadForm.checkValidity()) {
                        leadForm.reportValidity();
                        return;
                    }

                    // بستن خودکار مودال بعد از نمایش پیام موفقیت
                    setTimeout(() => {
                        leadModal.hide();
                    }, 2500);
                });

                // ریست فرم هر بار که مودال دوباره بسته/باز شود
                leadModalEl.addEventListener("hidden.bs.modal", () => {
                    leadForm.reset();
                    leadForm.style.display = "";
                    leadSuccess.classList.remove("show");
                });
            })();


        });
    </script>
@endsection