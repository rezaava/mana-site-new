@extends('admin.panel')

@section('content')
<style>
    /* استایل‌های بخش چالش و راه‌حل */
    .project-grid-container {
        display: grid;
        grid-template-columns: 2fr 1fr; /* ستون اصلی پروژه‌ دو برابر سایدبار */
        gap: 24px;
        align-items: start;
        margin-top: 30px;
    }

    /* اگر در سایز موبایل بود، برن زیر هم */
    @media (max-width: 992px) {
        .project-grid-container {
            grid-template-columns: 1fr;
        }
    }

    .project-main-content {
        background-color: #12161f;
        border-radius: 20px;
        padding: 28px;
        color: #a0aec0;
        line-height: 1.8;
    }

    .project-sidebar {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .cs-card {
        background-color: #12161f;
        border-radius: 20px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        align-items: flex-start; /* ترازبندی با توجه به راست‌چین بودن */
        text-align: right;
    }

    .cs-card-challenge {
        border: 1px solid rgba(212, 143, 56, 0.4);
    }

    .cs-card-solution {
        border: 1px solid rgba(44, 122, 123, 0.5);
    }

    .cs-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        font-size: 20px;
    }

    .cs-icon-challenge {
        background-color: rgba(212, 143, 56, 0.15);
        color: #f5a623;
    }

    .cs-icon-solution {
        background-color: rgba(0, 168, 150, 0.15);
        color: #00d1b2;
    }

    .cs-title {
        color: #ffffff;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .cs-text {
        color: #a0aec0;
        font-size: 0.95rem;
        line-height: 1.8;
        margin: 0;
    }
</style>

<div class="container py-5" dir="rtl">
    
    {{-- هدر پروژه (عنوان و کاور) --}}
    <div class="mb-4">
        <h1 class="text-white fw-bold mb-3">{{ $project->title }}</h1>
        @if($project->image_url)
            <img src="{{ asset('storage/' . $project->image_url) }}" alt="{{ $project->title }}" class="img-fluid w-100 rounded-4 mb-4" style="max-height: 450px; object-fit: cover;">
        @endif
    </div>

    {{-- گرید اصلی: توضیحات پروژه + باکس‌های کناری --}}
    <div class="project-grid-container">
        
        {{-- بخش اصلی: درباره پروژه --}}
        <div class="project-main-content">
            <h3 class="text-white fw-bold mb-3">درباره پروژه</h3>
            <p>{{ $project->desc }}</p>
        </div>

        {{-- سایدبار کناری: چالش اصلی و راه‌حل ما --}}
        <div class="project-sidebar">
            
            {{-- باکس چالش اصلی --}}
            @if(!empty($project->challenge))
            <div class="cs-card cs-card-challenge">
                <div class="cs-icon-box cs-icon-challenge">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h4 class="cs-title">چالش اصلی</h4>
                <p class="cs-text">
                    {{ $project->challenge }}
                </p>
            </div>
            @endif

            {{-- باکس راه‌حل ما --}}
            @if(!empty($project->solution))
            <div class="cs-card cs-card-solution">
                <div class="cs-icon-box cs-icon-solution">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>
                <h4 class="cs-title">راه‌حل ما</h4>
                <p class="cs-text">
                    {{ $project->solution }}
                </p>
            </div>
            @endif

        </div>

    </div>

</div>
@endsection