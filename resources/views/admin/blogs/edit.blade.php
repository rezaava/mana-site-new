@extends('admin.panel')

@section('content')
    <style>
        .blog-page {
            padding: 24px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .blog-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .blog-page-heading {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .blog-page-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--brand), var(--accent-2));
            color: var(--oncta);
            font-size: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, .12);
        }

        .blog-page-title {
            margin: 0;
            color: var(--text);
            font-size: 1.25rem;
            font-weight: 800;
        }

        .blog-page-subtitle {
            margin: 5px 0 0;
            color: var(--text-dim);
            font-size: .82rem;
        }

        .blog-back-top {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 15px;
            border: 1px solid var(--line);
            border-radius: 10px;
            color: var(--text-dim);
            text-decoration: none;
            background: var(--surface);
            transition: .2s ease;
        }

        .blog-back-top:hover {
            color: var(--text);
            background: var(--card-hover);
            transform: translateY(-1px);
        }

        .blog-alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 13px 15px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: .88rem;
        }

        .blog-alert-success {
            color: #10b981;
            background: rgba(16, 185, 129, .08);
            border: 1px solid rgba(16, 185, 129, .25);
        }

        .blog-alert-error {
            color: #ef4444;
            background: rgba(239, 68, 68, .08);
            border: 1px solid rgba(239, 68, 68, .25);
        }

        .blog-alert ul {
            margin: 0;
        }

        .blog-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: var(--shadow-strong);
            overflow: hidden;
        }

        .blog-form-card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--line);
            background: color-mix(in srgb, var(--surface) 94%, var(--brand));
        }

        .blog-form-card-header-title {
            margin: 0;
            color: var(--text);
            font-size: .98rem;
            font-weight: 750;
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .blog-form-card-header-title i {
            color: var(--brand);
        }

        .blog-form-body {
            padding: 25px;
        }

        .blog-section {
            margin-bottom: 30px;
        }

        .blog-section:last-child {
            margin-bottom: 0;
        }

        .blog-section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
        }

        .blog-section-number {
            width: 30px;
            height: 30px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: color-mix(in srgb, var(--brand) 12%, transparent);
            color: var(--brand);
            font-size: .78rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .blog-section-name {
            color: var(--text);
            font-size: .94rem;
            font-weight: 750;
            margin: 0;
        }

        .blog-section-line {
            height: 1px;
            background: var(--line);
            flex: 1;
        }

        .blog-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .blog-form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .blog-form-group.full {
            grid-column: 1 / -1;
        }

        .blog-form-label {
            color: var(--text-dim);
            font-size: .82rem;
            font-weight: 650;
        }

        .blog-required {
            color: #ef4444;
            margin-right: 2px;
        }

        .blog-form-input,
        .blog-form-select {
            width: 100%;
            height: 44px;
            padding: 0 13px;
            border-radius: 10px;
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--text);
            font-family: inherit;
            font-size: .86rem;
            box-sizing: border-box;
            transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .blog-form-input:hover,
        .blog-form-select:hover {
            border-color: color-mix(in srgb, var(--brand) 40%, var(--line));
        }

        .blog-form-input:focus,
        .blog-form-select:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 4px color-mix(in srgb, var(--brand) 12%, transparent);
        }

        .blog-form-input::placeholder {
            color: var(--text-dimmer);
        }

        .blog-form-select option {
            color: var(--text);
            background: var(--surface);
        }

        .blog-form-error {
            color: #ef4444;
            font-size: .76rem;
        }

        .blog-form-hint {
            color: var(--text-dimmer);
            font-size: .72rem;
            margin-top: 4px;
        }

        /* ===== Toggle Switch ===== */
        .blog-toggle {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            user-select: none;
            padding: 8px 0;
        }

        .blog-toggle input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .blog-toggle-slider {
            position: relative;
            width: 46px;
            height: 26px;
            background: var(--surface-2);
            border: 1px solid var(--line);
            border-radius: 99px;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .blog-toggle-slider::after {
            content: "";
            position: absolute;
            top: 2px;
            right: 2px;
            width: 20px;
            height: 20px;
            background: var(--text-dimmer);
            border-radius: 50%;
            transition: all 0.3s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .blog-toggle input[type="checkbox"]:checked+.blog-toggle-slider {
            background: linear-gradient(135deg, var(--brand), var(--accent-2));
            border-color: transparent;
        }

        .blog-toggle input[type="checkbox"]:checked+.blog-toggle-slider::after {
            transform: translateX(-20px);
            background: #fff;
        }

        .blog-toggle-text {
            font-size: 0.86rem;
            color: var(--text);
            font-weight: 600;
        }

        /* ===== SEO Box ===== */
        .blog-seo-box {
            padding: 18px;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: color-mix(in srgb, var(--surface) 96%, var(--brand));
        }

        .blog-seo-header {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 16px;
        }

        .blog-seo-header-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: color-mix(in srgb, var(--brand) 12%, transparent);
            color: var(--brand);
        }

        .blog-seo-title {
            margin: 0;
            color: var(--text);
            font-size: .88rem;
            font-weight: 750;
        }

        .blog-seo-subtitle {
            margin: 3px 0 0;
            color: var(--text-dim);
            font-size: .72rem;
        }

        .blog-seo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        /* ===== Image Box ===== */
        .blog-image-box {
            padding: 18px;
            border: 1px dashed var(--line);
            border-radius: 14px;
            background: color-mix(in srgb, var(--surface) 97%, var(--brand));
        }

        .blog-file {
            width: 100%;
            padding: 9px;
            border-radius: 10px;
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--text);
            font-family: inherit;
            cursor: pointer;
            box-sizing: border-box;
        }

        .blog-file::-webkit-file-upload-button {
            border: none;
            border-radius: 7px;
            padding: 7px 12px;
            margin-left: 8px;
            background: var(--brand);
            color: var(--oncta);
            font-family: inherit;
            font-weight: 650;
            cursor: pointer;
        }

        .blog-image-hint {
            margin-top: 8px;
            color: var(--text-dimmer);
            font-size: .72rem;
        }

        .blog-current-image {
            margin-top: 15px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid var(--line);
            background: var(--surface);
        }

        .blog-current-image-preview {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 11px;
            border: 1px solid var(--line);
            flex-shrink: 0;
        }

        .blog-current-image-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .blog-current-image-title {
            color: var(--text);
            font-size: .82rem;
            font-weight: 700;
        }

        .blog-current-image-text {
            color: var(--text-dimmer);
            font-size: .72rem;
        }

        .blog-no-image {
            margin-top: 12px;
            padding: 12px;
            border-radius: 10px;
            background: color-mix(in srgb, var(--surface) 94%, var(--brand));
            color: var(--text-dimmer);
            font-size: .76rem;
        }

        /* ===== Services Box ===== */
        .blog-services-box {
            padding: 18px;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: color-mix(in srgb, var(--surface) 97%, var(--brand));
        }

        .blog-services-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 15px;
        }

        .blog-services-info {
            color: var(--text-dim);
            font-size: .76rem;
        }

        .blog-services-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 8px;
            background: color-mix(in srgb, var(--brand) 10%, transparent);
            color: var(--brand);
            font-size: .74rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .blog-services-search {
            position: relative;
            margin-bottom: 14px;
        }

        .blog-services-search i {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-dimmer);
            pointer-events: none;
        }

        .blog-services-search input {
            width: 100%;
            height: 42px;
            padding: 0 40px 0 13px;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: var(--surface);
            color: var(--text);
            font-family: inherit;
            box-sizing: border-box;
        }

        .blog-services-search input:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 10%, transparent);
        }

        .blog-services-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .blog-service-option {
            position: relative;
        }

        .blog-service-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .blog-service-card {
            min-height: 72px;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 12px;
            border: 1px solid var(--line);
            border-radius: 11px;
            background: var(--surface);
            cursor: pointer;
            transition: .2s ease;
            box-sizing: border-box;
        }

        .blog-service-card:hover {
            border-color: color-mix(in srgb, var(--brand) 45%, var(--line));
            transform: translateY(-1px);
        }

        .blog-service-option input:checked + .blog-service-card {
            border-color: var(--brand);
            background: color-mix(in srgb, var(--brand) 8%, var(--surface));
            box-shadow: 0 0 0 2px color-mix(in srgb, var(--brand) 10%, transparent);
        }

        .blog-service-check {
            width: 22px;
            height: 22px;
            border-radius: 7px;
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: transparent;
            background: var(--surface);
            transition: .2s ease;
        }

        .blog-service-option input:checked + .blog-service-card .blog-service-check {
            background: var(--brand);
            border-color: var(--brand);
            color: var(--oncta);
        }

        .blog-service-content {
            min-width: 0;
            flex: 1;
        }

        .blog-service-name {
            color: var(--text);
            font-size: .82rem;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .blog-service-number {
            margin-top: 3px;
            color: var(--text-dimmer);
            font-size: .68rem;
        }

        .blog-services-empty {
            display: none;
            padding: 18px;
            text-align: center;
            color: var(--text-dimmer);
            font-size: .78rem;
            border: 1px dashed var(--line);
            border-radius: 10px;
        }

        /* ===== Tags ===== */
        .blog-tags-container {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .blog-tag-row {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .blog-form-input-tag {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border-radius: 9px;
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--text);
            font-family: inherit;
            box-sizing: border-box;
            transition: .2s ease;
        }

        .blog-form-input-tag:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 12%, transparent);
        }

        .blog-tag-remove {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border: none;
            border-radius: 9px;
            background: rgba(239, 68, 68, .1);
            color: #ef4444;
            cursor: pointer;
            transition: .2s ease;
        }

        .blog-tag-remove:hover {
            background: #ef4444;
            color: #fff;
        }

        .blog-tag-add {
            margin-top: 10px;
            padding: 9px 14px;
            border: 1px solid color-mix(in srgb, var(--brand) 35%, var(--line));
            border-radius: 9px;
            background: color-mix(in srgb, var(--brand) 9%, transparent);
            color: var(--brand);
            font-family: inherit;
            font-weight: 650;
            cursor: pointer;
            transition: .2s ease;
        }

        .blog-tag-add:hover {
            background: var(--brand);
            color: var(--oncta);
        }

        /* ===== Editor ===== */
        .blog-editor-box {
            border-radius: 12px;
            overflow: hidden;
        }

        .jodit-container {
            border-radius: 11px !important;
            border: 1px solid var(--line) !important;
            overflow: hidden;
        }

        .jodit-workplace {
            background: var(--surface) !important;
        }

        /* ===== Footer ===== */
        .blog-form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--line);
        }

        .blog-form-footer-info {
            color: var(--text-dimmer);
            font-size: .74rem;
        }

        .blog-form-actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .blog-submit-btn,
        .blog-back-btn {
            min-height: 42px;
            padding: 0 18px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: inherit;
            font-size: .84rem;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .blog-submit-btn {
            border: none;
            background: linear-gradient(135deg, var(--brand), var(--accent-2));
            color: var(--oncta);
            box-shadow: 0 7px 18px color-mix(in srgb, var(--brand) 20%, transparent);
        }

        .blog-submit-btn:hover {
            transform: translateY(-1px);
            filter: brightness(1.06);
        }

        .blog-back-btn {
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--text-dim);
        }

        .blog-back-btn:hover {
            background: var(--card-hover);
            color: var(--text);
        }

        /* ===== Responsive ===== */
        @media (max-width: 1100px) {
            .blog-services-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            .blog-form-grid {
                grid-template-columns: 1fr;
            }

            .blog-form-group.full {
                grid-column: auto;
            }

            .blog-seo-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .blog-page {
                padding: 14px;
            }

            .blog-page-title {
                font-size: 1.05rem;
            }

            .blog-page-icon {
                width: 42px;
                height: 42px;
            }

            .blog-page-subtitle {
                display: none;
            }

            .blog-form-body {
                padding: 17px;
            }

            .blog-form-card-header {
                padding: 17px;
            }

            .blog-form-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .blog-form-footer-info {
                display: none;
            }

            .blog-form-actions {
                width: 100%;
            }

            .blog-submit-btn,
            .blog-back-btn {
                flex: 1;
            }
        }

        @media (max-width: 600px) {
            .blog-services-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .blog-page {
                padding: 10px;
            }

            .blog-page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .blog-back-top {
                width: 100%;
                justify-content: center;
                box-sizing: border-box;
            }

            .blog-form-body {
                padding: 13px;
            }

            .blog-tag-row {
                gap: 7px;
            }

            .blog-tag-remove {
                width: 40px;
                height: 40px;
            }

            .blog-form-actions {
                flex-direction: column;
            }

            .blog-submit-btn,
            .blog-back-btn {
                width: 100%;
            }

            .blog-current-image {
                align-items: flex-start;
            }

            .blog-services-toolbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    <div class="blog-page">
        <div class="blog-page-header">
            <div class="blog-page-heading">
                <div class="blog-page-icon">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <h1 class="blog-page-title">ویرایش مقاله</h1>
                    <p class="blog-page-subtitle">اطلاعات مقاله، سئو، تصویر، سرویس‌ها، تگ‌ها و محتوای مقاله را ویرایش کنید.</p>
                </div>
            </div>
            <a href="{{ route('blogs.index') }}" class="blog-back-top">
                <i class="fa-solid fa-arrow-right"></i>
                بازگشت به مقالات
            </a>
        </div>

        @if (session('success'))
            <div class="blog-alert blog-alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="blog-alert blog-alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="blog-alert blog-alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div>
                    <strong>اطلاعات وارد شده صحیح نیست:</strong>
                    <ul style="margin-top:6px;padding-right:20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="blog-form-card">
            <div class="blog-form-card-header">
                <h2 class="blog-form-card-header-title">
                    <i class="fa-solid fa-file-pen"></i>
                    ویرایش اطلاعات مقاله
                </h2>
            </div>

            <div class="blog-form-body">
                <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- 01 · اطلاعات اصلی --}}
                    <div class="blog-section">
                        <div class="blog-section-title">
                            <div class="blog-section-number">01</div>
                            <h3 class="blog-section-name">اطلاعات اصلی</h3>
                            <div class="blog-section-line"></div>
                        </div>

                        <div class="blog-form-grid">
                            <div class="blog-form-group full">
                                <label class="blog-form-label">عنوان مقاله <span class="blog-required">*</span></label>
                                <input type="text" name="title" value="{{ old('title', $blog->title) }}" required class="blog-form-input" placeholder="عنوان مقاله را وارد کنید">
                                @error('title')
                                    <small class="blog-form-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="blog-form-group">
                                <label class="blog-form-label">دسته‌بندی <span class="blog-required">*</span></label>
                                <select name="cat_id" required class="blog-form-select">
                                    <option value="">انتخاب دسته‌بندی</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('cat_id', $blog->cat_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cat_id')
                                    <small class="blog-form-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="blog-form-group">
                                <label class="blog-form-label">زمان مطالعه</label>
                                <input type="number" name="reading-time" value="{{ old('reading-time', $blog->{'reading-time'}) }}" class="blog-form-input" placeholder="مثلاً 5" min="1">
                                @error('reading-time')
                                    <small class="blog-form-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="blog-form-group">
                                <label class="blog-form-label">شماره / اولویت</label>
                                <input type="number" name="number" value="{{ old('number', $blog->number) }}" class="blog-form-input" placeholder="مثلاً 1">
                                @error('number')
                                    <small class="blog-form-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="blog-form-group">
                                <label class="blog-form-label">Slug <span class="blog-required">*</span></label>
                                <input type="text" name="slug" value="{{ old('slug', $blog->slug) }}" required class="blog-form-input" placeholder="مثلاً my-article" dir="ltr">
                                @error('slug')
                                    <small class="blog-form-error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- 02 · تنظیمات سئو --}}
                    <div class="blog-section">
                        <div class="blog-section-title">
                            <div class="blog-section-number">02</div>
                            <h3 class="blog-section-name">تنظیمات سئو</h3>
                            <div class="blog-section-line"></div>
                        </div>

                        <div class="blog-seo-box">
                            <div class="blog-seo-header">
                                <div class="blog-seo-header-icon">
                                    <i class="fa-solid fa-magnifying-glass-chart"></i>
                                </div>
                                <div>
                                    <h4 class="blog-seo-title">اطلاعات موتورهای جستجو</h4>
                                    <p class="blog-seo-subtitle">عنوان و توضیحات سئو مقاله</p>
                                </div>
                            </div>

                            <div class="blog-seo-grid">
                                <div class="blog-form-group">
                                    <label class="blog-form-label">Meta</label>
                                    <input type="text" name="meta" value="{{ old('meta', $blog->meta) }}" class="blog-form-input" placeholder="توضیحات کوتاه برای موتور جستجو">
                                    @error('meta')
                                        <small class="blog-form-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="blog-form-group">
                                    <label class="blog-form-label">Title Head</label>
                                    <input type="text" name="title_head" value="{{ old('title_head', $blog->title_head) }}" class="blog-form-input" placeholder="عنوان اصلی صفحه">
                                    @error('title_head')
                                        <small class="blog-form-error">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 03 · سرویس‌های مرتبط --}}
                    <div class="blog-section">
                        <div class="blog-section-title">
                            <div class="blog-section-number">03</div>
                            <h3 class="blog-section-name">سرویس‌های مرتبط</h3>
                            <div class="blog-section-line"></div>
                        </div>

                        <div class="blog-services-box">
                            <div class="blog-services-toolbar">
                                <div class="blog-services-info">
                                    می‌توانید یک یا چند سرویس مرتبط با این مقاله را انتخاب کنید.
                                </div>
                                <div class="blog-services-count">
                                    <i class="fa-solid fa-layer-group"></i>
                                    <span id="selected-services-count">0</span>
                                    سرویس انتخاب شده
                                </div>
                            </div>

                            <div class="blog-services-search">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" id="service-search" placeholder="جستجوی سرویس...">
                            </div>

                            <div class="blog-services-grid" id="services-grid">
                                @php
                                    $selectedServices = old('services', $blog->services->pluck('id')->toArray());
                                @endphp

                                @foreach ($services as $service)
                                    <label class="blog-service-option" data-service-name="{{ $service->title }}">
                                        <input
                                            type="checkbox"
                                            name="services[]"
                                            value="{{ $service->id }}"
                                            {{ in_array($service->id, $selectedServices) ? 'checked' : '' }}
                                        >
                                        <div class="blog-service-card">
                                            <div class="blog-service-check">
                                                <i class="fa-solid fa-check"></i>
                                            </div>
                                            <div class="blog-service-content">
                                                <div class="blog-service-name">{{ $service->title }}</div>
                                                @if ($service->number !== null)
                                                    <div class="blog-service-number">اولویت {{ $service->number }}</div>
                                                @else
                                                    <div class="blog-service-number">سرویس {{ $service->id }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <div class="blog-services-empty" id="services-empty">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                سرویسی با این عنوان پیدا نشد.
                            </div>

                            @error('services')
                                <small class="blog-form-error">{{ $message }}</small>
                            @enderror

                            @error('services.*')
                                <small class="blog-form-error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- 04 · وضعیت و مکان نمایش --}}
                    <div class="blog-section">
                        <div class="blog-section-title">
                            <div class="blog-section-number">04</div>
                            <h3 class="blog-section-name">وضعیت و مکان نمایش</h3>
                            <div class="blog-section-line"></div>
                        </div>

                        <div class="blog-form-grid">

                            {{-- وضعیت --}}
                            <div class="blog-form-group">
                                <label class="blog-form-label">وضعیت نمایش</label>
                                <label class="blog-toggle">
                                    <input type="checkbox" name="is_active" value="1"
                                        {{ old('is_active', $blog->is_active ?? true) ? 'checked' : '' }}>
                                    <span class="blog-toggle-slider"></span>
                                    <span class="blog-toggle-text">فعال باشد (نمایش در سایت)</span>
                                </label>
                                @error('is_active')<small class="blog-form-error">{{ $message }}</small>@enderror
                            </div>

                            {{-- مکان نمایش --}}
                            <div class="blog-form-group">
                                <label class="blog-form-label">مکان نمایش در صفحه اصلی</label>
                                <select name="display_position" class="blog-form-select">
                                    <option value="">نمایش داده نشود (پیش‌فرض)</option>
                                    <option value="blog-list" {{ old('display_position', $blog->display_position) == 'blog-list' ? 'selected' : '' }}>
                                        لیست مقالات — blog-list (ظرفیت: ۴)
                                    </option>
                                    <option value="blog-feature" {{ old('display_position', $blog->display_position) == 'blog-feature' ? 'selected' : '' }}>
                                        مقاله ویژه — blog-feature (ظرفیت: ۱)
                                    </option>
                                    <option value="blog-side" {{ old('display_position', $blog->display_position) == 'blog-side' ? 'selected' : '' }}>
                                        کارت کناری — blog-side (ظرفیت: ۲)
                                    </option>
                                </select>
                                <small class="blog-form-hint">مجموع ظرفیت: ۷ مقاله در صفحه اصلی</small>
                                @error('display_position')<small class="blog-form-error">{{ $message }}</small>@enderror
                            </div>

                        </div>
                    </div>

                    {{-- 05 · تصویر مقاله --}}
                    <div class="blog-section">
                        <div class="blog-section-title">
                            <div class="blog-section-number">05</div>
                            <h3 class="blog-section-name">تصویر مقاله</h3>
                            <div class="blog-section-line"></div>
                        </div>

                        <div class="blog-image-box">
                            <div class="blog-form-group">
                                <label class="blog-form-label">تصویر شاخص جدید</label>
                                <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp" class="blog-file">
                                <div class="blog-image-hint">
                                    در صورت انتخاب تصویر جدید، تصویر فعلی جایگزین می‌شود.
                                    فرمت‌های مجاز: JPG، JPEG، PNG و WEBP — حداکثر 2MB
                                </div>
                            </div>

                            @if ($blog->image_url)
                                <div class="blog-current-image">
                                    <img src="{{ asset($blog->image_url) }}" alt="{{ $blog->title }}" class="blog-current-image-preview">
                                    <div class="blog-current-image-info">
                                        <div class="blog-current-image-title">تصویر فعلی مقاله</div>
                                        <div class="blog-current-image-text">برای تغییر تصویر، فایل جدید را انتخاب کنید.</div>
                                    </div>
                                </div>
                            @else
                                <div class="blog-no-image">
                                    <i class="fa-solid fa-image"></i>
                                    تصویری برای این مقاله ثبت نشده است.
                                </div>
                            @endif

                            @error('image')
                                <small class="blog-form-error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    {{-- 06 · تگ‌های مقاله --}}
                    <div class="blog-section">
                        <div class="blog-section-title">
                            <div class="blog-section-number">06</div>
                            <h3 class="blog-section-name">تگ‌های مقاله</h3>
                            <div class="blog-section-line"></div>
                        </div>

                        <div class="blog-tags-container" id="tags-container">
                            @if (old('tags'))
                                @foreach (old('tags') as $tag)
                                    <div class="blog-tag-row">
                                        <input type="text" name="tags[]" value="{{ $tag }}" placeholder="مثلاً Laravel" class="blog-form-input-tag">
                                        <button type="button" onclick="removeTag(this)" class="blog-tag-remove" title="حذف تگ">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @elseif ($blogTags->count())
                                @foreach ($blogTags as $tag)
                                    <div class="blog-tag-row">
                                        <input type="text" name="tags[]" value="{{ $tag->text }}" placeholder="مثلاً Laravel" class="blog-form-input-tag">
                                        <button type="button" onclick="removeTag(this)" class="blog-tag-remove" title="حذف تگ">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="blog-tag-row">
                                    <input type="text" name="tags[]" placeholder="مثلاً Laravel" class="blog-form-input-tag">
                                    <button type="button" onclick="removeTag(this)" class="blog-tag-remove" title="حذف تگ">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <button type="button" onclick="addTag()" class="blog-tag-add">
                            <i class="fa-solid fa-plus"></i>
                            افزودن تگ
                        </button>

                        @error('tags.*')
                            <small class="blog-form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- 07 · محتوای مقاله --}}
                    <div class="blog-section">
                        <div class="blog-section-title">
                            <div class="blog-section-number">07</div>
                            <h3 class="blog-section-name">محتوای مقاله</h3>
                            <div class="blog-section-line"></div>
                        </div>

                        <div class="blog-editor-box">
                            <textarea id="editor" name="text">{{ old('text', $blog->text) }}</textarea>
                            @error('text')
                                <small class="blog-form-error">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="blog-form-footer">
                        <div class="blog-form-footer-info">
                            <i class="fa-solid fa-circle-info"></i>
                            فیلدهای دارای علامت <span style="color:#ef4444;">*</span> الزامی هستند.
                        </div>

                        <div class="blog-form-actions">
                            <a href="{{ route('blogs.index') }}" class="blog-back-btn">
                                <i class="fa-solid fa-xmark"></i>
                                انصراف
                            </a>
                            <button type="submit" class="blog-submit-btn">
                                <i class="fa-solid fa-floppy-disk"></i>
                                بروزرسانی مقاله
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.js"></script>
    <script>
        function addTag() {
            const container = document.getElementById('tags-container');
            const row = document.createElement('div');
            row.className = 'blog-tag-row';
            row.innerHTML = `
                <input type="text" name="tags[]" placeholder="مثلاً Laravel" class="blog-form-input-tag">
                <button type="button" onclick="removeTag(this)" class="blog-tag-remove" title="حذف تگ">
                    <i class="fa-solid fa-trash"></i>
                </button>
            `;
            container.appendChild(row);
        }

        function removeTag(button) {
            const rows = document.querySelectorAll('.blog-tag-row');
            if (rows.length > 1) {
                button.closest('.blog-tag-row').remove();
            } else {
                button.closest('.blog-tag-row').querySelector('input').value = '';
            }
        }

        function updateServicesCount() {
            const checked = document.querySelectorAll('input[name="services[]"]:checked').length;
            document.getElementById('selected-services-count').textContent = checked;
        }

        document.querySelectorAll('input[name="services[]"]').forEach(function(input) {
            input.addEventListener('change', updateServicesCount);
        });

        const serviceSearch = document.getElementById('service-search');
        const serviceOptions = document.querySelectorAll('.blog-service-option');
        const servicesEmpty = document.getElementById('services-empty');

        serviceSearch.addEventListener('input', function() {
            const value = this.value.trim().toLowerCase();
            let visibleCount = 0;

            serviceOptions.forEach(function(option) {
                const name = option.getAttribute('data-service-name').toLowerCase();
                const visible = name.includes(value);
                option.style.display = visible ? '' : 'none';

                if (visible) {
                    visibleCount++;
                }
            });

            servicesEmpty.style.display = visibleCount === 0 ? 'block' : 'none';
        });

        updateServicesCount();

        const editor = new Jodit('#editor', {
            width: '100%',
            height: 400,
            allowResize: true,
            allowResizeImages: true,
            buttons: [
                'source',
                '|',
                'undo',
                'redo',
                '|',
                'cut',
                'copy',
                'paste',
                'selectall',
                'removeformat',
                '|',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                'subscript',
                'superscript',
                '|',
                'font',
                'fontsize',
                'brush',
                'paragraph',
                '|',
                'ul',
                'ol',
                'outdent',
                'indent',
                '|',
                'align',
                'hr',
                'table',
                '|',
                'link',
                'unlink',
                '|',
                {
                    name: 'uploadImage',
                    iconURL: 'https://cdn-icons-png.flaticon.com/512/1829/1829586.png',
                    tooltip: 'آپلود تصویر',
                    exec: (editor) => {
                        const input = document.createElement('input');
                        input.type = 'file';
                        input.accept = 'image/*';

                        input.onchange = () => {
                            const file = input.files[0];

                            if (!file) {
                                return;
                            }

                            const formData = new FormData();
                            formData.append('file', file);

                            fetch('{{ route('upload.image') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.files && data.files[0] && data.files[0].url) {
                                    const img = document.createElement('img');
                                    img.src = data.files[0].url;
                                    img.style.maxWidth = '100%';
                                    editor.s.insertNode(img);
                                } else {
                                    alert('خطا در آپلود تصویر');
                                }
                            })
                            .catch(error => {
                                console.error(error);
                                alert('خطا در آپلود تصویر');
                            });
                        };

                        input.click();
                    }
                },
                {
                    name: 'uploadVideo',
                    iconURL: 'https://cdn-icons-png.flaticon.com/512/727/727245.png',
                    tooltip: 'آپلود ویدیو',
                    exec: (editor) => {
                        const input = document.createElement('input');
                        input.type = 'file';
                        input.accept = 'video/*';

                        input.onchange = () => {
                            const file = input.files[0];

                            if (!file) {
                                return;
                            }

                            const formData = new FormData();
                            formData.append('file', file);

                            fetch('{{ route('upload.video') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.files && data.files[0] && data.files[0].url) {
                                    const wrapper = document.createElement('div');
                                    wrapper.classList.add('video-wrapper');

                                    const video = document.createElement('video');
                                    video.setAttribute('controls', '');
                                    video.style.maxWidth = '100%';
                                    video.src = data.files[0].url;

                                    wrapper.appendChild(video);
                                    editor.s.insertNode(wrapper);
                                } else {
                                    alert('خطا در آپلود ویدیو');
                                }
                            })
                            .catch(error => {
                                console.error(error);
                                alert('خطا در آپلود ویدیو');
                            });
                        };

                        input.click();
                    }
                },
                '|',
                'symbols',
                'emoticons',
                'specialCharacters',
                '|',
                'print',
                'fullsize',
                'preview',
                '|',
                'about'
            ],
            colors: {
                text: [
                    '#000000',
                    '#ff0000',
                    '#00ff00',
                    '#0000ff',
                    '#ff00ff',
                    '#00ffff'
                ],
                background: [
                    '#ffffff',
                    '#ffff00',
                    '#00ffff',
                    '#ffcc99'
                ]
            },
            defaultFont: 'Vazir, Tahoma, Arial, sans-serif',
            defaultFontSize: '14px',
            fonts: [
                'Vazir',
                'Tahoma',
                'Arial',
                'Courier New'
            ]
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.css">
@endsection