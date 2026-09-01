@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    {{-- Alerts Section --}}
    @if (session('success'))
        <div style="background: #10b981; color: #fff; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px;">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background: #ef4444; color: #fff; padding: 12px 15px; border-radius: 8px; margin-bottom: 20px;">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif

    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-plus-circle"></i> افزودن مقاله جدید
            </h5>
            <a href="{{ route('blogs.index') }}" style="color: var(--text-light); text-decoration: none;">
                <i class="fa-solid fa-arrow-right"></i> بازگشت
            </a>
        </div>

        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 8px;">عنوان مقاله</label>
                    <input type="text" name="title" value="{{ old('title') }}" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('title')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">زمان مطالعه (دقیقه)</label>
                    <input type="number" name="reading-time" value="{{ old('reading-time') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('reading-time')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label style="display: block; margin-bottom: 8px;">شماره / اولویت</label>
                    <input type="number" name="number" value="{{ old('number') }}" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                    @error('number')
                        <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px;">تصویر شاخص</label>
                <input type="file" name="image" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid var(--border); background: transparent; color: inherit;">
                @error('image')
                    <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="description" class="col-sm-3 text-end control-label col-form-label">توضیحات</label>                             
                <textarea class="form-control" id="editor" style="color: black;" name="text"></textarea>
                @error('text')
                    <small style="color: #ef4444; display: block; margin-top: 4px;">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer;">
                <i class="fa-solid fa-check"></i> ذخیره مقاله
            </button>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.js"></script>
<script>
        const editor = new Jodit('#editor', {
            width: 1400,
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
                '|', 'symbols', 'emoticons', 'specialCharacters', '|',
                'print', 'fullsize', 'preview', '|', 'about'
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