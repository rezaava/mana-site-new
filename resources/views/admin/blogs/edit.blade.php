@extends('admin.panel')

@section('content')
<div style="padding: 20px;">

    {{-- آلرت‌های موفقیت، خطا و اعتبارسنجی --}}
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

    @if ($errors->any())
        <div style="background: #ef4444; color: #fff; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-right: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-pen-to-square"></i> ویرایش مقاله
            </h5>
            <a href="{{ route('blogs.index') }}" style="color: var(--text-light); text-decoration: none;">
                <i class="fa-solid fa-arrow-right"></i> بازگشت
            </a>
        </div>

        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 8px;">عنوان مقاله</label>
                    <input type="text" name="title" value="{{ old('title', $blog->title) }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('title')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">زمان مطالعه (دقیقه)</label>
                    <input type="number" name="reading-time" value="{{ old('reading-time', $blog->{'reading-time'}) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('reading-time')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">شماره / اولویت</label>
                    <input type="number" name="number" value="{{ old('number', $blog->number) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('number')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">تصویر شاخص جدید (اختیاری)</label>
                <input type="file" name="image" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                
                {{-- بخش پیش‌نمایش تصویر --}}
                <div style="margin-top: 10px;">
                    @if($blog->image_url)
                        <small style="color: var(--text-light); display: block; margin-bottom: 5px;">تصویر فعلی:</small>
                        <img src="{{ asset('storage/') }}) }} . $blog->image_url) }}" alt="{{ $blog->title }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border);">
                    @else
                        <small style="color: var(--text-light); display: block;">تصویری برای این مقاله ثبت نشده است.</small>
                    @endif
                </div>

                @error('image')
                    <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">متن مقاله</label>
                <textarea name="text" rows="8" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">{{ old('text', $blog->text) }}</textarea>
                @error('text')
                    <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                <i class="fa-solid fa-save"></i> بروزرسانی مقاله
            </button>
        </form>
    </div>
</div>
@endsection