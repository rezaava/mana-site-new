@extends('admin.panel')

@section('content')
    <div style="padding:20px;">
        <div style="background:var(--card-bg);border-radius:12px;padding:20px;">
            <h5 style="margin-bottom:20px;">
            <i class="fa-solid fa-text-height"></i> مدیریت متن‌های سایت
            </h5>

            @if(session('success'))

            <div style="background:rgba(16,185,129,.1);border:1px solid #10b981;color:#10b981;padding:12px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('site-texts.update') }}" method="POST">
            @csrf
            @method('PUT')

            @foreach($texts as $key => $item)

            <div style="margin-bottom:18px;">
            <label style="display:block;margin-bottom:6px;font-weight:600;color:var(--accent);">
            {{ $item['label'] }}
            </label>

            <input
            type="text"
            name="{{ $key }}"
            value="{{ old($key, $item['value']) }}"
            style="width:100%;padding:10px;border-radius:8px;border:1px solid var(--border);background:transparent;color:inherit;"

            >

            </div>
            @endforeach

            <button type="submit" class="btn btn-primary" style="padding:10px 20px;border-radius:8px;border:none;cursor:pointer;">
            <i class="fa-solid fa-save"></i> ذخیره همه
            </button>
            </form>
        </div>
    </div>
@endsection
