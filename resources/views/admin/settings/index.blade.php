@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <h5 style="margin-bottom: 25px;">
            <i class="fa-solid fa-gear"></i> تنظیمات سایت
        </h5>

        @if(session('success'))
            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">نام سایت</label>
                    <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">ایمیل تماس</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">تلفن تماس</label>
                    <input type="text" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">آدرس</label>
                    <input type="text" name="address" value="{{ old('address', $settings['address']) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div style="grid-column: span 2;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">توضیحات سایت</label>
                    <textarea name="site_description" rows="3" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">{{ old('site_description', $settings['site_description']) }}</textarea>
                </div>

                <div style="grid-column: span 2;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500;">کلمات کلیدی</label>
                    <input type="text" name="site_keywords" value="{{ old('site_keywords', $settings['site_keywords']) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>
            </div>

            <h6 style="margin-bottom: 15px; color: var(--accent);">
                <i class="fa-solid fa-link"></i> شبکه‌های اجتماعی
            </h6>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div>
                    <label style="display: block; margin-bottom: 8px;">تلگرام</label>
                    <input type="url" name="telegram" value="{{ old('telegram', $settings['telegram']) }}" placeholder="https://t.me/..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">اینستاگرام</label>
                    <input type="url" name="instagram" value="{{ old('instagram', $settings['instagram']) }}" placeholder="https://instagram.com/..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">توییتر</label>
                    <input type="url" name="twitter" value="{{ old('twitter', $settings['twitter']) }}" placeholder="https://twitter.com/..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 12px 25px; border-radius: 8px; border: none; cursor: pointer; font-size: 15px;">
                <i class="fa-solid fa-save"></i> ذخیره تنظیمات
            </button>
        </form>
    </div>
</div>
@endsection
