@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-pen-to-square"></i> ویرایش محصول
            </h5>
            <a href="{{ route('sales.index') }}" style="color: var(--text-light); text-decoration: none;">
                <i class="fa-solid fa-arrow-right"></i> بازگشت
            </a>
        </div>

        <form action="{{ route('sales.update', $sale->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 8px;">عنوان محصول</label>
                    <input type="text" name="title" value="{{ old('title', $sale->title) }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('title')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">قیمت (تومان)</label>
                    <input type="number" name="price" value="{{ old('price', $sale->price) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('price')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">شماره / اولویت</label>
                    <input type="number" name="number" value="{{ old('number', $sale->number) }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('number')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">تصویر جدید (اختیاری)</label>
                <input type="file" name="image" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                @if($sale->image_url)
                    <div style="margin-top: 10px;">
                        <small style="color: var(--text-light);">تصویر فعلی:</small>
                        <img src="{{ asset('storage/' . $sale->image_url) }}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px; margin-top: 5px;">
                    </div>
                @endif
                @error('image')<small style="color: #ef4444;">{{ $message }}</small>@enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px;">توضیحات</label>
                <textarea name="text" rows="8" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">{{ old('text', $sale->text) }}</textarea>
                @error('text')<small style="color: #ef4444;">{{ $message }}</small>@enderror
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                <i class="fa-solid fa-save"></i> بروزرسانی محصول
            </button>
        </form>
    </div>
</div>
@endsection
