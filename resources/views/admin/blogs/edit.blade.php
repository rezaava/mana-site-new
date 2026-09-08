@extends('admin.panel')

@section('content')
    <style>
        /* استایل‌های فرم مقالات */
        .blog-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }
        .blog-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }
        .blog-form-title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text);
        }
        .blog-form-back {
            color: var(--text-dim);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            transition: color 0.2s;
        }
        .blog-form-back:hover {
            color: var(--text);
        }
        .blog-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .blog-form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .blog-form-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dim);
        }
        .blog-form-input,
        .blog-form-select {
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
        .blog-form-select option {
            color: var(--oncta);
        }
        .blog-form-file,
        .blog-form-input-tag {
            width: 40%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: transparent;
            color: var(--text);
            transition: all 0.3s var(--ease);
            font-family: inherit;
            font-size: 0.9rem;
        }
        .blog-form-input:focus,
        .blog-form-select:focus,
        .blog-form-file:focus {
            outline: none;
            border-color: var(--brand);
            box-shadow: 0 0 0 3px color-mix(in srgb, var(--brand) 20%, transparent);
            background: var(--card-hover);
        }
        .blog-form-input::placeholder {
            color: var(--text-dimmer);
        }
        .blog-form-error {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 4px;
        }
        .blog-form-file {
            padding: 8px;
            cursor: pointer;
        }
        .blog-form-file::-webkit-file-upload-button {
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
        .blog-form-file::-webkit-file-upload-button:hover {
            filter: brightness(1.1);
        }
        .blog-tags-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .blog-tag-row {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .blog-tag-row .blog-form-input,
        .blog-tag-row {
            flex: 1;
            min-width: 0;
        }
        .blog-tag-remove {
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            background: #ef4444;
            color: #fff;
            cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .blog-tag-remove:hover {
            background: #dc2626;
        }
        .blog-tag-add {
            width: 8%;
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
            margin-top: 10px;
        }
        .blog-tag-add:hover {
            filter: brightness(1.1);
        }
        .blog-editor-wrapper {
            margin-bottom: 20px;
        }
        .blog-editor-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dim);
        }
        .blog-submit-btn {
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
        }
        .blog-submit-btn:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
        }
        .blog-alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .blog-alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
        }
        .blog-alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid #ef4444;
            color: #ef4444;
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

        /* ریسپانسیو */
        @media (max-width: 768px) {
            .blog-form-card { padding: 15px; }
            .blog-form-grid { grid-template-columns: 1fr; gap: 15px; }
            .blog-form-input,
            .blog-form-select,
            .blog-form-file,
            .blog-form-input-tag { width: 100%; }
            .blog-tag-add { width: 100%; justify-content: center; }
            .blog-submit-btn { width: 100%; justify-content: center; }
        }
        @media (max-width: 480px) {
            .blog-form-header { flex-direction: column; align-items: flex-start; }
            .blog-form-back { margin-top: 10px; }
            .blog-form-file { padding: 6px; }
            .blog-form-file::-webkit-file-upload-button { padding: 5px 10px; }
            .blog-tag-remove { padding: 8px 12px; }
        }
    </style>

    <div style="padding: 20px;">
        @if (session('success'))
            <div class="blog-alert blog-alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="blog-alert blog-alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="blog-alert blog-alert-error">
                <ul style="margin: 0; padding-right: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="blog-form-card">
            <div class="blog-form-header">
                <h5 class="blog-form-title">
                    <i class="fa-solid fa-pen-to-square"></i> ویرایش مقاله
                </h5>
                <a href="{{ route('blogs.index') }}" class="blog-form-back">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت
                </a>
            </div>

            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="blog-form-grid">
                    <div class="blog-form-group">
                        <label class="blog-form-label">عنوان مقاله</label>
                        <input type="text" name="title" value="{{ old('title', $blog->title) }}" required
                               class="blog-form-input" placeholder="عنوان را وارد کنید">
                        @error('title')
                            <small class="blog-form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="blog-form-group">
                        <label class="blog-form-label">دسته‌بندی</label>
                        <select name="cat_id" required class="blog-form-select">
                            <option value="">انتخاب دسته‌بندی</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('cat_id', $blog->cat_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('cat_id')
                            <small class="blog-form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="blog-form-group">
                        <label class="blog-form-label">زمان مطالعه (دقیقه)</label>
                        <input type="number" name="reading-time"
                               value="{{ old('reading-time', $blog->{'reading-time'}) }}"
                               class="blog-form-input" placeholder="مثلاً 5">
                        @error('reading-time')
                            <small class="blog-form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="blog-form-group">
                        <label class="blog-form-label">شماره / اولویت</label>
                        <input type="number" name="number" value="{{ old('number', $blog->number) }}"
                               class="blog-form-input" placeholder="اختیاری">
                        @error('number')
                            <small class="blog-form-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="blog-form-group">
                        <label class="blog-form-label">افزودن slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $blog->slug) }}"
                               class="blog-form-input" placeholder="مثلاً my-article">
                        @error('slug')
                            <small class="blog-form-error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="blog-form-group" style="margin-bottom: 20px;">
                    <label class="blog-form-label">تصویر شاخص جدید (اختیاری)</label>
                    <input type="file" name="image" class="blog-form-file">
                    <div style="margin-top: 10px;">
                        @if($blog->image_url)
                            <small style="color: var(--text-dimmer); display: block; margin-bottom: 5px;">تصویر فعلی:</small>
                            <img src="{{ asset('storage/' . $blog->image_url) }}" alt="{{ $blog->title }}"
                                 style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid var(--line);">
                        @else
                            <small style="color: var(--text-dimmer); display: block;">تصویری برای این مقاله ثبت نشده است.</small>
                        @endif
                    </div>
                    @error('image')
                        <small class="blog-form-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="blog-form-group" style="margin-bottom: 20px;">
                    <label class="blog-form-label">تگ‌های مقاله</label>
                    <div class="blog-tags-container" id="tags-container">
                        @if(old('tags'))
                            @foreach(old('tags') as $tag)
                                <div class="blog-tag-row">
                                    <input type="text" name="tags[]" value="{{ $tag }}"
                                           placeholder="مثلاً Laravel" class="blog-form-input-tag">
                                    <button type="button" onclick="removeTag(this)" class="blog-tag-remove">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @elseif($blogTags->count())
                            @foreach($blogTags as $tag)
                                <div class="blog-tag-row">
                                    <input type="text" name="tags[]" value="{{ $tag->text }}"
                                           placeholder="مثلاً Laravel" class="blog-form-input-tag">
                                    <button type="button" onclick="removeTag(this)" class="blog-tag-remove">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="blog-tag-row">
                                <input type="text" name="tags[]" placeholder="مثلاً Laravel" class="blog-form-input-tag">
                                <button type="button" onclick="removeTag(this)" class="blog-tag-remove">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" onclick="addTag()" class="blog-tag-add">
                        <i class="fa-solid fa-plus"></i> افزودن تگ
                    </button>
                    @error('tags.*')
                        <small class="blog-form-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="blog-editor-wrapper">
                    <label class="blog-editor-label">متن مقاله</label>
                    <textarea class="form-control" id="editor" style="color: black;"
                              name="text">{{ old('text', $blog->text) }}</textarea>
                    @error('text')
                        <small class="blog-form-error">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="blog-submit-btn">
                    <i class="fa-solid fa-save"></i> بروزرسانی مقاله
                </button>
            </form>
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
                <button type="button" onclick="removeTag(this)" class="blog-tag-remove">
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

        const editor = new Jodit('#editor', {
            width: '100%',
            height: 200,
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
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.files && data.files[0].url) {
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
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.files && data.files[0].url) {
                                        let wrapper = document.createElement('div');
                                        wrapper.classList.add('video-wrapper');
                                        let video = document.createElement('video');
                                        video.setAttribute('controls', '');
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
                text: ['#000000', '#ff0000', '#00ff00', '#0000ff', '#ff00ff', '#00ffff'],
                background: ['#ffffff', '#ffff00', '#00ffff', '#ffcc99']
            },
            defaultFont: 'Vazir, Tahoma, Arial, sans-serif',
            defaultFontSize: '14px',
            fonts: ['Vazir', 'Tahoma', 'Arial', 'Courier New']
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.css">
@endsection