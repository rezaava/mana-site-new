@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-plus-circle"></i> افزودن نظر جدید
            </h5>
            <a href="{{ route('comments.index') }}" style="color: var(--text-light); text-decoration: none;">
                <i class="fa-solid fa-arrow-right"></i> بازگشت
            </a>
        </div>

        <form action="{{ route('comments.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">نام کاربر</label>
                <input type="text" name="user_name" value="{{ old('user_name') }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                @error('user_name')<small style="color: #ef4444;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">متن نظر</label>
                <textarea name="content" rows="6" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">{{ old('content') }}</textarea>
                @error('content')<small style="color: #ef4444;">{{ $message }}</small>@enderror
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                <i class="fa-solid fa-check"></i> ذخیره نظر
            </button>
        </form>
    </div>
</div>
@endsection
