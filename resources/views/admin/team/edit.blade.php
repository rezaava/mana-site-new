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
                <i class="fa-solid fa-pen-to-square"></i> ویرایش عضو تیم
            </h5>
            <a href="{{ route('team.index') }}" style="color: var(--text-light); text-decoration: none;">
                <i class="fa-solid fa-arrow-right"></i> بازگشت
            </a>
        </div>

        <form action="{{ route('update_team', $team->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 8px;">نام و نام خانوادگی</label>
                    <input type="text" name="name" value="{{ old('name', $team->name) }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('name')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">عنوان / سمت شغلی</label>
                    <input type="text" name="title" value="{{ old('title', $team->title) }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('title')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">ترتیب / اولویت نمایش</label>
                    <input type="number" name="number" value="{{ old('number', $team->number) }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('number')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">تصویر جدید (اختیاری)</label>
                <input type="file" name="image_url" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                
                {{-- پیش‌نمایش تصویر فعلی --}}
                <div style="margin-top: 10px;">
                    @if($team->image_url)
                        <small style="color: var(--text-light); display: block; margin-bottom: 5px;">تصویر فعلی:</small>
                        <img src="{{ asset('storage/' . $team->image_url) }}" alt="{{ $team->name }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 1px solid var(--border);">
                    @else
                        <small style="color: var(--text-light); display: block;">تصویری برای این عضو ثبت نشده است.</small>
                    @endif
                </div>

                @error('image_url')
                    <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                <i class="fa-solid fa-save"></i> بروزرسانی اطلاعات
            </button>
        </form>
    </div>
</div>
@endsection