@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <h5 style="margin-bottom: 20px;">
            <i class="fa-solid fa-plus-circle"></i> افزودن عضو تیم
        </h5>

        <form action="{{ route('create_team') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">نام</label>
                <input type="text" name="name" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">سمت</label>
                <input type="text" name="title" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">تصویر</label>
                <input type="file" name="image" style="width: 100%; padding: 10px;">
            </div>

            <h6 style="margin: 25px 0 15px; color: var(--accent);">
                <i class="fa-solid fa-link"></i> شبکه‌های اجتماعی (حداکثر ۲ مورد)
            </h6>

            <div id="socialFields">
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px;">اینستاگرام</label>
                    <input type="url" name="instagram" class="social-input" placeholder="https://instagram.com/..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px;">توییتر</label>
                    <input type="url" name="twitter" class="social-input" placeholder="https://twitter.com/..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px;">گیت‌هاب</label>
                    <input type="url" name="github" class="social-input" placeholder="https://github.com/..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px;">تلگرام</label>
                    <input type="url" name="telegram" class="social-input" placeholder="https://t.me/..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px;">واتساپ</label>
                    <input type="url" name="whatsapp" class="social-input" placeholder="https://wa.me/..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px;">لینکدین</label>
                    <input type="url" name="linkedin" class="social-input" placeholder="https://linkedin.com/in/..." style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                </div>
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                    <i class="fa-solid fa-check"></i> ذخیره
                </button>
                <a href="{{ route('team.index') }}" class="btn btn-secondary" style="text-decoration: none;">بازگشت</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.social-input');
    const message = document.createElement('p');
    message.style.cssText = 'color: #f59e0b; font-size: 12px; margin: 0 0 10px; display: none;';
    message.textContent = 'حداکثر ۲ شبکه اجتماعی می‌توانید وارد کنید.';
    document.getElementById('socialFields').prepend(message);

    function updateFields() {
        const filled = [...inputs].filter(i => i.value.trim() !== '');
        const disabled = [...inputs].filter(i => i.disabled === true);

        inputs.forEach(input => {
            if (input.value.trim() === '' && filled.length >= 2) {
                input.disabled = true;
                input.style.opacity = '0.4';
            } else {
                input.disabled = false;
                input.style.opacity = '1';
            }
        });

        if (filled.length >= 2) {
            message.style.display = 'block';
        } else {
            message.style.display = 'none';
        }
    }

    inputs.forEach(input => {
        input.addEventListener('input', updateFields);
        input.addEventListener('paste', updateFields);
        input.addEventListener('keyup', updateFields);
    });

    updateFields();
});
</script>
@endsection
