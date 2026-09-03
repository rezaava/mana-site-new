@extends('admin.panel')

@section('content')
<style>
    /* استایل‌های اضافی برای فرم ویرایش */
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
    .form-group {
        margin-bottom: 1.2rem;
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
    .existing-image-preview {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 8px;
    }
    .existing-image-preview img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--border);
        padding: 3px;
        background: var(--bg);
    }
    .stats-grid, .tech-grid, .services-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin-top: 10px;
    }
    .stats-grid .field-group, .tech-grid .field-group, .services-grid .field-group {
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
    .gallery-category .gallery-files .file-item .preview-img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid var(--border);
        background: var(--bg);
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
    /* توضیحات بخش‌ها */
    .section-description {
        font-size: 0.85rem;
        color: var(--text-dimmer);
        margin-top: -10px;
        margin-bottom: 15px;
        padding-right: 4px;
    }
    @media (max-width: 992px) {
        .stats-grid, .tech-grid, .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .gallery-category .gallery-files {
            grid-template-columns: 1fr 1fr;
        }
    }
    @media (max-width: 576px) {
        .stats-grid, .tech-grid, .services-grid {
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
            <i class="fa-solid fa-pen-to-square" style="color:var(--accent-2);margin-left:10px;"></i> ویرایش پروژه
        </h5>

        <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ===== اطلاعات اصلی ===== --}}
            <div class="form-section-title"><i class="fa-solid fa-circle-info"></i> اطلاعات اصلی پروژه</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">عنوان پروژه <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" required class="form-control-custom">
                </div>
                <div class="col-md-6">
                    <label class="form-label">زیرعنوان</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $project->subtitle) }}" class="form-control-custom" placeholder="مثلاً: افزونه‌ای برای حرفه‌ای شدن">
                </div>
                <div class="col-md-6">
                    <label class="form-label">دسته‌بندی</label>
                    <select name="cat_id" class="form-control-custom">
                        <option style="color: var(--text-dim);" value="">انتخاب دسته‌بندی...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" style="color: var(--text-dim);" {{ old('cat_id', $project->cat_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">نام کارفرما</label>
                    <input type="text" name="client_name" value="{{ old('client_name', $project->client_name) }}" class="form-control-custom" placeholder="مثلاً: شرکت بهین فرتاک">
                </div>
                <div class="col-md-6">
                    <label class="form-label">سمت کارفرما</label>
                    <input type="text" name="client_role" value="{{ old('client_role', $project->client_role) }}" class="form-control-custom" placeholder="مثلاً: مدیرعامل">
                </div>
                <div class="col-md-6">
                    <label class="form-label">سال اجرا</label>
                    <input type="text" name="launch_year" value="{{ old('launch_year', $project->launch_year) }}" class="form-control-custom" placeholder="مثلاً: ۱۴۰۲">
                </div>
                <div class="col-md-6">
                    <label class="form-label">مدت زمان</label>
                    <input type="text" name="duration" value="{{ old('duration', $project->duration) }}" class="form-control-custom" placeholder="مثلاً: ۳ سال">
                </div>
                <div class="col-md-6">
                    <label class="form-label">لینک پروژه</label>
                    <input type="url" name="project_link" value="{{ old('project_link', $project->project_link) }}" class="form-control-custom" placeholder="https://example.com">
                </div>
                <div class="col-12">
                    <label class="form-label">توضیح کوتاه (Brief)</label>
                    <textarea name="brief" rows="2" class="form-control-custom">{{ old('brief', $project->brief) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">توضیحات کامل پروژه</label>
                    <textarea name="desc" rows="4" class="form-control-custom">{{ old('desc', $project->desc) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">هدف پروژه</label>
                    <textarea name="project_goal" rows="3" class="form-control-custom" placeholder="هدف از انجام این پروژه چه بود؟">{{ old('project_goal', $project->project_goal) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label" style="color:#f5a623;"><i class="fa-solid fa-triangle-exclamation"></i> چالش اصلی</label>
                    <textarea name="challenge" rows="4" class="form-control-custom" placeholder="چالش‌های اصلی پروژه را بنویسید...">{{ old('challenge', $project->challenge) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label" style="color:#00d1b2;"><i class="fa-solid fa-lightbulb"></i> راه‌حل ما</label>
                    <textarea name="solution" rows="4" class="form-control-custom" placeholder="راه‌حل‌های پیاده‌سازی‌شده را بنویسید...">{{ old('solution', $project->solution) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">نقل قول از کارفرما (Testimonial)</label>
                    <textarea name="testimonial" rows="3" class="form-control-custom" placeholder="نظر کارفرما درباره پروژه...">{{ old('testimonial', $project->testimonial) }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label">تصویر شاخص پروژه</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="image" accept="image/*">
                        @if($project->image_url)
                            <div class="existing-image-preview">
                                <img src="{{ asset('storage/' . $project->image_url) }}" alt="تصویر فعلی">
                                <span style="font-size:0.85rem;color:var(--text-dimmer);align-self:center;">تصویر فعلی</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ===== آمارها ===== --}}
<div class="form-section-title"><i class="fa-solid fa-chart-simple"></i> آمارهای پروژه</div>
<p class="section-description">حداکثر ۴ آیتم آمار را وارد کنید. هر آیتم شامل یک مقدار و یک برچسب توضیحی است.</p>
<div class="stats-grid">
    @php
        $stats = $project->stats->toArray();
        $stats = array_pad($stats, 4, ['value' => '', 'label' => '']);
    @endphp
    @foreach($stats as $index => $stat)
        <div class="field-group" style="border:1px solid var(--border);border-radius:8px;padding:12px;background:var(--bg-soft);">
            <span class="field-label" style="font-weight:700;color:var(--text);">آمار {{ $index + 1 }}</span>
            <div style="margin-top:6px;">
                <span class="field-label">مقدار</span>
                <input type="text" name="stats_value[]" value="{{ $stat['value'] ?? '' }}" class="form-control-custom" placeholder="مثلاً ۴۵%">
            </div>
            <div style="margin-top:6px;">
                <span class="field-label">برچسب</span>
                <input type="text" name="stats_label[]" value="{{ $stat['label'] ?? '' }}" class="form-control-custom" placeholder="مثلاً افزایش نرخ تبدیل">
            </div>
        </div>
    @endforeach
</div>
</div>

            {{-- ===== گالری تصاویر ===== --}}
            <div class="form-section-title"><i class="fa-solid fa-images"></i> گالری تصاویر</div>
            <p class="section-description">هر دسته‌بندی می‌تواند تا ۳ تصویر داشته باشد. تصاویر جدید جایگزین تصاویر قبلی می‌شوند.</p>
            @php
                $galleryCategories = ['desktop' => 'دسکتاپ', 'mobile' => 'موبایل', 'key_pages' => 'صفحات کلیدی'];
                $existingGalleries = $project->galleries->groupBy('category');
            @endphp

            @foreach($galleryCategories as $catKey => $catLabel)
                <div class="gallery-category">
                    <span class="category-label"><i class="fa-regular fa-folder-open"></i> {{ $catLabel }}</span>
                    <div class="gallery-files">
                        @php
                            $images = $existingGalleries->get($catKey, collect())->toArray();
                            $images = array_pad($images, 3, ['image_url' => '']);
                        @endphp
                        @foreach($images as $idx => $img)
                            <div class="file-item">
                                <span class="field-label" style="font-size:0.75rem;color:var(--text-dimmer);">تصویر {{ $idx+1 }}</span>
                                <input type="file" name="gallery_images[{{ $catKey }}][]" accept="image/*">
                                @if(!empty($img['image_url']))
                                    <div style="display:flex;align-items:center;gap:6px;margin-top:4px;">
                                        <img src="{{ asset('storage/' . $img['image_url']) }}" class="preview-img" alt="تصویر موجود">
                                        <input type="hidden" name="gallery_existing[{{ $catKey }}][]" value="{{ $img['id'] ?? '' }}">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            {{-- ===== تکنولوژی‌ها ===== --}}
<div class="form-section-title"><i class="fa-solid fa-code"></i> تکنولوژی‌های استفاده‌شده</div>
<p class="section-description">تکنولوژی‌های استفاده‌شده در این پروژه را انتخاب کنید.</p>
<div class="tech-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:10px;">
    @foreach($allTechnologies as $tech)
        <label style="display:flex;align-items:center;gap:8px;padding:8px 12px;border:1px solid var(--border);border-radius:8px;cursor:pointer;transition:all 0.3s;background:{{ in_array($tech['name'], $projectTechNames) ? 'var(--surface-2)' : 'transparent' }};">
            <input type="checkbox" name="technologies[]" value="{{ $tech['name'] }}" 
                   {{ in_array($tech['name'], $projectTechNames) ? 'checked' : '' }}
                   style="width:18px;height:18px;accent-color:var(--accent-2);cursor:pointer;">
            <i class="{{ $tech['icon'] }}" style="color:var(--accent-2);font-size:1.2rem;width:24px;"></i>
            <span style="font-weight:500;">{{ $tech['name'] }}</span>
        </label>
    @endforeach
</div>
<!-- فیلد مخفی برای آیکون‌ها (در صورت نیاز) -->
@foreach($allTechnologies as $tech)
    <input type="hidden" name="tech_icon[{{ $tech['name'] }}]" value="{{ $tech['icon'] }}">
@endforeach
            {{-- ===== خدمات ===== --}}
            <div class="form-section-title"><i class="fa-solid fa-list-check"></i> خدمات ارائه‌شده در پروژه</div>
            <p class="section-description">خدماتی که در این پروژه ارائه شده‌اند را وارد کنید. می‌توانید تا ۵ مورد وارد کنید.</p>
            <div class="services-grid">
                @php
                    $services = $project->services->toArray();
                    $services = array_pad($services, 5, ['name' => '']);
                @endphp
                @foreach($services as $service)
                    <div class="field-group">
                        <span class="field-label">نام خدمت</span>
                        <input type="text" name="service_name[]" value="{{ $service['name'] ?? '' }}" class="form-control-custom" placeholder="مثلاً طراحی UX/UI">
                    </div>
                @endforeach
            </div>

            {{-- ===== دکمه‌ها ===== --}}
            <div class="inline-actions">
                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-save"></i> بروزرسانی پروژه
                </button>
                <a href="{{ route('projects.index') }}" class="btn-secondary">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت به لیست
                </a>
            </div>

        </form>
    </div>
</div>
@endsection