@extends('admin.panel')

@section('content')
    <style>
        /* ===== استایل فرم خدمت (ویرایش) ===== */
        .service-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }

        .service-form-header {
            margin-bottom: 25px;
        }

        .service-form-title {
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

        .form-grid-3 {
            grid-template-columns: repeat(3, 1fr);
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
        .form-textarea,
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
        .form-textarea:focus,
        .form-file:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 20%, transparent);
            background: var(--card-hover);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: var(--text-dimmer);
        }

        .form-error {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 4px;
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

        .dynamic-item {
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            background: var(--surface);
        }

        .btn-add-dynamic {
            padding: 9px 15px;
            border: none;
            border-radius: 8px;
            background: var(--brand);
            color: var(--oncta);
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: filter 0.2s;
            font-family: inherit;
        }

        .btn-add-dynamic:hover {
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

        /* تنظیمات Jodit */
        .jodit-container {
            border-radius: 8px !important;
            border: 1px solid var(--line) !important;
            overflow: hidden;
        }

        .jodit-workplace {
            background: var(--surface) !important;
            color: var(--text) !important;
        }

        /* ===== ریسپانسیو ===== */
        @media (max-width: 768px) {
            .service-form-card {
                padding: 15px;
            }

            .form-grid-2,
            .form-grid-3 {
                grid-template-columns: 1fr;
            }

            .dynamic-item .form-grid-2,
            .dynamic-item .form-grid-3 {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div style="padding:20px;">
        <div class="service-form-card">
            <div class="service-form-header">
                <h5 class="service-form-title">
                    <i class="fa-solid fa-pen-to-square"></i> ویرایش خدمت
                </h5>
            </div>

            @if($errors->any())
                <div style="background:#dc3545; color:#fff; padding:12px; border-radius:8px; margin-bottom:20px;">
                    <ul style="margin:0; padding-right:20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pages.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- اطلاعات اصلی خدمت --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-layer-group"></i> اطلاعات اصلی خدمت
                </h6>

                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">عنوان خدمت</label>
                        <input type="text" name="title" value="{{ old('title', $service->title) }}" required
                            class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">شماره / اولویت</label>
                        <input type="number" name="number" value="{{ old('number', $service->number) }}" class="form-input">
                    </div>
                </div>

                <div class="form-group" style="margin-top:15px;">
                    <label class="form-label">متن کوتاه</label>
                    <textarea name="text" rows="4" class="form-textarea">{{ old('text', $service->text) }}</textarea>
                </div>

                <div class="form-group" style="margin-top:15px;">
                    <label class="form-label">توضیحات</label>
                    <textarea name="description" rows="5"
                        class="form-textarea">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="form-grid form-grid-3" style="margin-top:15px;">
                    <div class="form-group">
                        <label class="form-label">زمان تحویل</label>
                        <input type="text" name="delivery_time" value="{{ old('delivery_time', $service->delivery_time) }}"
                            class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">قیمت</label>
                        <input type="text" name="price_text" value="{{ old('price_text', $service->price_text) }}"
                            class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">پشتیبانی</label>
                        <input type="text" name="support" value="{{ old('support', $service->support) }}"
                            class="form-input">
                    </div>
                </div>

                <div class="form-grid form-grid-2" style="margin-top:15px;">
                    <div class="form-group">
                        <label class="form-label">مناسب برای</label>
                        <input type="text" name="suitable_for" value="{{ old('suitable_for', $service->suitable_for) }}"
                            class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label">قرارداد</label>
                        <input type="text" name="contract" value="{{ old('contract', $service->contract) }}"
                            class="form-input">
                    </div>
                </div>

                {{-- تصویر و آیکون --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-image"></i> آیکون یا تصویر
                </h6>

                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label class="form-label">آپلود تصویر جدید</label>
                        <input type="file" name="image" id="imageInput"
                            accept="image/jpeg,image/png,image/jpg,image/webp,image/svg+xml" class="form-file">
                        @if($service->image_url)
                            <div style="margin-top:10px;">
                                <img src="{{ asset('storage/' . $service->image_url) }}" alt="{{ $service->title }}"
                                    style="width:100px; height:100px; object-fit:cover; border-radius:8px; border:1px solid var(--line);">
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label">اسم آیکون Font Awesome</label>
                        <input type="text" name="icon" id="iconInput" value="{{ old('icon', $service->icon) }}"
                            placeholder="fa-brain" class="form-input">
                        <small style="color:var(--text-dim);">مثال: fa-brain</small>
                    </div>
                </div>

                {{-- معرفی کامل خدمت --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-circle-info"></i> معرفی کامل خدمت
                </h6>

                <div class="form-group" style="margin-bottom:20px;">
                    <label class="form-label">معرفی خدمت</label>
                    <textarea name="overview" id="overviewEditor"
                        rows="10">{{ old('overview', $service->overview) }}</textarea>
                </div>
                {{-- چالش --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-triangle-exclamation"></i> چالش
                </h6>

                <div class="form-group" style="margin-bottom:10px;">
                    <input
                        type="text"
                        name="challenge_title"
                        value="{{ old('challenge_title', $service->challenge_title) }}"
                        placeholder="عنوان چالش"
                        class="form-input"
                    >
                </div>

                <div class="form-group" style="margin-bottom:20px;">
                    <label class="form-label">متن چالش</label>

                    <textarea
                        name="challenge_text"
                        id="challengeEditor"
                        rows="10"
                    >{{ old('challenge_text', $service->challenge_text) }}</textarea>
                </div>


                {{-- راهکار --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-lightbulb"></i> راهکار
                </h6>

                <div class="form-group" style="margin-bottom:10px;">
                    <input
                        type="text"
                        name="solution_title"
                        value="{{ old('solution_title', $service->solution_title) }}"
                        placeholder="عنوان راهکار"
                        class="form-input"
                    >
                </div>

                <div class="form-group" style="margin-bottom:20px;">
                    <label class="form-label">متن راهکار</label>

                    <textarea
                        name="solution_text"
                        id="solutionEditor"
                        rows="10"
                    >{{ old('solution_text', $service->solution_text) }}</textarea>
                </div>

                {{-- نظر مشتری --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-quote-right"></i> نظر مشتری
                </h6>

                <div class="form-group" style="margin-bottom:10px;">
                    <textarea name="quote_text" rows="4" placeholder="متن نظر"
                        class="form-textarea">{{ old('quote_text', $service->quote_text) }}</textarea>
                </div>

                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <input type="text" name="quote_person" value="{{ old('quote_person', $service->quote_person) }}"
                            placeholder="نام شخص" class="form-input">
                    </div>
                    <div class="form-group">
                        <input type="text" name="quote_role" value="{{ old('quote_role', $service->quote_role) }}"
                            placeholder="سمت / نقش" class="form-input">
                    </div>
                </div>

                {{-- CTA --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-bullhorn"></i> CTA
                </h6>

                <div class="form-group" style="margin-bottom:10px;">
                    <input type="text" name="cta_title" value="{{ old('cta_title', $service->cta_title) }}"
                        placeholder="عنوان CTA" class="form-input">
                </div>
                <div class="form-group">
                    <textarea name="cta_text" rows="4" placeholder="متن CTA"
                        class="form-textarea">{{ old('cta_text', $service->cta_text) }}</textarea>
                </div>

                {{-- اطلاعات آماری --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-chart-simple"></i> اطلاعات آماری
                </h6>

                <div class="form-grid form-grid-2">
                    @for($i = 1; $i <= 4; $i++)
                        <div class="dynamic-item">
                            <strong>مورد {{ $i }}</strong>
                            <input type="text" name="state_text_{{ $i }}"
                                value="{{ old('state_text_' . $i, $state->{'text_' . $i} ?? '') }}" placeholder="عنوان"
                                class="form-input" style="margin-top:10px;">
                            <input type="text" name="state_value_{{ $i }}"
                                value="{{ old('state_value_' . $i, $state->{'value_' . $i} ?? '') }}" placeholder="مقدار"
                                class="form-input" style="margin-top:10px;">
                        </div>
                    @endfor
                </div>

                {{-- چه چیزی دریافت می‌کنید --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-box-open"></i> چه چیزی دریافت می‌کنید
                </h6>

                <div id="whatReceiveContainer">
                    @forelse($whatReceives as $index => $item)
                        <div class="dynamic-item">
                            <div class="form-grid form-grid-3">
                                <input type="text" name="what_receive[{{ $index }}][title]"
                                    value="{{ old('what_receive.' . $index . '.title', $item->title) }}" placeholder="عنوان"
                                    class="form-input">
                                <input type="text" name="what_receive[{{ $index }}][icon]"
                                    value="{{ old('what_receive.' . $index . '.icon', $item->icon) }}" placeholder="fa-comments"
                                    class="form-input">
                                <input type="number" name="what_receive[{{ $index }}][number]"
                                    value="{{ old('what_receive.' . $index . '.number', $item->number) }}" placeholder="اولویت"
                                    class="form-input">
                            </div>
                            <textarea name="what_receive[{{ $index }}][text]" rows="3" placeholder="توضیحات"
                                class="form-textarea"
                                style="margin-top:10px;">{{ old('what_receive.' . $index . '.text', $item->text) }}</textarea>
                        </div>
                    @empty
                        <div class="dynamic-item">
                            <div class="form-grid form-grid-3">
                                <input type="text" name="what_receive[0][title]" placeholder="عنوان" class="form-input">
                                <input type="text" name="what_receive[0][icon]" placeholder="fa-comments" class="form-input">
                                <input type="number" name="what_receive[0][number]" value="0" placeholder="اولویت"
                                    class="form-input">
                            </div>
                            <textarea name="what_receive[0][text]" rows="3" placeholder="توضیحات" class="form-textarea"
                                style="margin-top:10px;"></textarea>
                        </div>
                    @endforelse
                </div>

                <button type="button" id="addWhatReceive" class="btn-add-dynamic" style="margin-bottom:25px;">
                    <i class="fa-solid fa-plus"></i> افزودن مورد
                </button>

                {{-- ابزارها و تکنولوژی‌ها --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-toolbox"></i> ابزارها و تکنولوژی‌ها
                </h6>

                <div id="techContainer">
                    @forelse($techs as $index => $tech)
                        <div class="dynamic-item">
                            <div class="form-grid form-grid-3">
                                <input type="text" name="techs[{{ $index }}][text]"
                                    value="{{ old('techs.' . $index . '.text', $tech->text) }}" placeholder="مثلاً Laravel"
                                    class="form-input">
                                <input type="text" name="techs[{{ $index }}][icon]"
                                    value="{{ old('techs.' . $index . '.icon', $tech->icon) }}" placeholder="fa-code"
                                    class="form-input">
                                <input type="number" name="techs[{{ $index }}][number]"
                                    value="{{ old('techs.' . $index . '.number', $tech->number) }}" placeholder="اولویت"
                                    class="form-input">
                            </div>
                        </div>
                    @empty
                        <div class="dynamic-item">
                            <div class="form-grid form-grid-3">
                                <input type="text" name="techs[0][text]" placeholder="مثلاً Laravel" class="form-input">
                                <input type="text" name="techs[0][icon]" placeholder="fa-code" class="form-input">
                                <input type="number" name="techs[0][number]" value="0" placeholder="اولویت" class="form-input">
                            </div>
                        </div>
                    @endforelse
                </div>

                <button type="button" id="addTech" class="btn-add-dynamic" style="margin-bottom:25px;">
                    <i class="fa-solid fa-plus"></i> افزودن تکنولوژی
                </button>

                {{-- slug --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-link"></i> slug
                </h6>
                <div class="form-group" style="margin-bottom:10px;">
                    <input type="text" name="slug" value="{{ old('slug', $service->slug) }}" class="form-input">
                </div>

                {{-- meta tag --}}
                <h6 class="form-section-title">
                    <i class="fa-solid fa-tags"></i> meta tag
                </h6>
                <div class="form-group" style="margin-bottom:10px;">
                    <input type="text" name="meta" value="{{ old('meta', $service->meta) }}" class="form-input">
                </div>

                {{-- دکمه‌ها --}}
                <div style="margin-top:25px; display:flex; gap:10px; flex-wrap:wrap;">
                    <button type="submit" class="btn-submit-form">
                        <i class="fa-solid fa-save"></i> بروزرسانی
                    </button>
                    <a href="{{ route('pages.index') }}" class="btn-back-form">
                        بازگشت
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            function createEditor(selector) {

                return new Jodit(selector, {
                    width: '100%',
                    height: 300,

                    allowResize: true,
                    allowResizeImages: true,

                    direction: 'rtl',

                    buttons: [
                        'source', '|',

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

                        {
                            name: 'uploadImage',

                            iconURL: 'https://cdn-icons-png.flaticon.com/512/1829/1829586.png',

                            tooltip: 'آپلود تصویر',

                            exec: (editor) => {

                                let input =
                                    document.createElement('input');

                                input.type = 'file';
                                input.accept = 'image/*';

                                input.onchange = () => {

                                    let file = input.files[0];

                                    if (!file) {
                                        return;
                                    }

                                    let formData = new FormData();

                                    formData.append('file', file);

                                    fetch(
                                        '{{ route('upload.image') }}',
                                        {
                                            method: 'POST',

                                            headers: {
                                                'X-CSRF-TOKEN':
                                                    '{{ csrf_token() }}'
                                            },

                                            body: formData
                                        }
                                    )
                                    .then(res => res.json())
                                    .then(data => {

                                        if (
                                            data.files &&
                                            data.files[0] &&
                                            data.files[0].url
                                        ) {

                                            let img =
                                                document.createElement('img');

                                            img.src =
                                                data.files[0].url;

                                            img.style.maxWidth = '100%';

                                            editor.s.insertNode(img);

                                        } else {

                                            alert(
                                                'خطا در آپلود تصویر'
                                            );
                                        }
                                    })
                                    .catch(err => {

                                        console.error(err);

                                        alert(
                                            'خطا در آپلود تصویر'
                                        );
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

                                let input =
                                    document.createElement('input');

                                input.type = 'file';
                                input.accept = 'video/*';

                                input.onchange = () => {

                                    let file = input.files[0];

                                    if (!file) {
                                        return;
                                    }

                                    let formData = new FormData();

                                    formData.append('file', file);

                                    fetch(
                                        '{{ route('upload.video') }}',
                                        {
                                            method: 'POST',

                                            headers: {
                                                'X-CSRF-TOKEN':
                                                    '{{ csrf_token() }}'
                                            },

                                            body: formData
                                        }
                                    )
                                    .then(res => res.json())
                                    .then(data => {

                                        if (
                                            data.files &&
                                            data.files[0] &&
                                            data.files[0].url
                                        ) {

                                            let wrapper =
                                                document.createElement('div');

                                            wrapper.classList.add(
                                                'video-wrapper'
                                            );

                                            let video =
                                                document.createElement('video');

                                            video.setAttribute(
                                                'controls',
                                                ''
                                            );

                                            video.style.maxWidth = '100%';
                                            video.style.width = '100%';

                                            video.src =
                                                data.files[0].url;

                                            wrapper.appendChild(video);

                                            editor.s.insertNode(wrapper);

                                        } else {

                                            alert(
                                                'خطا در آپلود ویدیو'
                                            );
                                        }
                                    })
                                    .catch(err => {

                                        console.error(err);

                                        alert(
                                            'خطا در آپلود ویدیو'
                                        );
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

                    defaultFont:
                        'Vazir, Tahoma, Arial, sans-serif',

                    defaultFontSize:
                        '14px',

                    fonts: [
                        'Vazir',
                        'Tahoma',
                        'Arial',
                        'Courier New'
                    ]
                });
            }


            /*
            |--------------------------------------------------------------------------
            | Editors
            |--------------------------------------------------------------------------
            */

            createEditor('#overviewEditor');

            createEditor('#challengeEditor');

            createEditor('#solutionEditor');


            /*
            |--------------------------------------------------------------------------
            | Image / Icon
            |--------------------------------------------------------------------------
            */

            const imageInput =
                document.getElementById('imageInput');

            const iconInput =
                document.getElementById('iconInput');


            if (imageInput && iconInput) {

                function checkImageIcon() {

                    if (imageInput.files.length > 0) {

                        iconInput.disabled = true;

                    } else {

                        iconInput.disabled = false;
                    }
                }


                imageInput.addEventListener(
                    'change',
                    function () {

                        if (imageInput.files.length > 0) {

                            iconInput.disabled = true;

                            iconInput.value = '';

                        } else {

                            iconInput.disabled = false;
                        }
                    }
                );


                iconInput.addEventListener(
                    'input',
                    function () {

                        if (
                            iconInput.value.trim() !== ''
                        ) {

                            imageInput.disabled = true;

                        } else {

                            imageInput.disabled = false;
                        }
                    }
                );


                checkImageIcon();
            }


            /*
            |--------------------------------------------------------------------------
            | What Receive
            |--------------------------------------------------------------------------
            */

            let whatReceiveIndex =
                document.querySelectorAll(
                    '#whatReceiveContainer .dynamic-item'
                ).length;


            const addWhatReceive =
                document.getElementById(
                    'addWhatReceive'
                );


            if (addWhatReceive) {

                addWhatReceive.addEventListener(
                    'click',
                    function () {

                        const container =
                            document.getElementById(
                                'whatReceiveContainer'
                            );

                        const item =
                            document.createElement('div');

                        item.className =
                            'dynamic-item';


                        item.innerHTML = `

                            <div class="form-grid form-grid-3">

                                <input
                                    type="text"
                                    name="what_receive[${whatReceiveIndex}][title]"
                                    placeholder="عنوان"
                                    class="form-input"
                                >

                                <input
                                    type="text"
                                    name="what_receive[${whatReceiveIndex}][icon]"
                                    placeholder="fa-comments"
                                    class="form-input"
                                >

                                <input
                                    type="number"
                                    name="what_receive[${whatReceiveIndex}][number]"
                                    value="${whatReceiveIndex}"
                                    placeholder="اولویت"
                                    class="form-input"
                                >

                            </div>

                            <textarea
                                name="what_receive[${whatReceiveIndex}][text]"
                                rows="3"
                                placeholder="توضیحات"
                                class="form-textarea"
                                style="margin-top:10px;"
                            ></textarea>

                        `;


                        container.appendChild(item);

                        whatReceiveIndex++;
                    }
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Technologies
            |--------------------------------------------------------------------------
            */

            let techIndex =
                document.querySelectorAll(
                    '#techContainer .dynamic-item'
                ).length;


            const addTech =
                document.getElementById('addTech');


            if (addTech) {

                addTech.addEventListener(
                    'click',
                    function () {

                        const container =
                            document.getElementById(
                                'techContainer'
                            );

                        const item =
                            document.createElement('div');

                        item.className =
                            'dynamic-item';


                        item.innerHTML = `

                            <div class="form-grid form-grid-3">

                                <input
                                    type="text"
                                    name="techs[${techIndex}][text]"
                                    placeholder="مثلاً Laravel"
                                    class="form-input"
                                >

                                <input
                                    type="text"
                                    name="techs[${techIndex}][icon]"
                                    placeholder="fa-code"
                                    class="form-input"
                                >

                                <input
                                    type="number"
                                    name="techs[${techIndex}][number]"
                                    value="${techIndex}"
                                    placeholder="اولویت"
                                    class="form-input"
                                >

                            </div>

                        `;


                        container.appendChild(item);

                        techIndex++;
                    }
                );
            }

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Jodit Editor
            const editor = new Jodit('#overviewEditor', {
                width: '100%',
                height: 300,
                allowResize: true,
                allowResizeImages: true,
                buttons: [
                    'source', '|',
                    'undo', 'redo', '|',
                    'cut', 'copy', 'paste', 'selectall', 'removeformat', '|',
                    'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                    'font', 'fontsize', 'brush', 'paragraph', '|',
                    'ul', 'ol', 'outdent', 'indent', '|',
                    'align', 'hr', 'table', '|',
                    'link', 'unlink',
                    {
                        name: 'uploadImage',
                        iconURL: 'https://cdn-icons-png.flaticon.com/512/1829/1829586.png',
                        tooltip: 'آپلود تصویر',
                        exec: (editor) => {
                            let input = document.createElement('input');
                            input.type = 'file';
                            input.accept = 'image/*';
                            input.onchange = () => {
                                let file = input.files[0];
                                if (!file) return;
                                let formData = new FormData();
                                formData.append('file', file);
                                fetch('{{ route('upload.image') }}', {
                                    method: 'POST',
                                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: formData
                                })
                                    .then(res => res.json())
                                    .then(data => {
                                        if (data.files && data.files[0] && data.files[0].url) {
                                            let img = document.createElement('img');
                                            img.src = data.files[0].url;
                                            editor.s.insertNode(img);
                                        } else {
                                            alert('خطا در آپلود تصویر');
                                        }
                                    })
                                    .catch(err => alert('Upload error: ' + err));
                            };
                            input.click();
                        }
                    },
                    {
                        name: 'uploadVideo',
                        iconURL: 'https://cdn-icons-png.flaticon.com/512/727/727245.png',
                        tooltip: 'آپلود ویدیو',
                        exec: (editor) => {
                            let input = document.createElement('input');
                            input.type = 'file';
                            input.accept = 'video/*';
                            input.onchange = () => {
                                let file = input.files[0];
                                if (!file) return;
                                let formData = new FormData();
                                formData.append('file', file);
                                fetch('{{ route('upload.video') }}', {
                                    method: 'POST',
                                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: formData
                                })
                                    .then(res => res.json())
                                    .then(data => {
                                        if (data.files && data.files[0] && data.files[0].url) {
                                            let wrapper = document.createElement('div');
                                            wrapper.classList.add('video-wrapper');
                                            let video = document.createElement('video');
                                            video.setAttribute('controls', '');
                                            video.style.maxWidth = '100%';
                                            video.src = data.files[0].url;
                                            wrapper.appendChild(video);
                                            editor.s.insertNode(wrapper);
                                        } else {
                                            alert('خطا در آپلود ویدیو');
                                        }
                                    })
                                    .catch(err => alert('Upload error: ' + err));
                            };
                            input.click();
                        }
                    },
                    '|',
                    'symbols', 'emoticons', 'specialCharacters', '|',
                    'print', 'fullsize', 'preview', '|',
                    'about'
                ],
                colors: {
                    text: ['#000000', '#ff0000', '#00ff00', '#0000ff', '#ff00ff', '#00ffff'],
                    background: ['#ffffff', '#ffff00', '#00ffff', '#ffcc99']
                },
                defaultFont: 'Vazir, Tahoma, Arial, sans-serif',
                defaultFontSize: '14px',
                fonts: ['Vazir', 'Tahoma', 'Arial', 'Courier New']
            });

            // Image / Icon mutual exclusion
            const imageInput = document.getElementById('imageInput');
            const iconInput = document.getElementById('iconInput');

            function checkImageIcon() {
                if (imageInput.files.length > 0) {
                    iconInput.disabled = true;
                } else {
                    iconInput.disabled = false;
                }
            }

            imageInput.addEventListener('change', function () {
                if (imageInput.files.length > 0) {
                    iconInput.disabled = true;
                    iconInput.value = '';
                } else {
                    iconInput.disabled = false;
                }
            });

            iconInput.addEventListener('input', function () {
                if (iconInput.value.trim() !== '') {
                    imageInput.disabled = true;
                } else {
                    imageInput.disabled = false;
                }
            });

            checkImageIcon();

            // Dynamic What Receive
            let whatReceiveIndex = document.querySelectorAll('.what-receive-item').length;
            document.getElementById('addWhatReceive').addEventListener('click', function () {
                const container = document.getElementById('whatReceiveContainer');
                const item = document.createElement('div');
                item.className = 'dynamic-item';
                item.innerHTML = `
                        <div class="form-grid form-grid-3">
                            <input type="text" name="what_receive[${whatReceiveIndex}][title]" placeholder="عنوان" class="form-input">
                            <input type="text" name="what_receive[${whatReceiveIndex}][icon]" placeholder="fa-comments" class="form-input">
                            <input type="number" name="what_receive[${whatReceiveIndex}][number]" value="${whatReceiveIndex}" placeholder="اولویت" class="form-input">
                        </div>
                        <textarea name="what_receive[${whatReceiveIndex}][text]" rows="3" placeholder="توضیحات" class="form-textarea" style="margin-top:10px;"></textarea>
                    `;
                container.appendChild(item);
                whatReceiveIndex++;
            });

            // Dynamic Technologies
            let techIndex = document.querySelectorAll('.tech-item').length;
            document.getElementById('addTech').addEventListener('click', function () {
                const container = document.getElementById('techContainer');
                const item = document.createElement('div');
                item.className = 'dynamic-item';
                item.innerHTML = `
                        <div class="form-grid form-grid-3">
                            <input type="text" name="techs[${techIndex}][text]" placeholder="مثلاً Laravel" class="form-input">
                            <input type="text" name="techs[${techIndex}][icon]" placeholder="fa-code" class="form-input">
                            <input type="number" name="techs[${techIndex}][number]" value="${techIndex}" placeholder="اولویت" class="form-input">
                        </div>
                    `;
                container.appendChild(item);
                techIndex++;
            });
        });
    </script>
@endsection