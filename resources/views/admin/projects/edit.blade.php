@extends('admin.panel')

@section('content')
    <style>
        /* ===== استایل فرم ویرایش پروژه ===== */
        .project-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }

        .form-section-title {
            margin: 35px 0 15px;
            color: var(--accent);
            font-size: 1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--line);
        }

        .form-section-title i {
            font-size: 1.1rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--text-dim);
            font-size: 0.9rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
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

        select option{
            color: var(--oncta);
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 20%, transparent);
            background: var(--card-hover);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: var(--text-dimmer);
        }

        .form-select {
            appearance: auto;
        }

        .form-file {
            padding: 8px;
            cursor: pointer;
            border: 1px dashed var(--line);
            border-radius: 8px;
            background: var(--surface-2);
            color: var(--text-dim);
            width: 100%;
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
            font-family: inherit;
            font-size: 0.9rem;
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
            font-family: inherit;
            font-size: 0.9rem;
        }

        .btn-back-form:hover {
            background: var(--card-hover);
            color: var(--text);
        }

        .section-description {
            font-size: 0.85rem;
            color: var(--text-dimmer);
            margin: -8px 0 15px;
        }

        .field-group-box {
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 15px;
            background: var(--surface-2);
            margin-bottom: 15px;
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
            background: var(--surface-2);
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
            border: 1px dashed var(--line);
            border-radius: 6px;
            background: var(--surface);
            font-size: 0.85rem;
            color: var(--text-dim);
            width: 100%;
        }

        .gallery-category .gallery-files .file-item .preview-img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--line);
            background: var(--bg);
        }

        .tech-grid,
        .stats-grid,
        .services-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 10px;
        }

        .services-grid {
            grid-template-columns: repeat(5, 1fr);
        }

        .tech-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            border: 1px solid var(--line);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
            background: var(--surface);
        }

        .tech-label:hover {
            border-color: var(--accent-2);
            background: var(--card-hover);
        }

        .tech-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--accent-2);
            cursor: pointer;
        }

        .tech-label i {
            color: var(--accent-2);
            font-size: 1.2rem;
            width: 24px;
        }

        .tech-label span {
            font-weight: 500;
        }

        .inline-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid var(--line);
        }

        /* ===== ریسپانسیو ===== */
        @media (max-width: 992px) {
            .tech-grid,
            .stats-grid,
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-category .gallery-files {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 576px) {
            .project-form-card {
                padding: 15px;
            }

            .tech-grid,
            .stats-grid,
            .services-grid,
            .gallery-category .gallery-files {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div style="padding:20px;">
        <div class="project-form-card">
            <h5 style="margin-bottom:25px; font-weight:700; font-size:1.2rem; color:var(--text);">
                <i class="fa-solid fa-pen-to-square" style="color:var(--accent-2); margin-left:10px;"></i>
                ویرایش پروژه
            </h5>

            <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- اطلاعات اصلی --}}
                <div class="form-section-title">
                    <i class="fa-solid fa-circle-info"></i>
                    اطلاعات اصلی پروژه
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">عنوان پروژه <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $project->title) }}" required class="form-input">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">زیرعنوان</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $project->subtitle) }}" class="form-input"
                            placeholder="مثلاً: افزونه‌ای برای حرفه‌ای شدن">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">دسته‌بندی</label>
                        <select name="cat_id" class="form-select">
                            <option value="">انتخاب دسته‌بندی...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('cat_id', $project->cat_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>  

                    <div class="col-md-6">
                        <label class="form-label">نام کارفرما</label>
                        <input type="text" name="client_name" value="{{ old('client_name', $project->client_name) }}" class="form-input"
                            placeholder="مثلاً: شرکت بهین فرتاک">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">سمت کارفرما</label>
                        <input type="text" name="client_role" value="{{ old('client_role', $project->client_role) }}" class="form-input"
                            placeholder="مثلاً: مدیرعامل">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">سال اجرا</label>
                        <input type="text" name="launch_year" value="{{ old('launch_year', $project->launch_year) }}" class="form-input"
                            placeholder="مثلاً: ۱۴۰۲">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">مدت زمان</label>
                        <input type="text" name="duration" value="{{ old('duration', $project->duration) }}" class="form-input"
                            placeholder="مثلاً: ۳ سال">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">لینک پروژه</label>
                        <input type="url" name="project_link" value="{{ old('project_link', $project->project_link) }}" class="form-input"
                            placeholder="https://example.com" dir="ltr">
                    </div>

                    <div class="col-12">
                        <label class="form-label">توضیح کوتاه (Brief)</label>
                        <textarea name="brief" rows="2" class="form-textarea">{{ old('brief', $project->brief) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">توضیحات کامل پروژه</label>
                        <textarea name="desc" rows="4" class="form-textarea">{{ old('desc', $project->desc) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">هدف پروژه</label>
                        <textarea name="project_goal" rows="3" class="form-textarea"
                            placeholder="هدف از انجام این پروژه چه بود؟">{{ old('project_goal', $project->project_goal) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" style="color:#f5a623;">
                            <i class="fa-solid fa-triangle-exclamation"></i> چالش اصلی
                        </label>
                        <textarea name="challenge" rows="4" class="form-textarea"
                            placeholder="چالش‌های اصلی پروژه را بنویسید...">{{ old('challenge', $project->challenge) }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" style="color:#00d1b2;">
                            <i class="fa-solid fa-lightbulb"></i> راه‌حل ما
                        </label>
                        <textarea name="solution" rows="4" class="form-textarea"
                            placeholder="راه‌حل‌های پیاده‌سازی‌شده را بنویسید...">{{ old('solution', $project->solution) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">نقل قول از کارفرما (Testimonial)</label>
                        <textarea name="testimonial" rows="3" class="form-textarea"
                            placeholder="نظر کارفرما درباره پروژه...">{{ old('testimonial', $project->testimonial) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">تصویر شاخص پروژه</label>
                        <input type="file" name="image" accept="image/*" class="form-file">
                        @if($project->image_url)
                            <div class="existing-image-preview" style="margin-top:8px;">
                                <img src="{{ asset('storage/' . $project->image_url) }}" alt="تصویر فعلی"
                                    style="width:70px;height:70px;object-fit:cover;border-radius:8px;border:1px solid var(--line);">
                                <span style="font-size:0.85rem;color:var(--text-dimmer);align-self:center;">تصویر فعلی</span>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">افزودن Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $project->slug) }}" class="form-input" placeholder="slug">
                    </div>
                </div>

                {{-- آمارها --}}
                <div class="form-section-title">
                    <i class="fa-solid fa-chart-simple"></i>
                    آمارهای پروژه
                </div>
                <p class="section-description">حداکثر ۴ آیتم آمار را وارد کنید.</p>

                <div class="stats-grid">
                    @php
                        $stats = $project->stats->toArray();
                        $stats = array_pad($stats, 4, ['value' => '', 'label' => '']);
                    @endphp
                    @foreach($stats as $index => $stat)
                        <div class="field-group-box">
                            <span style="font-weight:700; color:var(--text);">آمار {{ $index + 1 }}</span>
                            <div style="margin-top:8px;">
                                <label class="form-label">مقدار</label>
                                <input type="text" name="stats_value[]" value="{{ $stat['value'] ?? '' }}" class="form-input"
                                    placeholder="مثلاً ۴۵%">
                            </div>
                            <div style="margin-top:8px;">
                                <label class="form-label">برچسب</label>
                                <input type="text" name="stats_label[]" value="{{ $stat['label'] ?? '' }}" class="form-input"
                                    placeholder="مثلاً افزایش نرخ تبدیل">
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- گالری تصاویر --}}
                <div class="form-section-title">
                    <i class="fa-solid fa-images"></i>
                    گالری تصاویر
                </div>
                <p class="section-description">هر دسته‌بندی می‌تواند تا ۳ تصویر داشته باشد. تصاویر جدید جایگزین تصاویر قبلی می‌شوند.</p>

                @php
                    $galleryCategories = ['desktop' => 'دسکتاپ', 'mobile' => 'موبایل', 'key_pages' => 'صفحات کلیدی'];
                    $existingGalleries = $project->galleries->groupBy('category');
                @endphp

                @foreach($galleryCategories as $catKey => $catLabel)
                    <div class="gallery-category">
                        <span class="category-label">
                            <i class="fa-regular fa-folder-open"></i> {{ $catLabel }}
                        </span>
                        <div class="gallery-files">
                            @php
                                $images = $existingGalleries->get($catKey, collect())->toArray();
                                $images = array_pad($images, 3, ['image_url' => '']);
                            @endphp
                            @foreach($images as $idx => $img)
                                <div class="file-item">
                                    <span style="font-size:0.75rem; color:var(--text-dimmer);">تصویر {{ $idx + 1 }}</span>
                                    <input type="file" name="gallery_images[{{ $catKey }}][]" accept="image/*">
                                    @if(!empty($img['image_url']))
                                        <div style="display:flex; align-items:center; gap:6px; margin-top:4px;">
                                            <img src="{{ asset('storage/' . $img['image_url']) }}" class="preview-img" alt="تصویر موجود">
                                            <input type="hidden" name="gallery_existing[{{ $catKey }}][]" value="{{ $img['id'] ?? '' }}">
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                {{-- تکنولوژی‌ها --}}
                <div class="form-section-title">
                    <i class="fa-solid fa-code"></i>
                    تکنولوژی‌های استفاده‌شده
                </div>
                <p class="section-description">تکنولوژی‌های استفاده‌شده در این پروژه را انتخاب کنید.</p>

                <div class="tech-grid">
                    @foreach($allTechnologies as $tech)
                        <label class="tech-label">
                            <input type="checkbox" name="technologies[]" value="{{ $tech['name'] }}"
                                {{ in_array($tech['name'], $projectTechNames) ? 'checked' : '' }}>
                            <i class="{{ $tech['icon'] }}"></i>
                            <span>{{ $tech['name'] }}</span>
                        </label>
                    @endforeach
                </div>

                @foreach($allTechnologies as $tech)
                    <input type="hidden" name="tech_icon[{{ $tech['name'] }}]" value="{{ $tech['icon'] }}">
                @endforeach

                {{-- خدمات --}}
                <div class="form-section-title">
                    <i class="fa-solid fa-list-check"></i>
                    خدمات ارائه‌شده در پروژه
                </div>
                <p class="section-description">خدماتی که در این پروژه ارائه شده‌اند را وارد کنید. (تا ۵ مورد)</p>

                <div class="services-grid">
                    @php
                        $services = $project->services->toArray();
                        $services = array_pad($services, 5, ['name' => '']);
                    @endphp
                    @foreach($services as $service)
                        <div>
                            <label class="form-label">نام خدمت</label>
                            <input type="text" name="service_name[]" value="{{ $service['name'] ?? '' }}" class="form-input"
                                placeholder="مثلاً طراحی UX/UI">
                        </div>
                    @endforeach
                </div>

                {{-- دکمه‌ها --}}
                <div class="inline-actions">
                    <button type="submit" class="btn-submit-form">
                        <i class="fa-solid fa-save"></i> بروزرسانی پروژه
                    </button>
                    <a href="{{ route('projects.index') }}" class="btn-back-form">
                        <i class="fa-solid fa-arrow-right"></i> بازگشت به لیست
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection