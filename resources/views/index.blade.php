@extends('layout.master')

@section('title')
ملیسان | صفحه اصلی
@endsection

@section('head')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
<span class="grad-text">{{ $siteTexts['hero_title_highlight']->value ?? 'امروز شروع می‌شود' }}</span>
</h1>
<p class="lead-x">{{ $siteTexts['hero_desc']->value ?? 'از ایده تا محصول؛ تیم نوین‌آی با ترکیب هوش مصنوعی، طراحی مدرن و مهندسی دقیق، محصولاتی می‌سازد که کسب‌وکار شما را برای فردا آماده می‌کند.' }}</p>
<div class="hero-btns">
<a href="#contact" class="btn-flow">{{ $siteTexts['hero_cta']->value ?? 'شروع پروژه' }} <i class="fa-solid fa-arrow-left"></i></a>
<a href="#folio" class="btn-ghost"><i class="fa-solid fa-play"></i>{{ $siteTexts['hero_secondary_cta']->value ?? 'مشاهده نمونه‌کارها' }}</a>
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
$projectsCount=$stats['projects_count']??Projects::count();
$customersCount=$stats['customers_count']??'۵۰+';
$supportHours=$stats['support_hours']??'۲۴/۷';
$satisfaction=$stats['satisfaction']??'۹۸%';
$toEnglishNumber=function($number){
return strtr((string)$number,['۰'=>'0','۱'=>'1','۲'=>'2','۳'=>'3','۴'=>'4','۵'=>'5','۶'=>'6','۷'=>'7','۸'=>'8','۹'=>'9']);
};
$projectsTarget=preg_replace('/[^0-9]/','',$toEnglishNumber($projectsCount))?:'0';
$customersTarget=preg_replace('/[^0-9]/','',$toEnglishNumber($customersCount))?:'0';
$supportTarget=preg_replace('/[^0-9]/','',$toEnglishNumber($supportHours))?:'0';
$satisfactionTarget=preg_replace('/[^0-9]/','',$toEnglishNumber($satisfaction))?:'0';
@endphp

