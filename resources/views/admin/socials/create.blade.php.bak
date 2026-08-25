@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    {{-- Alerts Section --}}
    @if (session('success'))
        <div style="background: #10b981; color: #fff; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background: #ef4444; color: #fff; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px;">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-plus"></i> افزودن شبکه اجتماعی جدید
            </h5>
            <a href="{{ route('socials.index') }}" style="color: var(--text-light); text-decoration: none;">
                <i class="fa-solid fa-arrow-right"></i> بازگشت
            </a>
        </div>

        <form action="{{ route('socials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 8px;">نام شبکه اجتماعی</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="مثلا: تلگرام، اینستاگرام..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('name')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">آدرس لینک (URL)</label>
                    <input type="url" name="url" value="{{ old('url') }}" required placeholder="https://..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('url')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">تصویر / آیکون</label>
                <input type="file" name="image_url"  style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                @error('image_url')
                    <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                <i class="fa-solid fa-check"></i> ذخیره شبکه اجتماعی
            </button>
        </form>
    </div>
</div>
@endsection