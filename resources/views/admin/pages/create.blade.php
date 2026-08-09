@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-plus-circle"></i> افزودن صفحه جدید
            </h5>
            <a href="{{ route('pages.index') }}" style="color: var(--text-light); text-decoration: none;">
                <i class="fa-solid fa-arrow-right"></i> بازگشت
            </a>
        </div>

        <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 8px;">عنوان صفحه</label>
                    <input type="text" name="title" value="{{ old('title') }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('title')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">شماره / اولویت</label>
                    <input type="number" name="number" value="{{ old('number') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('number')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">تصویر</label>
                <input type="file" name="image" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                @error('image')<small style="color: #ef4444;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">متن</label>
                <textarea name="text" rows="8" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">{{ old('text') }}</textarea>
                @error('text')<small style="color: #ef4444;">{{ $message }}</small>@enderror
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                <i class="fa-solid fa-check"></i> ذخیره صفحه
            </button>
        </form>
    </div>
</div>
@endsection
