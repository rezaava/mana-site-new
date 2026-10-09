@extends('admin.panel')
@section('content')
    <style>
        .project-editor {
            padding: 24px;
            max-width: 1500px;
            margin: auto;
            color: var(--text)
        }

        .project-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 16px;
            box-shadow: var(--shadow-strong);
            overflow: hidden
        }

        .editor-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 24px;
            border-bottom: 1px solid var(--line);
            background: var(--surface-2)
        }

        .editor-title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px
        }

        .editor-title i {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: color-mix(in srgb, var(--accent-2) 15%, transparent);
            color: var(--accent-2)
        }

        .editor-subtitle {
            margin: 7px 0 0;
            color: var(--text-dimmer);
            font-size: .88rem;
            line-height: 1.8
        }

        .editor-body {
            padding: 24px
        }

        .form-section {
            margin-bottom: 32px
        }

        .form-section:last-of-type {
            margin-bottom: 0
        }

        .form-section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
            font-weight: 800;
            color: var(--text);
            padding-bottom: 14px;
            margin: 0 0 18px;
            border-bottom: 1px solid var(--line)
        }

        .form-section-title i {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: color-mix(in srgb, var(--accent-2) 13%, transparent);
            color: var(--accent-2);
            border-radius: 9px
        }

        .form-label {
            display: block;
            font-weight: 650;
            margin-bottom: 8px;
            color: var(--text-dim);
            font-size: .88rem
        }

        .required-mark {
            color: #ef4444
        }

        .form-input,
        .form-select,
        .form-textarea {
            display: block;
            width: 100%;
            min-height: 43px;
            padding: 10px 12px;
            border-radius: 9px;
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--text);
            font-family: inherit;
            font-size: .9rem;
            transition: border-color .2s, box-shadow .2s
        }

        .form-textarea {
            resize: vertical;
            min-height: 90px;
            line-height: 1.9
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 15%, transparent)
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: var(--text-dimmer)
        }

        .form-select option {
            color: var(--text);
            background: var(--surface)
        }

        .form-file {
            display: block;
            width: 100%;
            padding: 9px;
            border: 1px dashed var(--line);
            border-radius: 9px;
            background: var(--surface);
            color: var(--text-dim);
            font-family: inherit;
            font-size: .83rem
        }

        .form-file::file-selector-button {
            border: 0;
            border-radius: 7px;
            padding: 7px 12px;
            margin-left: 10px;
            background: var(--brand);
            color: var(--oncta);
            cursor: pointer;
            font-family: inherit
        }

        .field-hint {
            font-size: .78rem;
            color: var(--text-dimmer);
            margin-top: 6px;
            line-height: 1.8
        }

        .field-error {
            font-size: .8rem;
            color: #ef4444;
            margin-top: 6px
        }

        .image-upload-box,
        .feature-box,
        .field-group-box,
        .gallery-category {
            height: 100%;
            padding: 16px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: var(--surface-2)
        }

        .image-upload-box {
            min-height: 100%
        }

        .feature-box {
            padding: 17px
        }

        .feature-box-title {
            display: flex;
            align-items: center;
            gap: 9px;
            font-weight: 750;
            color: var(--text);
            margin-bottom: 16px
        }

        .feature-box-title i {
            color: var(--accent-2)
        }

        .section-description {
            font-size: .83rem;
            color: var(--text-dimmer);
            margin: -7px 0 18px;
            line-height: 1.9
        }

        .stats-grid,
        .services-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px
        }

        .services-grid {
            grid-template-columns: repeat(5, minmax(0, 1fr))
        }

        .stat-card-title {
            font-weight: 750;
            color: var(--text);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px
        }

        .stat-card-title i {
            color: var(--accent-2)
        }

        .gallery-category {
            margin-bottom: 16px
        }

        .gallery-category:last-child {
            margin-bottom: 0
        }

        .gallery-category-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
            font-weight: 750;
            color: var(--text)
        }

        .gallery-category-header i {
            color: var(--accent-2)
        }

        .gallery-files {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px
        }

        .file-item {
            min-width: 0;
            padding: 12px;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface)
        }

        .file-item-title {
            display: block;
            font-size: .8rem;
            color: var(--text-dimmer);
            margin-bottom: 9px
        }

        .file-item input[type=file] {
            min-width: 0;
            width: 100%;
            padding: 7px;
            border: 1px dashed var(--line);
            border-radius: 7px;
            background: var(--surface);
            font-size: .75rem;
            color: var(--text-dim)
        }

        .preview-img {
            display: none;
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--line);
            margin-top: 10px
        }

        .technology-item {
            margin-bottom: 12px
        }

        .technology-item:last-child {
            margin-bottom: 0
        }

        .technology-actions {
            display: flex;
            align-items: center;
            gap: 8px
        }

        .technology-remove {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border: 1px solid #ef4444;
            border-radius: 9px;
            background: transparent;
            color: #ef4444;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all .2s
        }

        .technology-remove:hover {
            background: #ef4444;
            color: #fff
        }

        .inline-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid var(--line)
        }

        .btn-submit-form,
        .btn-back-form {
            min-height: 44px;
            padding: 10px 18px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            font-family: inherit;
            font-size: .9rem;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: all .2s
        }

        .btn-submit-form {
            border: 0;
            background: linear-gradient(135deg, var(--brand), var(--accent-2));
            color: var(--oncta)
        }

        .btn-submit-form:hover {
            filter: brightness(1.1);
            transform: translateY(-1px)
        }

        .btn-back-form {
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--text-dim)
        }

        .btn-back-form:hover {
            background: var(--card-hover);
            color: var(--text)
        }

        .alert-validation {
            padding: 14px 16px;
            border: 1px solid #ef4444;
            border-radius: 10px;
            background: color-mix(in srgb, #ef4444 8%, transparent);
            color: var(--text);
            margin-bottom: 22px
        }

        .alert-validation ul {
            margin: 8px 0 0;
            padding-right: 20px
        }

        .alert-validation li {
            margin: 4px 0;
            font-size: .86rem
        }

        @media(max-width:1100px) {
            .services-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr))
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media(max-width:768px) {
            .project-editor {
                padding: 12px
            }

            .editor-header,
            .editor-body {
                padding: 17px
            }

            .editor-header {
                align-items: flex-start
            }

            .gallery-files {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }

            .services-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media(max-width:576px) {
            .editor-title {
                font-size: 1.05rem
            }

            .editor-title i {
                width: 38px;
                height: 38px
            }

            .stats-grid,
            .services-grid,
            .gallery-files {
                grid-template-columns: 1fr
            }

            .inline-actions>* {
                width: 100%
            }
        }
    </style>
    <div class="project-editor">
        <div class="project-form-card">
            <div class="editor-header">
                <div>
                    <h5 class="editor-title"><i class="fa-solid fa-plus"></i>افزودن پروژه جدید</h5>
                    <p class="editor-subtitle">اطلاعات پروژه، خدمت مرتبط، تصاویر و جزئیات فنی را ثبت کنید.</p>
                </div>
                <a href="{{ route('projects.index') }}" class="btn-back-form"><i class="fa-solid fa-arrow-right"></i>بازگشت</a>
            </div>
            <div class="editor-body">
                @if ($errors->any())
                    <div class="alert-validation">
                        <strong><i class="fa-solid fa-triangle-exclamation"></i> لطفاً خطاهای زیر را بررسی کنید.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <section class="form-section">
                        <h6 class="form-section-title"><i class="fa-solid fa-circle-info"></i>اطلاعات اصلی پروژه</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">عنوان پروژه <span class="required-mark">*</span></label>
                                <input type="text" name="title" value="{{ old('title') }}" required class="form-input"
                                    placeholder="عنوان پروژه را وارد کنید">
                                @error('title')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">زیرعنوان</label>
                                <input type="text" name="subtitle" value="{{ old('subtitle') }}" class="form-input"
                                    placeholder="مثلاً سامانه مدیریت هوشمند">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">دسته‌بندی پروژه</label>
                                <select name="cat_id" class="form-select">
                                    <option value="">بدون دسته‌بندی</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (string) old('cat_id') === (string) $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('cat_id')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">خدمت اصلی مرتبط با پروژه</label>
                                <select name="service_id" class="form-select">
                                    <option value="">بدون خدمت مرتبط</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"
                                            {{ (string) old('service_id') === (string) $service->id ? 'selected' : '' }}>
                                            {{ $service->title ?? $service->name }}</option>
                                    @endforeach
                                </select>
                                <div class="field-hint">این پروژه مستقیماً به خدمت انتخاب‌شده متصل می‌شود.</div>
                                @error('service_id')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">نام کارفرما</label>
                                <input type="text" name="client_name" value="{{ old('client_name') }}"
                                    class="form-input" placeholder="نام شرکت یا کارفرما">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">سمت کارفرما</label>
                                <input type="text" name="client_role" value="{{ old('client_role') }}"
                                    class="form-input" placeholder="مثلاً مدیرعامل">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">سال اجرا</label>
                                <input type="text" name="launch_year" value="{{ old('launch_year') }}"
                                    class="form-input" placeholder="مثلاً ۱۴۰۲">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">مدت زمان اجرا</label>
                                <input type="text" name="duration" value="{{ old('duration') }}" class="form-input"
                                    placeholder="مثلاً ۳ ماه">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">لینک پروژه</label>
                                <input type="url" name="project_link" value="{{ old('project_link') }}"
                                    class="form-input" placeholder="https://example.com" dir="ltr">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Slug</label>
                                <input type="text" name="slug" value="{{ old('slug') }}" class="form-input"
                                    placeholder="project-slug" dir="ltr">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">شماره ترتیب نمایش <span class="required-mark">*</span></label>
                                <input type="number" name="number" value="{{ old('number', 1) }}" required
                                    class="form-input" min="1">
                            </div>
                            <div class="col-12">
                                <label class="form-label">توضیح کوتاه پروژه (Brief)</label>
                                <textarea name="brief" rows="3" class="form-textarea" placeholder="خلاصه‌ای از پروژه...">{{ old('brief') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">توضیحات کامل پروژه</label>
                                <textarea name="desc" rows="5" class="form-textarea" placeholder="جزئیات پروژه را وارد کنید...">{{ old('desc') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">هدف پروژه</label>
                                <textarea name="project_goal" rows="3" class="form-textarea" placeholder="هدف از انجام این پروژه چه بود؟">{{ old('project_goal') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="fa-solid fa-triangle-exclamation"
                                        style="color:#f5a623"></i> چالش اصلی</label>
                                <textarea name="challenge" rows="4" class="form-textarea" placeholder="چالش‌های اصلی پروژه...">{{ old('challenge') }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"><i class="fa-solid fa-lightbulb" style="color:#00b894"></i>
                                    راه‌حل ما</label>
                                <textarea name="solution" rows="4" class="form-textarea" placeholder="راه‌حل‌های پیاده‌سازی‌شده...">{{ old('solution') }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">نظر کارفرما (Testimonial)</label>
                                <textarea name="testimonial" rows="3" class="form-textarea" placeholder="نظر کارفرما درباره پروژه...">{{ old('testimonial') }}</textarea>
                            </div>
                        </div>
                    </section>
                    <section class="form-section">
                        <h6 class="form-section-title"><i class="fa-solid fa-images"></i>تصاویر پروژه</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="image-upload-box">
                                    <label class="form-label">تصویر شاخص پروژه</label>
                                    <input type="file" name="image" accept="image/*"
                                        class="form-file image-preview-input">
                                    <img class="preview-img" alt="پیش‌نمایش تصویر شاخص">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="image-upload-box">
                                    <label class="form-label">تصویر موبایل پروژه</label>
                                    <input type="file" name="image_mobile" accept="image/*"
                                        class="form-file image-preview-input">
                                    <img class="preview-img" alt="پیش‌نمایش تصویر موبایل">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="image-upload-box">
                                    <label class="form-label">تصویر صفحه اصلی پروژه</label>
                                    <input type="file" name="image_index" accept="image/*"
                                        class="form-file image-preview-input">
                                    <img class="preview-img" alt="پیش‌نمایش تصویر صفحه اصلی">
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="form-section">
                        <h6 class="form-section-title"><i class="fa-solid fa-star"></i>ویژگی‌ها و فیچرهای پروژه</h6>
                        <p class="section-description">برای هر ویژگی، عنوان، متن و کلاس CSS آیکون را وارد کنید.</p>
                        <div class="row g-3">
                            @for ($i = 0; $i < 6; $i++)
                                <div class="col-md-6">
                                    <div class="feature-box">
                                        <div class="feature-box-title"><i class="fa-solid fa-star"></i> ویژگی
                                            {{ $i + 1 }}</div>
                                        <div class="mb-3">
                                            <label class="form-label">عنوان ویژگی</label>
                                            <input type="text" name="feature_title[]"
                                                value="{{ old('feature_title.' . $i) }}" class="form-input"
                                                placeholder="مثلاً پنل مدیریت هوشمند">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">توضیحات ویژگی</label>
                                            <textarea name="feature_text[]" rows="3" class="form-textarea" placeholder="توضیح این ویژگی...">{{ old('feature_text.' . $i) }}</textarea>
                                        </div>
                                        <div>
                                            <label class="form-label">کلاس CSS آیکون</label>
                                            <input type="text" name="feature_icon[]"
                                                value="{{ old('feature_icon.' . $i) }}" class="form-input"
                                                placeholder="fa-solid fa-chart-line" dir="ltr">
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </section>
                    <section class="form-section">
                        <h6 class="form-section-title"><i class="fa-solid fa-chart-simple"></i>آمارهای پروژه</h6>
                        <p class="section-description">حداکثر ۴ مورد برای نمایش آمار پروژه وارد کنید.</p>
                        <div class="stats-grid">
                            @for ($i = 0; $i < 4; $i++)
                                <div class="field-group-box">
                                    <div class="stat-card-title"><i class="fa-solid fa-chart-column"></i> آمار
                                        {{ $i + 1 }}</div>
                                    <div class="mb-3">
                                        <label class="form-label">مقدار</label>
                                        <input type="text" name="stats_value[]" value="{{ old('stats_value.' . $i) }}"
                                            class="form-input" placeholder="مثلاً ۴۵٪">
                                    </div>
                                    <div>
                                        <label class="form-label">عنوان آمار</label>
                                        <input type="text" name="stats_label[]" value="{{ old('stats_label.' . $i) }}"
                                            class="form-input" placeholder="مثلاً افزایش نرخ تبدیل">
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </section>
                    <section class="form-section">
                        <h6 class="form-section-title"><i class="fa-solid fa-photo-film"></i>گالری تصاویر</h6>
                        <p class="section-description">برای هر دسته حداکثر ۳ تصویر انتخاب کنید.</p>
                        @foreach ($galleryCategories as $galleryCategory)
                            <div class="gallery-category">
                                <div class="gallery-category-header"><i
                                        class="fa-regular fa-folder-open"></i>{{ $galleryCategory->title }}</div>
                                <div class="gallery-files">
                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="file-item">
                                            <span class="file-item-title">تصویر {{ $i + 1 }}</span>
                                            <input type="file" name="gallery_images[{{ $galleryCategory->id }}][]"
                                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                                class="gallery-preview-input">
                                            <img class="preview-img" alt="پیش‌نمایش تصویر گالری">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </section>
                    <section class="form-section">
                        <h6 class="form-section-title"><i class="fa-solid fa-code"></i>تکنولوژی‌های استفاده‌شده</h6>
                        <p class="section-description">نام تکنولوژی، کلاس CSS آیکون و ترتیب نمایش را وارد کنید.</p>
                        <div id="technologies-container">
                            <div class="technology-item field-group-box">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-5">
                                        <label class="form-label">نام تکنولوژی</label>
                                        <input type="text" name="technology_name[]" class="form-input"
                                            placeholder="مثلاً React">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label">کلاس CSS آیکون</label>
                                        <input type="text" name="technology_icon[]" class="form-input"
                                            placeholder="fa-brands fa-react" dir="ltr">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">ترتیب نمایش</label>
                                        <div class="technology-actions">
                                            <input type="number" name="technology_order[]" class="form-input"
                                                value="0" min="0">
                                            <button type="button" class="technology-remove remove-technology"
                                                title="حذف تکنولوژی"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-back-form" id="add-technology" style="margin-top:14px"><i
                                class="fa-solid fa-plus"></i> افزودن تکنولوژی</button>
                    </section>
                    <section class="form-section">
                        <h6 class="form-section-title"><i class="fa-solid fa-list-check"></i>خدمات ارائه‌شده در پروژه</h6>
                        <p class="section-description">نام خدمات متنی قابل نمایش در جزئیات پروژه را وارد کنید. این موارد با
                            خدمت اصلی مرتبط با پروژه تفاوت دارند.</p>
                        <div class="services-grid">
                            @for ($i = 0; $i < 5; $i++)
                                <div>
                                    <label class="form-label">نام خدمت {{ $i + 1 }}</label>
                                    <input type="text" name="service_name[]" value="{{ old('service_name.' . $i) }}"
                                        class="form-input" placeholder="مثلاً طراحی رابط کاربری">
                                </div>
                            @endfor
                        </div>
                    </section>
                    <div class="inline-actions">
                        <button type="submit" class="btn-submit-form"><i class="fa-solid fa-floppy-disk"></i> ذخیره
                            پروژه</button>
                        <a href="{{ route('projects.index') }}" class="btn-back-form"><i
                                class="fa-solid fa-arrow-right"></i> بازگشت به لیست</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('technologies-container');
            const addButton = document.getElementById('add-technology');
            if (container && addButton) {
                addButton.addEventListener('click', function() {
                    const item = document.createElement('div');
                    item.className = 'technology-item field-group-box';
                    item.innerHTML = `
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label">نام تکنولوژی</label>
                        <input type="text" name="technology_name[]" class="form-input" placeholder="مثلاً Laravel">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">کلاس CSS آیکون</label>
                        <input type="text" name="technology_icon[]" class="form-input" placeholder="fa-brands fa-laravel" dir="ltr">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">ترتیب نمایش</label>
                        <div class="technology-actions">
                            <input type="number" name="technology_order[]" class="form-input" value="0" min="0">
                            <button type="button" class="technology-remove remove-technology" title="حذف تکنولوژی"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>`;
                    container.appendChild(item);
                });
                container.addEventListener('click', function(event) {
                    const button = event.target.closest('.remove-technology');
                    if (button) {
                        const item = button.closest('.technology-item');
                        if (item) item.remove();
                    }
                });
            }
            document.querySelectorAll('.image-preview-input,.gallery-preview-input').forEach(function(input) {
                input.addEventListener('change', function() {
                    const file = this.files && this.files[0];
                    const preview = this.parentElement.querySelector('.preview-img');
                    if (!preview) return;
                    if (!file) {
                        preview.removeAttribute('src');
                        preview.style.display = 'none';
                        return;
                    }
                    if (!file.type.startsWith('image/')) {
                        this.value = '';
                        preview.removeAttribute('src');
                        preview.style.display = 'none';
                        alert('لطفاً یک فایل تصویری انتخاب کنید.');
                        return;
                    }
                    if (preview.dataset.objectUrl) {
                        URL.revokeObjectURL(preview.dataset.objectUrl);
                    }
                    const objectUrl = URL.createObjectURL(file);
                    preview.dataset.objectUrl = objectUrl;
                    preview.src = objectUrl;
                    preview.style.display = 'block';
                });
            });
        });
    </script>
@endsection