@extends('admin.panel')

@section('content')

<style>
    .category-form-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 14px;
        box-shadow: var(--shadow-strong);
        padding: 25px;
    }

    .category-form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .category-form-title {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text);
    }

    .btn-back-form {
        color: var(--text-dim);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
        transition: color 0.2s;
    }

    .btn-back-form:hover {
        color: var(--text);
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 20px;
    }

    .form-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dim);
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid var(--line);
        background: var(--surface);
        color: var(--text);
        transition: all 0.3s var(--ease);
        font-family: inherit;
        font-size: 0.9rem;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--brand);
        box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 20%, transparent);
        background: var(--card-hover);
    }

    .form-input::placeholder {
        color: var(--text-dimmer);
    }

    .form-select option {
        background-color: var(--surface);
        color: var(--text);
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
        font-family: inherit;
        font-size: 0.9rem;
    }

    .btn-submit-form:hover {
        filter: brightness(1.1);
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .category-form-card {
            padding: 15px;
        }
    }
</style>

<div style="padding:20px;">
    <div class="category-form-card">

        <div class="category-form-header">

            <h5 class="category-form-title">
                <i class="fa-solid fa-pen-to-square"></i>
                ویرایش دسته‌بندی
            </h5>

            <a href="{{ route('categories.index') }}" class="btn-back-form">
                <i class="fa-solid fa-arrow-right"></i>
                بازگشت
            </a>

        </div>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">
                    نام
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name ?? $category->title) }}"
                    required
                    class="form-input"
                    placeholder="نام دسته‌بندی">
            </div>

            <div class="form-group">
                <label class="form-label">
                    نوع
                </label>

                <select name="type" class="form-select" required>

                    <option value="1" {{ old('type', $category->type) == 1 ? 'selected' : '' }}>
                        پروژه
                    </option>

                    <option value="2" {{ old('type', $category->type) == 2 ? 'selected' : '' }}>
                        بلاگ
                    </option>

                </select>
            </div>

            <div class="form-group">
                <label class="form-label">
                    ترتیب نمایش
                </label>

                <input
                    type="number"
                    name="order"
                    value="{{ old('order', $category->order ?? 0) }}"
                    min="0"
                    required
                    class="form-input"
                    placeholder="مثلاً 1">

                <small style="color: var(--text-dimmer);">
                    عدد کمتر یعنی نمایش بالاتر
                </small>
            </div>

            <button type="submit" class="btn-submit-form">
                <i class="fa-solid fa-save"></i>
                بروزرسانی
            </button>

        </form>

    </div>
</div>

@endsection