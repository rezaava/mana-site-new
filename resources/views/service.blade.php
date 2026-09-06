@extends('layout.master')

@section('title')
    ملیسان | {{ $service->title }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/servise.css') }}">
@endsection

@section('main')

<!-- ========================================================= -->
<!-- HERO -->
<!-- ========================================================= -->

<section class="case-hero" id="top">

    <div class="container-x">

        <div class="breadcrumb-x reveal in">

            <a href="{{ url('/') }}">خانه</a>

            <i class="fa-solid fa-chevron-left"></i>

            <a href="{{ url('/services') }}">خدمات</a>

            <i class="fa-solid fa-chevron-left"></i>

            <span class="cur">
                {{ $service->title }}
            </span>

        </div>


        <div class="row align-items-center g-4">

            <div class="col-lg-6">

                <span class="eyebrow reveal in">

                    @if($service->icon)
                        <i class="fa-solid {{ $service->icon }}"></i>
                    @else
                        <i class="fa-solid fa-layer-group"></i>
                    @endif

                    {{ $service->title }}

                </span>


                <h1 class="reveal in">
                    {{ $service->description ?? $service->title }}
                </h1>


                <p
                    class="section-sub reveal in reveal-delay-1"
                    style="margin-bottom:0"
                >
                    {{ $service->text }}
                </p>


                <div class="case-meta-row reveal in reveal-delay-2">

                    @if($service->delivery_time)

                        <div class="case-meta-chip">

                            <i class="fa-regular fa-clock"></i>

                            {{ $service->delivery_time }}

                        </div>

                    @endif


                    @if($service->price_text)

                        <div class="case-meta-chip">

                            <i class="fa-solid fa-tags"></i>

                            {{ $service->price_text }}

                        </div>

                    @endif


                    @if($service->support)

                        <div class="case-meta-chip">

                            <i class="fa-solid fa-headset"></i>

                            {{ $service->support }}

                        </div>

                    @endif

                </div>


                <div class="case-hero-btns reveal in reveal-delay-3">

                    <a
                        href="{{ url('/#contact') }}"
                        class="btn-flow"
                    >
                        دریافت مشاوره رایگان

                        <i class="fa-solid fa-arrow-left"></i>
                    </a>


                    <a
                        href="{{ url('/services') }}"
                        class="btn-ghost"
                    >
                        <i class="fa-solid fa-arrow-right"></i>

                        بازگشت به همه خدمات

                    </a>

                </div>

            </div>


            <div class="col-lg-6">

                <div class="ss-hero-visual reveal in reveal-delay-1">

                    @if($service->image_url)

                        <img
                            src="{{ asset('storage/' . $service->image_url) }}"
                            alt="{{ $service->title }}"
                            style="
                                max-width:100%;
                                max-height:400px;
                                object-fit:contain;
                                position:relative;
                                z-index:5;
                            "
                        >

                    @else

                        <div class="blob"></div>

                        <div class="orbit"></div>

                        <div class="orbit o2"></div>

                        <div class="core">

                            <i class="fa-solid {{ $service->icon ?? 'fa-layer-group' }}"></i>

                        </div>

                        <div class="float-chip c1">

                            <i class="fa-solid fa-robot"></i>

                        </div>

                        <div class="float-chip c2">

                            <i class="fa-solid fa-chart-line"></i>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ========================================================= -->
<!-- STATES -->
<!-- ========================================================= -->

@if($state)

<div class="stat-strip-outer">

    <div class="container-x">

        <div class="stat-strip reveal">

            <div class="row g-3">

                @if($state->text_1 || $state->value_1)

                    <div class="col-6 col-md-3 stat-item">

                        <h6>
                            {{ $state->value_1 }}
                        </h6>

                        <span>
                            {{ $state->text_1 }}
                        </span>

                    </div>

                @endif


                @if($state->text_2 || $state->value_2)

                    <div class="col-6 col-md-3 stat-item">

                        <h6>
                            {{ $state->value_2 }}
                        </h6>

                        <span>
                            {{ $state->text_2 }}
                        </span>

                    </div>

                @endif


                @if($state->text_3 || $state->value_3)

                    <div class="col-6 col-md-3 stat-item">

                        <h6>
                            {{ $state->value_3 }}
                        </h6>

                        <span>
                            {{ $state->text_3 }}
                        </span>

                    </div>

                @endif


                @if($state->text_4 || $state->value_4)

                    <div class="col-6 col-md-3 stat-item">

                        <h6>
                            {{ $state->value_4 }}
                        </h6>

                        <span>
                            {{ $state->text_4 }}
                        </span>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endif


<!-- ========================================================= -->
<!-- OVERVIEW -->
<!-- ========================================================= -->

<section class="overview" id="overview">

    <div class="container-x">

        <div class="row g-5">

            <div class="col-lg-7">

                @if($service->overview)

                    <span class="eyebrow reveal">

                        <i class="fa-solid fa-circle-info"></i>

                        معرفی خدمت

                    </span>


                    <div class="cs-block reveal reveal-delay-1">

                        {!! $service->overview !!}

                    </div>

                @endif


                <div class="cs-cards reveal reveal-delay-2">

                    @if($service->challenge_title || $service->challenge_text)

                        <div class="cs-card challenge">

                            <div class="ic">

                                <i class="fa-solid fa-triangle-exclamation"></i>

                            </div>


                            @if($service->challenge_title)

                                <h4>
                                    {{ $service->challenge_title }}
                                </h4>

                            @endif


                            @if($service->challenge_text)

                                <p>
                                    {{ $service->challenge_text }}
                                </p>

                            @endif

                        </div>

                    @endif


                    @if($service->solution_title || $service->solution_text)

                        <div class="cs-card solution">

                            <div class="ic">

                                <i class="fa-solid fa-lightbulb"></i>

                            </div>


                            @if($service->solution_title)

                                <h4>
                                    {{ $service->solution_title }}
                                </h4>

                            @endif


                            @if($service->solution_text)

                                <p>
                                    {{ $service->solution_text }}
                                </p>

                            @endif

                        </div>

                    @endif

                </div>

            </div>


            <div class="col-lg-5">

                @if($service->quote_text || $service->quote_person || $service->quote_role)

                    <div class="quote-card reveal reveal-delay-1">

                        <i class="fa-solid fa-quote-right q"></i>

                        <div>

                            @if($service->quote_text)

                                <p>
                                    {{ $service->quote_text }}
                                </p>

                            @endif


                            <div class="who">

                                <div class="av">

                                    @if($service->quote_person)

                                        {{ mb_substr($service->quote_person, 0, 2) }}

                                    @else

                                        --

                                    @endif

                                </div>


                                <div>

                                    @if($service->quote_person)

                                        <h6>
                                            {{ $service->quote_person }}
                                        </h6>

                                    @endif


                                    @if($service->quote_role)

                                        <span>
                                            {{ $service->quote_role }}
                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>


<!-- ========================================================= -->
<!-- WHAT RECEIVE -->
<!-- ========================================================= -->

<section class="features" id="included">

    <div class="container-x">

        <div class="text-center mb-5 reveal">

            <span class="eyebrow">

                <i class="fa-solid fa-layer-group"></i>

                چه چیزی شامل می‌شود

            </span>


            <h2 class="section-title">

                در این خدمت، چه چیزی دریافت می‌کنید

            </h2>

        </div>


        <div class="incl-grid">

            @foreach($whatReceives as $index => $item)

                <div
                    class="incl-card reveal reveal-delay-{{ ($index % 3) + 1 }}"
                    data-tilt
                >

                    <span class="incl-index">

                        {{ sprintf('%02d', $index + 1) }}

                    </span>


                    <div class="incl-icon">

                        <i class="fa-solid {{ $item->icon ?? 'fa-check' }}"></i>

                    </div>


                    <div class="incl-body">

                        <h3>
                            {{ $item->title }}
                        </h3>

                        <p>
                            {{ $item->text }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>


<!-- ========================================================= -->
<!-- TECHNOLOGIES -->
<!-- ========================================================= -->

<section class="techstack" id="tools">

    <div class="container-x">

        <div class="text-center mb-4 reveal">

            <span class="eyebrow">

                <i class="fa-solid fa-toolbox"></i>

                ابزارها و تکنولوژی‌ها

            </span>


            <h2 class="section-title">

                با چه ابزارهایی کار می‌کنیم

            </h2>

        </div>


        <div class="tech-row reveal reveal-delay-1">

            @foreach($techs as $tech)

                <div class="tech-pill">

                    <i class="fa-solid {{ $tech->icon ?? 'fa-microchip' }}"></i>

                    {{ $tech->text }}

                </div>

            @endforeach

        </div>

    </div>

</section>


<!-- ========================================================= -->
<!-- SERVICE QUICK FACTS -->
<!-- ========================================================= -->

<section class="pinfo" id="facts">

    <div class="container-x">

        <div class="text-center mb-4 reveal">

            <span class="eyebrow">

                <i class="fa-solid fa-circle-info"></i>

                اطلاعات خدمت

            </span>


            <h2 class="section-title">

                این خدمت به‌طور خلاصه

            </h2>

        </div>


        <div class="pinfo-grid reveal reveal-delay-1">

            @if($service->delivery_time)

                <div class="pinfo-card">

                    <i class="fa-regular fa-clock"></i>

                    <h6>
                        زمان تحویل
                    </h6>

                    <p>
                        {{ $service->delivery_time }}
                    </p>

                </div>

            @endif


            @if($service->suitable_for)

                <div class="pinfo-card">

                    <i class="fa-solid fa-users"></i>

                    <h6>
                        مناسب برای
                    </h6>

                    <p>
                        {{ $service->suitable_for }}
                    </p>

                </div>

            @endif


            @if($service->support)

                <div class="pinfo-card">

                    <i class="fa-solid fa-headset"></i>

                    <h6>
                        پشتیبانی
                    </h6>

                    <p>
                        {{ $service->support }}
                    </p>

                </div>

            @endif


            @if($service->contract)

                <div class="pinfo-card">

                    <i class="fa-solid fa-shield-halved"></i>

                    <h6>
                        قرارداد
                    </h6>

                    <p>
                        {{ $service->contract }}
                    </p>

                </div>

            @endif

        </div>


        @if($whatReceives->count())

            <div class="pinfo-services reveal reveal-delay-2">

                @foreach($whatReceives as $item)

                    <span>
                        {{ $item->title }}
                    </span>

                @endforeach

            </div>

        @endif

    </div>

</section>


<!-- ========================================================= -->
<!-- RELATED SERVICES -->
<!-- ========================================================= -->

<section class="similar" id="related">

    <div class="container-x">

        <div class="text-center mb-5 reveal">

            <span class="eyebrow">

                <i class="fa-solid fa-layer-group"></i>

                خدمات مرتبط

            </span>


            <h2 class="section-title">

                شاید این خدمات هم به کارتان بیایند

            </h2>

        </div>


        <div class="sim-grid">

            @php

                $relatedServices = \App\Models\Services::where(
                    'id',
                    '!=',
                    $service->id
                )
                ->orderBy('number', 'asc')
                ->limit(3)
                ->get();

            @endphp


            @foreach($relatedServices as $index => $related)

                <div class="sim-card reveal reveal-delay-{{ $index + 1 }}">

                    <div class="sim-thumb t{{ $index + 1 }}">

                        <i class="fa-solid {{ $related->icon ?? 'fa-layer-group' }}"></i>

                    </div>


                    <div class="sim-body">

                        <span class="tag">
                            {{ $related->title }}
                        </span>


                        <h4>
                            {{ $related->description ?? $related->title }}
                        </h4>


                        <a href="{{ route('servise', $related->id) }}">

                            مشاهده جزئیات

                            <i class="fa-solid fa-arrow-up-left"></i>

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>


<!-- ========================================================= -->
<!-- FINAL CTA -->
<!-- ========================================================= -->

<section class="final-cta">

    <div class="container-x">

        <div class="cta-banner reveal">

            @if($service->cta_title)

                <h2>
                    {{ $service->cta_title }}
                </h2>

            @endif


            @if($service->cta_text)

                <p>
                    {{ $service->cta_text }}
                </p>

            @endif


            <a
                href="{{ url('/#contact') }}"
                class="btn-flow"
            >

                شروع پروژه

                <i class="fa-solid fa-arrow-left"></i>

            </a>

        </div>

    </div>

</section>

@endsection


@section('js')

<script src="{{ asset('js/client/servise.js') }}"></script>

@endsection