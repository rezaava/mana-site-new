@extends('admin.panel')

@section('content')
<style>
    /* ===== استایل فرم افزودن عضو تیم ===== */
    .team-form-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 14px;
        box-shadow: var(--shadow-strong);
        padding: 25px;
    }

    .team-form-header {
        margin-bottom: 25px;
    }

    .team-form-title {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text);
    }

    .form-section-title {
        margin: 35px 0 15px;
        color: var(--accent);
        font-size: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-grid {
        display: grid;
        gap: 15px;
        margin-bottom: 15px;
    }

    .form-grid-2 {
        grid-template-columns: repeat(2, 1fr);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dim);
    }

    .form-input,
    .form-file {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid var(--line);
        background: transparent;
        color: var(--text);
        transition: all 0.3s var(--ease);
        font-family: inherit;
        font-size: 0.9rem;
    }

    .form-input:focus,
    .form-file:focus {
        outline: none;
        border-color: var(--brand);
        box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 20%, transparent);
        background: var(--card-hover);
    }

    .form-input::placeholder {
        color: var(--text-dimmer);
    }

    .form-file {
        padding: 8px;
        cursor: pointer;
    }

    .form-file::-webkit-file-upload-button {
        background: var(--brand);
        color: var(--oncta);
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        margin-left: 10px;
        transition: filter 0.2s;
    }

    .form-file::-webkit-file-upload-button:hover {
        filter: brightness(1.1);
    }

    .btn-submit-form {
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--brand), var(--accent-2));
        color: var(--oncta);
        transition: all 0.3s var(--ease);
        text-decoration: none;
    }

    .btn-submit-form:hover {
        filter: brightness(1.1);
        transform: translateY(-1px);
    }

    .btn-back-form {
        padding: 10px 20px;
        border-radius: 8px;
        border: 1px solid var(--line);
        background: var(--surface);
        color: var(--text-dim);
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.3s var(--ease);
    }

    .btn-back-form:hover {
        background: var(--card-hover);
        color: var(--text);
    }

    /* ===== ریسپانسیو ===== */
    @media (max-width: 768px) {
        .team-form-card {
            padding: 15px;
        }
        .form-grid-2 {
            grid-template-columns: 1fr;
        }
    }
</style>

<div style="padding: 20px;">
    <div class="team-form-card">
        <div class="team-form-header">
            <h5 class="team-form-title">
                <i class="fa-solid fa-plus-circle"></i> افزودن عضو تیم
            </h5>
        </div>

        <form action="{{ route('create_team') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- اطلاعات اصلی --}}
            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label class="form-label">نام</label>
                    <input type="text" name="name" required class="form-input" placeholder="نام عضو">
                </div>
                <div class="form-group">
                    <label class="form-label">سمت</label>
                    <input type="text" name="title" class="form-input" placeholder="مثلاً مدیر فنی">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label class="form-label">تصویر</label>
                <input type="file" name="image" class="form-file">
            </div>

            {{-- شبکه‌های اجتماعی --}}
            <h6 class="form-section-title">
                <i class="fa-solid fa-link"></i> شبکه‌های اجتماعی (حداکثر ۲ مورد)
            </h6>

            <div id="socialFields">
                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">اینستاگرام</label>
                        <input type="text" name="instagram" class="form-input social-input" placeholder="https://instagram.com/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">توییتر</label>
                        <input type="text" name="twitter" class="form-input social-input" placeholder="https://twitter.com/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">گیت‌هاب</label>
                        <input type="text" name="github" class="form-input social-input" placeholder="https://github.com/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">تلگرام</label>
                        <input type="text" name="telegram" class="form-input social-input" placeholder="https://t.me/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">واتساپ</label>
                        <input type="text" name="whatsapp" class="form-input social-input" placeholder="https://wa.me/...">
                    </div>
                    <div class="form-group">
                        <label class="form-label">لینکدین</label>
                        <input type="text" name="linkedin" class="form-input social-input" placeholder="https://linkedin.com/in/...">
                    </div>
                </div>
            </div>

            <div style="margin-top: 25px; display: flex; gap: 10px; flex-wrap: wrap;">
                <button type="submit" class="btn-submit-form">
                    <i class="fa-solid fa-check"></i> ذخیره
                </button>
                <a href="{{ route('team.index') }}" class="btn-back-form">بازگشت</a>
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