<div class="stat-strip-outer">
<div class="container-x">
<div class="stat-strip reveal">
<div class="row g-3">
<div class="col-6 col-md-3 stat-item">
<h3><span class="count-num" data-target="{{ $projectsTarget }}">۰</span>@if(str_contains((string)$projectsCount,'+'))<span class="grad-text">+</span>@endif</h3>
<span>{{ $siteTexts['stat1_text']->value ?? 'پروژه موفق' }}</span>
</div>
<div class="col-6 col-md-3 stat-item">
<h3><span class="count-num" data-target="{{ $satisfactionTarget }}">۰</span><span class="grad-text">%</span></h3>
<span>{{ $siteTexts['stat2_text']->value ?? 'رضایت مشتریان' }}</span>
</div>
<div class="col-6 col-md-3 stat-item">
<h3><span class="count-num" data-target="{{ $customersTarget }}">۰</span><span class="grad-text">+</span></h3>
<span>{{ $siteTexts['stat3_text']->value ?? 'مشتری فعال' }}</span>
</div>
<div class="col-6 col-md-3 stat-item">
<h3><span class="count-num" data-target="{{ $supportTarget }}">۰</span><span class="grad-text">/۷</span></h3>
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
<span class="eyebrow"><i class="fa-solid fa-layer-group"></i>{{ $siteTexts['services_badge']->value ?? 'خدمات ما' }}</span>
<h2 class="section-title">{!! nl2br(e($siteTexts['services_title']->value ?? 'هر آنچه برای رشد دیجیتال نیاز دارید، اینجاست')) !!}</h2>
</div>
<p class="section-sub col">{{ $siteTexts['services_desc']->value ?? 'از هوش مصنوعی تا اپلیکیشن موبایل؛ راهکارهایی که بر پایه‌ی داده، طراحی و مهندسی مدرن ساخته شده‌اند.' }}</p>
</div>
<div class="flow-wrap">
<svg class="flow-svg" viewBox="0 0 1200 500" preserveAspectRatio="none">
<path d="M0,250 C200,100 300,400 600,250 C900,100 1000,400 1200,250" stroke="url(#g1)" stroke-width="1.5" fill="none"/>
<defs>
<linearGradient id="g1" x1="0" y1="0" x2="1" y2="0">
<stop offset="0%" stop-color="#2f7dfb"/>
<stop offset="100%" stop-color="#17c3b2"/>
</linearGradient>
</defs>
</svg>
<div class="svc-grid">
@foreach($services as $index=>$service)
<a href="{{ route('servise', $service->id) }}">
    <div class="svc-card reveal reveal-delay-{{ ($index%3)+1 }}" data-tilt>
    <span class="svc-num">{{ str_pad($index+1,2,'0',STR_PAD_LEFT) }}</span>
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
<div style="font-size:.82rem;font-weight:600">{{ $siteTexts['experience_title']->value ?? 'سال تجربه' }}</div>
<div style="font-size:.74rem;color:var(--text-dim)">{{ $siteTexts['experience_desc']->value ?? 'در ساخت محصولات دیجیتال' }}</div>
</div>
</div>
</div>
</div>
<div class="col-lg-7">
<span class="eyebrow reveal"><i class="fa-solid fa-star"></i>{{ $siteTexts['why_badge']->value ?? 'چرا مانا' }}</span>
<h2 class="section-title reveal reveal-delay-1">{{ $siteTexts['why_title']->value ?? 'شریکی که رشد دیجیتال شما را جدی می‌گیرد' }}</h2>
<ul class="why-list">
<li class="reveal reveal-delay-1">
<div class="ico"><i class="fa-solid fa-user-graduate"></i></div>
<div>
<h4>{{ $siteTexts['why1_title']->value ?? 'تیمی متخصص و باتجربه' }}</h4>
<p>{{ $siteTexts['why1_desc']->value ?? 'متخصصانی با سال‌ها تجربه در پروژه‌های واقعی و پیچیده.' }}</p>
</div>
</li>
<li class="reveal reveal-delay-2">
<div class="ico"><i class="fa-solid fa-medal"></i></div>
<div>
<h4>{{ $siteTexts['why2_title']->value ?? 'کیفیت تضمین‌شده' }}</h4>
<p>{{ $siteTexts['why2_desc']->value ?? 'تست و بازبینی دقیق در هر مرحله از توسعه‌ی پروژه.' }}</p>
</div>
</li>
<li class="reveal reveal-delay-3">
<div class="ico"><i class="fa-solid fa-headset"></i></div>
<div>
<h4>{{ $siteTexts['why3_title']->value ?? 'پشتیبانی ۲۴/۷' }}</h4>
<p>{{ $siteTexts['why3_desc']->value ?? 'همراهی و پاسخگویی سریع در تمام ساعات شبانه‌روز.' }}</p>
</div>
</li>
<li class="reveal reveal-delay-4">
<div class="ico"><i class="fa-solid fa-tags"></i></div>
<div>
<h4>{{ $siteTexts['why4_title']->value ?? 'قیمت‌گذاری شفاف' }}</h4>
<p>{{ $siteTexts['why4_desc']->value ?? 'بدون هزینه‌ی پنهان؛ برآورد دقیق پیش از شروع کار.' }}</p>
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
<span class="eyebrow"><i class="fa-solid fa-briefcase"></i>{{ $siteTexts['folio_badge']->value ?? 'نمونه‌کارها' }}</span>
<h2 class="section-title">{{ $siteTexts['folio_title']->value ?? 'بخشی از پروژه‌های موفق ما' }}</h2>
</div>
<div class="col-md-4">
<p class="section-sub" style="margin-top:12px">{{ $siteTexts['folio_desc']->value ?? 'روی هر مورد کلیک کنید تا جزئیات پروژه را ببینید.' }}</p>
</div>
</div>
<div class="folio-shell reveal">
<div class="folio-tabs" id="folioTabs">
@foreach($projects as $index=>$project)
<div class="folio-tab {{ $index===0?'active':'' }}" data-index="{{ $index }}" data-project="{{ $project->id }}" data-description="{{ $project->description }}" data-from="{{ $project->from ?? '#1d2a6b' }}" data-to="{{ $project->to ?? '#0b1030' }}" data-url="{{ route('projects.show',$project->id) }}">
<div class="ft-ic"><i class="{{ $project->icon ?? 'fa-solid fa-briefcase' }}"></i></div>
<div>
<h5>{{ $project->title }}</h5>
<span>{{ $project->category->name ?? 'پروژه' }}</span>
</div>
<div class="bar"></div>
</div>
@endforeach
</div>
<div class="folio-mobile-tabs" id="folioMobileTabs">
@foreach($projects as $index=>$project)
<div class="fmt-chip {{ $index===0?'active':'' }}" data-index="{{ $index }}">{{ $project->category->name ?? $project->title }}</div>
@endforeach
</div>
<div class="folio-preview" id="folioPreview">
<div class="fp-dots" id="fpDots">
@foreach($projects as $index=>$project)
<span class="{{ $index===0?'active':'' }}"></span>
@endforeach
</div>
@php
$firstProject=$projects->first();
@endphp
@if($firstProject)
<div class="fp-bg" id="fpBg" style="background:linear-gradient(150deg,{{ $firstProject->from ?? '#1d2a6b' }},{{ $firstProject->to ?? '#0b1030' }})"></div>
<div class="fp-content" id="fpContent">
<span class="tag">{{ $firstProject->category->name ?? 'پروژه' }}</span>
<h4>{{ $firstProject->title }}</h4>
<p>{{ $firstProject->description }}</p>
<a href="{{ route('projects.show',$firstProject->id) }}" class="pill">مشاهده جزئیات <i class="fa-solid fa-arrow-up-left"></i></a>
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
<span class="eyebrow"><i class="fa-solid fa-people-group"></i>{{ $siteTexts['team_badge']->value ?? 'تیم ما' }}</span>
<h2 class="section-title">{{ $siteTexts['team_title']->value ?? 'متخصصانی که ایده شما را می‌سازند' }}</h2>
</div>
<div class="team-grid">
@foreach($teams as $index=>$team)
<div class="team-card reveal reveal-delay-{{ ($index%4)+1 }}">
<div class="team-ring">
<div class="team-avatar tc{{ ($index%5)+1 }}">
<img src="{{ asset($team->image) }}" alt="{{ $team->name }}">
<div class="ov">
@if($team->linkedin)<a href="{{ $team->linkedin }}"><i class="fa-brands fa-linkedin-in"></i></a>@endif
@if($team->instagram)<a href="{{ $team->instagram }}"><i class="fa-brands fa-instagram"></i></a>@endif
</div>
</div>
</div>
<h4>{{ $team->name }}</h4>
<p>{{ $team->position }}</p>
</div>
@endforeach
</div>
</div>
</section>

