@extends('admin.panel')

@section('content')
<style>
    .form-section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--accent);
        margin: 30px 0 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--border);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-section-title i {
        font-size: 1.2rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: var(--text-dim);
    }

    .form-control-custom {
        width: 100%;
        padding: 10px 14px;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: transparent;
        color: inherit;
        transition: border-color 0.3s;
    }

    .form-control-custom:focus {
        border-color: var(--accent-2);
        outline: none;
        box-shadow: 0 0 0 3px rgba(23, 195, 178, 0.15);
    }

    .form-control-custom::placeholder {
        color: var(--text-dimmer);
        opacity: 0.7;
    }

    .file-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .file-input-wrapper input[type="file"] {
        flex: 1;
        padding: 8px;
        border: 1px dashed var(--border);
        border-radius: 8px;
        background: var(--bg-soft);
        color: var(--text-dim);
        cursor: pointer;
    }

    .file-input-wrapper input[type="file"]:hover {
        border-color: var(--accent-2);
    }

    .stats-grid,
    .tech-grid,
    .services-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-top: 10px;
    }

    .stats-grid .field-group,
    .tech-grid .field-group,
    .services-grid .field-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .stats-grid .field-group .field-label,
    .tech-grid .field-group .field-label,
    .services-grid .field-group .field-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-dimmer);
        margin-right: 4px;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-top: 10px;
    }

    .feature-box {
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 15px;
        background: var(--bg-soft);
    }

    .feature-box-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 12px;
    }

    .feature-box-title i {
        color: var(--accent-2);
    }

    .gallery-category {
        background: var(--bg-soft);
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 20px;
        border: 1px solid var(--line);
    }

    .gallery-category .category-label {
        font-weight: 700;
        color: var(--text);
        margin-bottom: 12px;
        display: block;
        font-size: 0.95rem;
    }

    .gallery-category .gallery-files {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .gallery-category .gallery-files .file-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .gallery-category .gallery-files .file-item input[type="file"] {
        padding: 6px;
        border: 1px dashed var(--border);
        border-radius: 6px;
        background: var(--surface);
        font-size: 0.85rem;
        color: var(--text-dim);
    }

    .btn-secondary {
        background: var(--surface-2);
        color: var(--text);
        border: 1px solid var(--border);
        padding: 10px 25px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }

    .btn-secondary:hover {
        background: var(--surface);
        border-color: var(--accent-2);
    }

    .btn-primary {
        background: linear-gradient(95deg, var(--brand), var(--accent-2));
        color: var(--oncta);
        border: none;
        padding: 10px 30px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(47, 125, 251, 0.3);
    }

    .inline-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }

    .section-description {
        font-size: 0.85rem;
        color: var(--text-dimmer);
        margin-top: -10px;
        margin-bottom: 15px;
        padding-right: 4px;
    }

    @media (max-width: 992px) {
        .stats-grid,
        .tech-grid,
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .features-grid {
            grid-template-columns: 1fr;
        }

        .gallery-category .gallery-files {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 576px) {
        .stats-grid,
        .tech-grid,
        .services-grid,
        .features-grid {
            grid-template-columns: 1fr;
        }

        .gallery-category .gallery-files {
            grid-template-columns: 1fr;
        }
    }
</style>

<div style="padding:20px;">
    <div style="background:var(--card-bg);border-radius:12px;padding:25px;">

        <h5 style="margin-bottom:25px;font-weight:700;">
            <i class="fa-solid fa-plus-circle" style="color:var(--accent-2);margin-left:10px;"></i>
            افزودن پروژه جدید
        </h5>

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- اطلاعات اصلی --}}

            <div class="form-section-title">
                <i class="fa-solid fa-circle-info"></i>
                اطلاعات اصلی پروژه
            </div>

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">
                        عنوان پروژه <span style="color:#ef4444;">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="form-control-custom">
                </div>

                <div class="col-md-6">
                    <label class="form-label">زیرعنوان</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle') }}" class="form-control-custom" placeholder="مثلاً: افزونه‌ای برای حرفه‌ای شدن">
                </div>

                <div class="col-md-6">
                    <label class="form-label">دسته‌بندی</label>
                    <select name="cat_id" class="form-control-custom">
                        <option style="color:var(--text-dim);" value="">انتخاب دسته‌بندی...</option>

                        @foreach($categories as $category)
                            <option style="color:var(--text-dim);" value="{{ $category->id }}" {{ old('cat_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">نام کارفرما</label>
                    <input type="text" name="client_name" value="{{ old('client_name') }}" class="form-control-custom" placeholder="مثلاً: شرکت بهین فرتاک">
                </div>

                <div class="col-md-6">
                    <label class="form-label">سمت کارفرما</label>
                    <input type="text" name="client_role" value="{{ old('client_role') }}" class="form-control-custom" placeholder="مثلاً: مدیرعامل">
                </div>

                <div class="col-md-6">
                    <label class="form-label">سال اجرا</label>
                    <input type="text" name="launch_year" value="{{ old('launch_year') }}" class="form-control-custom" placeholder="مثلاً: ۱۴۰۲">
                </div>

                <div class="col-md-6">
                    <label class="form-label">مدت زمان</label>
                    <input type="text" name="duration" value="{{ old('duration') }}" class="form-control-custom" placeholder="مثلاً: ۳ سال">
                </div>

                <div class="col-md-6">
                    <label class="form-label">لینک پروژه</label>
                    <input type="url" name="project_link" value="{{ old('project_link') }}" class="form-control-custom" placeholder="https://example.com">
                </div>

                <div class="col-12">
                    <label class="form-label">توضیح کوتاه (Brief)</label>
                    <textarea name="brief" rows="2" class="form-control-custom">{{ old('brief') }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">توضیحات کامل پروژه</label>
                    <textarea name="desc" rows="4" class="form-control-custom">{{ old('desc') }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">هدف پروژه</label>
                    <textarea name="project_goal" rows="3" class="form-control-custom" placeholder="هدف از انجام این پروژه چه بود؟">{{ old('project_goal') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color:#f5a623;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        چالش اصلی
                    </label>

                    <textarea name="challenge" rows="4" class="form-control-custom" placeholder="چالش‌های اصلی پروژه را بنویسید...">{{ old('challenge') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color:#00d1b2;">
                        <i class="fa-solid fa-lightbulb"></i>
                        راه‌حل ما
                    </label>

                    <textarea name="solution" rows="4" class="form-control-custom" placeholder="راه‌حل‌های پیاده‌سازی‌شده را بنویسید...">{{ old('solution') }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">نقل قول از کارفرما (Testimonial)</label>
                    <textarea name="testimonial" rows="3" class="form-control-custom" placeholder="نظر کارفرما درباره پروژه...">{{ old('testimonial') }}</textarea>
                </div>

                <div class="col-12">
                    <label class="form-label">تصویر شاخص پروژه</label>

                    <div class="file-input-wrapper">
                        <input type="file" name="image" accept="image/*">
                    </div>
                </div>

            </div>

            {{-- فیچرها --}}

            <div class="form-section-title">
                <i class="fa-solid fa-star"></i>
                ویژگی‌ها و فیچرهای پروژه
            </div>

            <p class="section-description">
                برای هر فیچر عنوان، متن و کلاس CSS آیکون را وارد کنید.
            </p>

            <div class="features-grid">

                @for($i = 0; $i < 6; $i++)

                    <div class="feature-box">

                        <div class="feature-box-title">
                            <i class="fa-solid fa-star"></i>
                            فیچر {{ $i + 1 }}
                        </div>

                        <div style="margin-bottom:10px;">

                            <label class="field-label">
                                عنوان فیچر
                            </label>

                            <input
                                type="text"
                                name="feature_title[]"
                                value="{{ old('feature_title.'.$i) }}"
                                class="form-control-custom"
                                placeholder="مثلاً پنل مدیریت هوشمند"
                            >

                        </div>

                        <div style="margin-bottom:10px;">

                            <label class="field-label">
                                متن فیچر
                            </label>

                            <textarea
                                name="feature_text[]"
                                rows="3"
                                class="form-control-custom"
                                placeholder="توضیح این ویژگی را وارد کنید..."
                            >{{ old('feature_text.'.$i) }}</textarea>

                        </div>

                        <div>

                            <label class="field-label">
                                کلاس CSS آیکون
                            </label>

                            <input
                                type="text"
                                name="feature_icon[]"
                                value="{{ old('feature_icon.'.$i) }}"
                                class="form-control-custom"
                                placeholder="مثلاً fa-solid fa-chart-line"
                                dir="ltr"
                            >

                        </div>

                    </div>

                @endfor

            </div>

            {{-- آمارها --}}

            <div class="form-section-title">
                <i class="fa-solid fa-chart-simple"></i>
                آمارهای پروژه
            </div>

            <p class="section-description">
                حداکثر ۴ آیتم آمار را وارد کنید. هر آیتم شامل یک مقدار و یک برچسب توضیحی است.
            </p>

            <div class="stats-grid">

                @for($i = 0; $i < 4; $i++)

                    <div class="field-group" style="border:1px solid var(--border);border-radius:8px;padding:12px;background:var(--bg-soft);">

                        <span class="field-label" style="font-weight:700;color:var(--text);">
                            آمار {{ $i + 1 }}
                        </span>

                        <div style="margin-top:6px;">

                            <span class="field-label">
                                مقدار
                            </span>

                            <input
                                type="text"
                                name="stats_value[]"
                                value="{{ old('stats_value.'.$i) }}"
                                class="form-control-custom"
                                placeholder="مثلاً ۴۵%"
                            >

                        </div>

                        <div style="margin-top:6px;">

                            <span class="field-label">
                                برچسب
                            </span>

                            <input
                                type="text"
                                name="stats_label[]"
                                value="{{ old('stats_label.'.$i) }}"
                                class="form-control-custom"
                                placeholder="مثلاً افزایش نرخ تبدیل"
                            >

                        </div>

                    </div>

                @endfor

            </div>

            {{-- گالری --}}

            <div class="form-section-title">
                <i class="fa-solid fa-images"></i>
                گالری تصاویر
            </div>

            <p class="section-description">
                هر دسته‌بندی می‌تواند تا ۳ تصویر داشته باشد.
            </p>

            @php
                $galleryCategories = [
                    'desktop' => 'دسکتاپ',
                    'mobile' => 'موبایل',
                    'key_pages' => 'صفحات کلیدی'
                ];
            @endphp

            @foreach($galleryCategories as $catKey => $catLabel)

                <div class="gallery-category">

                    <span class="category-label">
                        <i class="fa-regular fa-folder-open"></i>
                        {{ $catLabel }}
                    </span>

                    <div class="gallery-files">

                        @for($i = 0; $i < 3; $i++)

                            <div class="file-item">

                                <span class="field-label" style="font-size:0.75rem;color:var(--text-dimmer);">
                                    تصویر {{ $i + 1 }}
                                </span>

                                <input
                                    type="file"
                                    name="gallery_images[{{ $catKey }}][]"
                                    accept="image/*"
                                >

                            </div>

                        @endfor

                    </div>

                </div>

            @endforeach

            {{-- تکنولوژی‌ها --}}

            <div class="form-section-title">
                <i class="fa-solid fa-code"></i>
                تکنولوژی‌های استفاده‌شده
            </div>

            <p class="section-description">
                تکنولوژی‌های استفاده‌شده در این پروژه را انتخاب کنید.
            </p>

            <div class="tech-grid">

                @foreach($allTechnologies as $tech)

                    <label style="display:flex;align-items:center;gap:8px;padding:8px 12px;border:1px solid var(--border);border-radius:8px;cursor:pointer;transition:all 0.3s;">

                        <input
                            type="checkbox"
                            name="technologies[]"
                            value="{{ $tech['name'] }}"
                            style="width:18px;height:18px;accent-color:var(--accent-2);cursor:pointer;"
                        >

                        <i
                            class="{{ $tech['icon'] }}"
                            style="color:var(--accent-2);font-size:1.2rem;width:24px;"
                        ></i>

                        <span style="font-weight:500;">
                            {{ $tech['name'] }}
                        </span>

                    </label>

                @endforeach

            </div>

            @foreach($allTechnologies as $tech)

                <input
                    type="hidden"
                    name="tech_icon[{{ $tech['name'] }}]"
                    value="{{ $tech['icon'] }}"
                >

            @endforeach

            {{-- خدمات --}}

            <div class="form-section-title">
                <i class="fa-solid fa-list-check"></i>
                خدمات ارائه‌شده در پروژه
            </div>

            <p class="section-description">
                خدماتی که در این پروژه ارائه شده‌اند را وارد کنید. می‌توانید تا ۵ مورد وارد کنید.
            </p>

            <div class="services-grid">

                @for($i = 0; $i < 5; $i++)

                    <div class="field-group">

                        <span class="field-label">
                            نام خدمت
                        </span>

                        <input
                            type="text"
                            name="service_name[]"
                            value="{{ old('service_name.'.$i) }}"
                            class="form-control-custom"
                            placeholder="مثلاً طراحی UX/UI"
                        >

                    </div>

                @endfor

            </div>

            {{-- دکمه‌ها --}}

            <div class="inline-actions">

                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-check"></i>
                    ذخیره پروژه
                </button>

                <a href="{{ route('projects.index') }}" class="btn-secondary">
                    <i class="fa-solid fa-arrow-right"></i>
                    بازگشت به لیست
                </a>

            </div>

        </form>

    </div>
</div>
@endsection