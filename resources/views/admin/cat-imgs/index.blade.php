@extends('admin.panel')

@section('content')

<style>
    .cat-img-page {
        padding: 25px;
    }

    .cat-img-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
    }

    .cat-img-title {
        margin: 0;
        font-size: 22px;
        font-weight: 800;
        color: var(--text);
    }

    .cat-img-description {
        margin: 7px 0 0;
        color: var(--muted);
        font-size: 14px;
    }

    .cat-img-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 14px;
        box-shadow: var(--shadow-strong);
        padding: 25px;
        margin-bottom: 25px;
    }

    .cat-img-form {
        display: grid;
        grid-template-columns: 1fr 180px auto;
        gap: 15px;
        align-items: end;
    }

    .cat-img-field {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .cat-img-field label {
        color: var(--text);
        font-size: 14px;
        font-weight: 700;
    }

    .cat-img-field input {
        width: 100%;
        height: 45px;
        border: 1px solid var(--line);
        background: var(--background);
        color: var(--text);
        border-radius: 9px;
        padding: 0 13px;
        outline: none;
    }

    .cat-img-field input:focus {
        border-color: var(--primary);
    }

    .cat-img-button {
        height: 45px;
        border: none;
        border-radius: 9px;
        padding: 0 22px;
        cursor: pointer;
        font-weight: 700;
        background: var(--primary);
        color: #fff;
    }

    .cat-img-table-wrapper {
        overflow-x: auto;
    }

    .cat-img-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cat-img-table th,
    .cat-img-table td {
        padding: 15px;
        text-align: right;
        border-bottom: 1px solid var(--line);
        color: var(--text);
    }

    .cat-img-table th {
        font-size: 13px;
        font-weight: 800;
        color: var(--muted);
    }

    .cat-img-table td {
        font-size: 14px;
    }

    .cat-img-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .cat-img-edit-button,
    .cat-img-delete-button {
        border: none;
        border-radius: 8px;
        padding: 8px 13px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 700;
    }

    .cat-img-edit-button {
        background: rgba(59, 130, 246, 0.12);
        color: #3b82f6;
    }

    .cat-img-delete-button {
        background: rgba(239, 68, 68, 0.12);
        color: #ef4444;
    }

    .cat-img-edit-form {
        display: none;
        margin-top: 12px;
    }

    .cat-img-edit-form.active {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .cat-img-edit-form input {
        height: 38px;
        border: 1px solid var(--line);
        background: var(--background);
        color: var(--text);
        border-radius: 7px;
        padding: 0 10px;
        outline: none;
    }

    .cat-img-edit-title {
        width: 250px;
    }

    .cat-img-edit-number {
        width: 100px;
    }

    .cat-img-save-button,
    .cat-img-cancel-button {
        height: 38px;
        border: none;
        border-radius: 7px;
        padding: 0 12px;
        cursor: pointer;
        font-weight: 700;
    }

    .cat-img-save-button {
        background: var(--primary);
        color: #fff;
    }

    .cat-img-cancel-button {
        background: var(--line);
        color: var(--text);
    }

    .cat-img-alert {
        padding: 13px 15px;
        border-radius: 9px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    .cat-img-alert-success {
        background: rgba(34, 197, 94, 0.12);
        color: #16a34a;
    }

    .cat-img-alert-error {
        background: rgba(239, 68, 68, 0.12);
        color: #dc2626;
    }

    .cat-img-empty {
        text-align: center;
        padding: 35px;
        color: var(--muted);
    }

    @media (max-width: 768px) {
        .cat-img-page {
            padding: 15px;
        }

        .cat-img-form {
            grid-template-columns: 1fr;
        }

        .cat-img-header {
            align-items: flex-start;
        }

        .cat-img-table th,
        .cat-img-table td {
            white-space: nowrap;
        }

        .cat-img-edit-form.active {
            flex-wrap: wrap;
        }
    }
</style>

<div class="cat-img-page">

    <div class="cat-img-header">
        <div>
            <h1 class="cat-img-title">دسته‌بندی تصاویر</h1>
            <p class="cat-img-description">
                دسته‌هایی که می‌خواهید برای تصاویر گالری پروژه‌ها استفاده شوند را مدیریت کنید.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="cat-img-alert cat-img-alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="cat-img-alert cat-img-alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- فرم ایجاد دسته جدید --}}
    <div class="cat-img-card">

        <h3 style="margin-top: 0; margin-bottom: 20px; color: var(--text);">
            افزودن دسته جدید
        </h3>

        <form
            action="{{ route('cat-imgs.store') }}"
            method="POST"
            class="cat-img-form"
        >
            @csrf

            <div class="cat-img-field">
                <label for="title">
                    نام دسته
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="مثلاً دسکتاپ"
                    value="{{ old('title') }}"
                    required
                >
            </div>

            <div class="cat-img-field">
                <label for="number">
                    ترتیب نمایش
                </label>

                <input
                    type="number"
                    id="number"
                    name="number"
                    value="{{ old('number', 0) }}"
                    min="0"
                >
            </div>

            <button type="submit" class="cat-img-button">
                افزودن دسته
            </button>

        </form>

    </div>

    {{-- لیست دسته‌ها --}}
    <div class="cat-img-card">

        <h3 style="margin-top: 0; margin-bottom: 20px; color: var(--text);">
            دسته‌های موجود
        </h3>

        <div class="cat-img-table-wrapper">

            @if($categories->count())

                <table class="cat-img-table">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام دسته</th>
                            <th>ترتیب</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($categories as $category)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>

                                    <div>
                                        <strong>
                                            {{ $category->title }}
                                        </strong>
                                    </div>

                                    <form
                                        action="{{ route('cat-imgs.update', $category->id) }}"
                                        method="POST"
                                        class="cat-img-edit-form"
                                        id="edit-form-{{ $category->id }}"
                                    >
                                        @csrf

                                        <input
                                            type="text"
                                            name="title"
                                            class="cat-img-edit-title"
                                            value="{{ $category->title }}"
                                            required
                                        >

                                        <input
                                            type="number"
                                            name="number"
                                            class="cat-img-edit-number"
                                            value="{{ $category->number }}"
                                            min="0"
                                        >

                                        <button
                                            type="submit"
                                            class="cat-img-save-button"
                                        >
                                            ذخیره
                                        </button>

                                        <button
                                            type="button"
                                            class="cat-img-cancel-button"
                                            onclick="closeEdit({{ $category->id }})"
                                        >
                                            لغو
                                        </button>

                                    </form>

                                </td>

                                <td>
                                    {{ $category->number }}
                                </td>

                                <td>

                                    <div class="cat-img-actions">

                                        <button
                                            type="button"
                                            class="cat-img-edit-button"
                                            onclick="openEdit({{ $category->id }})"
                                        >
                                            ویرایش
                                        </button>

                                        <form
                                            action="{{ route('cat-imgs.destroy', $category->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این دسته مطمئن هستید؟');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="cat-img-delete-button"
                                            >
                                                حذف
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="cat-img-empty">
                    هنوز هیچ دسته‌بندی تصویری ایجاد نشده است.
                </div>

            @endif

        </div>

    </div>

</div>

<script>
    function openEdit(id) {
        const form = document.getElementById('edit-form-' + id);

        if (form) {
            form.classList.add('active');
        }
    }

    function closeEdit(id) {
        const form = document.getElementById('edit-form-' + id);

        if (form) {
            form.classList.remove('active');
        }
    }
</script>

@endsection