{{-- <section class="testi">
<div class="container-x">
<div class="text-center mb-5 reveal">
<span class="eyebrow"><i class="fa-solid fa-comment-dots"></i>{{ $siteTexts['comments_badge']->value ?? 'نظرات مشتریان' }}</span>
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
<span class="eyebrow reveal"><i class="fa-solid fa-circle-question"></i>{{ $siteTexts['faq_badge']->value ?? 'سوالات متداول' }}</span>
<h2 class="section-title reveal reveal-delay-1 mb-4">{{ $siteTexts['faq_title']->value ?? 'پاسخ سوالات رایج شما' }}</h2>
<div class="acc-list">
@foreach($questions as $index=>$question)
<div class="acc-item {{ $index===0?'open':'' }} reveal reveal-delay-{{ ($index%4)+1 }}">
<button class="acc-btn">{{ $question->question }} <i class="fa-solid fa-plus"></i></button>
<div class="acc-panel"><p>{{ $question->answer }}</p></div>
</div>
@endforeach
</div>
</div>

<div class="col-lg-6">
<div class="contact-card reveal reveal-delay-2">
<span class="eyebrow"><i class="fa-solid fa-paper-plane"></i>{{ $siteTexts['contact_badge']->value ?? 'تماس با ما' }}</span>
<h3 style="font-weight:800;font-size:1.5rem;margin-bottom:6px">{{ $siteTexts['contact_title']->value ?? 'برای مشاوره رایگان با ما تماس بگیرید' }}</h3>
<p class="section-sub" style="margin-bottom:26px">{{ $siteTexts['contact_desc']->value ?? 'فرم زیر را پر کنید تا در کمتر از ۲۴ ساعت با شما تماس بگیریم.' }}</p>
<form onsubmit="return false;">
<div class="row">
<div class="col-sm-6"><input class="form-control-x" placeholder="{{ $siteTexts['contact_name_placeholder']->value ?? 'نام و نام‌خانوادگی' }}"></div>
<div class="col-sm-6"><input class="form-control-x" placeholder="{{ $siteTexts['contact_phone_placeholder']->value ?? 'شماره تماس' }}"></div>
</div>
<input class="form-control-x" placeholder="{{ $siteTexts['contact_email_placeholder']->value ?? 'ایمیل' }}">
<textarea class="form-control-x" placeholder="{{ $siteTexts['contact_message_placeholder']->value ?? 'شرح پروژه شما' }}"></textarea>
<button class="btn-flow w-100 justify-content-center" style="border:none">{{ $siteTexts['contact_button']->value ?? 'ارسال پیام' }} <i class="fa-solid fa-paper-plane"></i></button>
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
<h2 class="section-title" style="margin-bottom:6px">{{ $siteTexts['blog_title']->value ?? 'مقالات و نکات' }} <span class="grad-text">{{ $siteTexts['blog_title_highlight']->value ?? 'دنیای دیجیتال' }}</span></h2>
<p class="section-sub" style="margin-bottom:0">{{ $siteTexts['blog_desc']->value ?? 'آخرین یافته‌ها، راهنماها و تجربیات تیم فنی نوین‌آی' }}</p>
</div>
</div>

<div class="blog-layout">
<div class="blog-list reveal">
@foreach($blogs as $blog)
<a href="/blog/{{ $blog->id }}" class="blog-list-item">{{ $blog->title }} <span class="arr"><i class="fa-solid fa-arrow-up-left"></i></span></a>
@endforeach
</div>

@php
$featuredBlog=$blogs->first();
@endphp

@if($featuredBlog)
<div class="blog-feature reveal reveal-delay-1">
<div class="deco"><img src="{{ asset('img/mana2.jpg') }}" alt="Blog"></div>
<div class="blog-feature-inner">
<div class="meta"><i class="fa-regular fa-clock"></i>{{ $featuredBlog->read_time ?? $siteTexts['blog_read_time']->value ?? 'زمان مطالعه: ۵ دقیقه' }}</div>
<h5>{{ $featuredBlog->title }}</h5>
<a href="{{ url('/singleblog/'.$featuredBlog->id) }}" class="pill">{{ $siteTexts['blog_read_more']->value ?? 'مطالعه مقاله' }} <i class="fa-solid fa-arrow-up-left"></i></a>
</div>
</div>
@endif

<div class="blog-side">
@foreach($blogs->skip(1)->take(2) as $blog)
<div class="blog-side-card reveal reveal-delay-{{ $loop->iteration+1 }}">
<div class="thumb {{ $loop->first?'a':'b' }}"><i class="fa-solid {{ $loop->first?'fa-robot':'fa-mobile-screen' }}"></i></div>
<a href="{{ url('/blog/'.$blog->id) }}">
<div>
<span class="tag">{{ $blog->category->name ?? 'مقاله' }}</span>
<h6>{{ $blog->title }}</h6>
<span class="time">{{ $blog->read_time ?? '۵ دقیقه مطالعه' }}</span>
</div>
</a>
</div>
@endforeach
</div>
</div>

<div class="blog-more reveal">
<a href="{{ url('/blog.html') }}" class="btn-ghost">{{ $siteTexts['blog_all']->value ?? 'مشاهده همه مقالات' }} <i class="fa-solid fa-arrow-left"></i></a>
</div>
</div>
</div>
</section>

@endsection

@section('js')
<script src="{{ asset('js/client/index.js') }}"></script>
@endsection