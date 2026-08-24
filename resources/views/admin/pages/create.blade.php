@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <h5 style="margin-bottom: 20px;">
            <i class="fa-solid fa-plus-circle"></i> افزودن خدمت جدید
        </h5>

        <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">عنوان خدمت</label>
                <input type="text" name="title" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">شماره / اولویت</label>
                <input type="number" name="number" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">متن توضیحات</label>
                <textarea name="text" rows="5" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;"></textarea>
            </div>

            <h6 style="margin: 25px 0 15px; color: var(--accent);">
                <i class="fa-solid fa-image"></i> آیکون یا تصویر (فقط یکی)
            </h6>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 8px;">آپلود تصویر (SVG)</label>
                    <input type="file" name="image" id="imageInput" accept="image/jpeg,image/png,image/jpg,image/webp,image/svg+xml" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">یا اسم آیکون Font Awesome</label>
                    <input type="text" name="icon" id="iconInput" placeholder="fa-brain" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    <small style="color: var(--text-light);">مثلاً: fa-brain, fa-code, fa-chart-line</small>
                </div>
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                    <i class="fa-solid fa-check"></i> ذخیره
                </button>
                <a href="{{ route('pages.index') }}" class="btn btn-secondary" style="text-decoration: none;">بازگشت</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const iconInput = document.getElementById('iconInput');

    imageInput.addEventListener('change', function() {
        if (imageInput.files.length > 0) {
            iconInput.disabled = true;
            iconInput.value = '';
        } else {
            iconInput.disabled = false;
        }
    });

    iconInput.addEventListener('input', function() {
        if (iconInput.value.trim() !== '') {
            imageInput.disabled = true;
            imageInput.value = '';
        } else {
            imageInput.disabled = false;
        }
    });
});
</script>
@endsection
