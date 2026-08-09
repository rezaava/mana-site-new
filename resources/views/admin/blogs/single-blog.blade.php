@extends('admin.panel')

@section('content')
<div style="padding: 20px; max-width: 900px; margin: 0 auto;">
    <a href="javascript:history.back()" class="btn btn-sm btn-secondary" style="margin-bottom: 20px;">
        <i class="fa-solid fa-arrow-right"></i> بازگشت به لیست
    </a>

    <div style="background: var(--card-bg); border-radius: 12px; padding: 25px;">
        <h2 style="margin-bottom: 15px; font-weight: bold;">{{ $blog->title }}</h2>

        <div style="display: flex; gap: 15px; color: var(--text-light); font-size: 0.9rem; margin-bottom: 20px;">
            <span><i class="fa-solid fa-hashtag"></i> شناسه: {{ $blog->id }}</span>
            <span><i class="fa-solid fa-clock"></i> زمان مطالعه: {{ $blog->{'reading-time'} ?? 'نامشخص' }} دقیقه</span>
            <span><i class="fa-solid fa-sort"></i> اولویت نمایش: {{ $blog->number }}</span>
        </div>

        <div style="margin-bottom: 25px; text-align: center;">
            @if($blog->image_full_path)
                <img src="{{ $blog->image_full_path }}" alt="{{ $blog->title }}" style="max-width: 100%; max-height: 400px; border-radius: 10px; object-fit: cover;">
            @else
                <div style="padding: 40px; background: rgba(255,255,255,0.05); border-radius: 10px; color: var(--text-light);">
                    <i class="fa-solid fa-image fa-3x"></i>
                    <p style="margin-top: 10px;">تصویری برای این مقاله ثبت نشده است</p>
                </div>
            @endif
        </div>

        <div style="line-height: 1.8; font-size: 1.05rem; white-space: pre-line;">
            {{ $blog->text }}
        </div>
    </div>
</div>
@endsection