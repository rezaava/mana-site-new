@extends('admin.panel')

@section('content')

<div style="padding:20px;">

    <div style="
        background:var(--card-bg);
        border-radius:12px;
        padding:20px;
    ">

        <h5 style="margin-bottom:25px;">
            <i class="fa-solid fa-plus-circle"></i>
            افزودن خدمت جدید
        </h5>


        @if($errors->any())

            <div
                style="
                    background:#dc3545;
                    color:#fff;
                    padding:12px;
                    border-radius:8px;
                    margin-bottom:20px;
                "
            >

                <ul style="margin:0;padding-right:20px;">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('pages.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- ========================================================= --}}
            {{-- SERVICE --}}
            {{-- ========================================================= --}}

            <h6 style="
                margin:25px 0 15px;
                color:var(--accent);
            ">
                <i class="fa-solid fa-layer-group"></i>
                اطلاعات اصلی خدمت
            </h6>


            <div style="
                display:grid;
                grid-template-columns:1fr 1fr;
                gap:15px;
            ">

                <div>

                    <label style="display:block;margin-bottom:8px;">
                        عنوان خدمت
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        style="
                            width:100%;
                            padding:10px;
                            border-radius:8px;
                            border:1px solid var(--border);
                            background:transparent;
                            color:inherit;
                        "
                    >

                </div>


                <div>

                    <label style="display:block;margin-bottom:8px;">
                        شماره / اولویت
                    </label>

                    <input
                        type="number"
                        name="number"
                        value="{{ old('number', 0) }}"
                        style="
                            width:100%;
                            padding:10px;
                            border-radius:8px;
                            border:1px solid var(--border);
                            background:transparent;
                            color:inherit;
                        "
                    >

                </div>

            </div>


            {{-- TEXT --}}

            <div style="margin-top:15px;">

                <label style="display:block;margin-bottom:8px;">
                    متن کوتاه
                </label>

                <textarea
                    name="text"
                    rows="4"
                    style="
                        width:100%;
                        padding:10px;
                        border-radius:8px;
                        border:1px solid var(--border);
                        background:transparent;
                        color:inherit;
                    "
                >{{ old('text') }}</textarea>

            </div>


            {{-- DESCRIPTION --}}

            <div style="margin-top:15px;">

                <label style="display:block;margin-bottom:8px;">
                    توضیحات
                </label>

                <textarea
                    name="description"
                    rows="5"
                    style="
                        width:100%;
                        padding:10px;
                        border-radius:8px;
                        border:1px solid var(--border);
                        background:transparent;
                        color:inherit;
                    "
                >{{ old('description') }}</textarea>

            </div>


            {{-- DELIVERY / PRICE / SUPPORT --}}

            <div style="
                display:grid;
                grid-template-columns:1fr 1fr 1fr;
                gap:15px;
                margin-top:15px;
            ">

                <div>

                    <label style="display:block;margin-bottom:8px;">
                        زمان تحویل
                    </label>

                    <input
                        type="text"
                        name="delivery_time"
                        value="{{ old('delivery_time') }}"
                        placeholder="مثلاً ۳۰ روز"
                        style="
                            width:100%;
                            padding:10px;
                            border-radius:8px;
                            border:1px solid var(--border);
                            background:transparent;
                            color:inherit;
                        "
                    >

                </div>


                <div>

                    <label style="display:block;margin-bottom:8px;">
                        متن قیمت
                    </label>

                    <input
                        type="text"
                        name="price_text"
                        value="{{ old('price_text') }}"
                        placeholder="مثلاً از ۲۰ میلیون تومان"
                        style="
                            width:100%;
                            padding:10px;
                            border-radius:8px;
                            border:1px solid var(--border);
                            background:transparent;
                            color:inherit;
                        "
                    >

                </div>


                <div>

                    <label style="display:block;margin-bottom:8px;">
                        پشتیبانی
                    </label>

                    <input
                        type="text"
                        name="support"
                        value="{{ old('support') }}"
                        placeholder="مثلاً ۶ ماه پشتیبانی"
                        style="
                            width:100%;
                            padding:10px;
                            border-radius:8px;
                            border:1px solid var(--border);
                            background:transparent;
                            color:inherit;
                        "
                    >

                </div>

            </div>


            {{-- SUITABLE / CONTRACT --}}

            <div style="
                display:grid;
                grid-template-columns:1fr 1fr;
                gap:15px;
                margin-top:15px;
            ">

                <div>

                    <label style="display:block;margin-bottom:8px;">
                        مناسب برای
                    </label>

                    <input
                        type="text"
                        name="suitable_for"
                        value="{{ old('suitable_for') }}"
                        placeholder="مثلاً کسب‌وکارهای کوچک"
                        style="
                            width:100%;
                            padding:10px;
                            border-radius:8px;
                            border:1px solid var(--border);
                            background:transparent;
                            color:inherit;
                        "
                    >

                </div>


                <div>

                    <label style="display:block;margin-bottom:8px;">
                        قرارداد
                    </label>

                    <input
                        type="text"
                        name="contract"
                        value="{{ old('contract') }}"
                        placeholder="مثلاً قرارداد رسمی"
                        style="
                            width:100%;
                            padding:10px;
                            border-radius:8px;
                            border:1px solid var(--border);
                            background:transparent;
                            color:inherit;
                        "
                    >

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- IMAGE / ICON --}}
            {{-- ========================================================= --}}

            <h6 style="
                margin:35px 0 15px;
                color:var(--accent);
            ">
                <i class="fa-solid fa-image"></i>
                تصویر و آیکون
            </h6>


            <div style="
                display:grid;
                grid-template-columns:1fr 1fr;
                gap:15px;
            ">

                <div>

                    <label style="
                        display:block;
                        margin-bottom:8px;
                    ">
                        آپلود تصویر
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="imageInput"
                        accept="image/jpeg,image/png,image/jpg,image/webp,image/svg+xml"
                        style="
                            width:100%;
                            padding:10px;
                            border-radius:8px;
                            border:1px solid var(--border);
                            background:transparent;
                            color:inherit;
                        "
                    >

                </div>


                <div>

                    <label style="
                        display:block;
                        margin-bottom:8px;
                    ">
                        اسم آیکون Font Awesome
                    </label>

                    <input
                        type="text"
                        name="icon"
                        id="iconInput"
                        value="{{ old('icon') }}"
                        placeholder="fa-brain"
                        style="
                            width:100%;
                            padding:10px;
                            border-radius:8px;
                            border:1px solid var(--border);
                            background:transparent;
                            color:inherit;
                        "
                    >

                    <small style="color:var(--text-light);">
                        مثال: fa-brain
                    </small>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- OVERVIEW --}}
            {{-- ========================================================= --}}

            <h6 style="
                margin:35px 0 15px;
                color:var(--accent);
            ">
                <i class="fa-solid fa-circle-info"></i>
                معرفی کامل خدمت
            </h6>


            <div style="margin-bottom:20px;">

                <label style="
                    display:block;
                    margin-bottom:8px;
                ">
                    معرفی خدمت
                </label>

                <textarea
                    name="overview"
                    id="overviewEditor"
                    rows="10"
                >{{ old('overview') }}</textarea>

            </div>


            {{-- ========================================================= --}}
            {{-- CHALLENGE --}}
            {{-- ========================================================= --}}

            <h6 style="
                margin:35px 0 15px;
                color:var(--accent);
            ">
                <i class="fa-solid fa-triangle-exclamation"></i>
                چالش
            </h6>


            <input
                type="text"
                name="challenge_title"
                value="{{ old('challenge_title') }}"
                placeholder="عنوان چالش"
                style="
                    width:100%;
                    padding:10px;
                    border-radius:8px;
                    border:1px solid var(--border);
                    background:transparent;
                    color:inherit;
                    margin-bottom:10px;
                "
            >


            <textarea
                name="challenge_text"
                rows="5"
                placeholder="متن چالش"
                style="
                    width:100%;
                    padding:10px;
                    border-radius:8px;
                    border:1px solid var(--border);
                    background:transparent;
                    color:inherit;
                "
            >{{ old('challenge_text') }}</textarea>


            {{-- ========================================================= --}}
            {{-- SOLUTION --}}
            {{-- ========================================================= --}}

            <h6 style="
                margin:35px 0 15px;
                color:var(--accent);
            ">
                <i class="fa-solid fa-lightbulb"></i>
                راهکار
            </h6>


            <input
                type="text"
                name="solution_title"
                value="{{ old('solution_title') }}"
                placeholder="عنوان راهکار"
                style="
                    width:100%;
                    padding:10px;
                    border-radius:8px;
                    border:1px solid var(--border);
                    background:transparent;
                    color:inherit;
                    margin-bottom:10px;
                "
            >


            <textarea
                name="solution_text"
                rows="5"
                placeholder="متن راهکار"
                style="
                    width:100%;
                    padding:10px;
                    border-radius:8px;
                    border:1px solid var(--border);
                    background:transparent;
                    color:inherit;
                "
            >{{ old('solution_text') }}</textarea>


            {{-- ========================================================= --}}
            {{-- QUOTE --}}
            {{-- ========================================================= --}}

            <h6 style="
                margin:35px 0 15px;
                color:var(--accent);
            ">
                <i class="fa-solid fa-quote-right"></i>
                نقل قول
            </h6>


            <textarea
                name="quote_text"
                rows="5"
                placeholder="متن نقل قول"
                style="
                    width:100%;
                    padding:10px;
                    border-radius:8px;
                    border:1px solid var(--border);
                    background:transparent;
                    color:inherit;
                "
            >{{ old('quote_text') }}</textarea>


            <div style="
                display:grid;
                grid-template-columns:1fr 1fr;
                gap:15px;
                margin-top:15px;
            ">

                <input
                    type="text"
                    name="quote_person"
                    value="{{ old('quote_person') }}"
                    placeholder="نام شخص"
                    style="
                        width:100%;
                        padding:10px;
                        border-radius:8px;
                        border:1px solid var(--border);
                        background:transparent;
                        color:inherit;
                    "
                >


                <input
                    type="text"
                    name="quote_role"
                    value="{{ old('quote_role') }}"
                    placeholder="سمت شخص"
                    style="
                        width:100%;
                        padding:10px;
                        border-radius:8px;
                        border:1px solid var(--border);
                        background:transparent;
                        color:inherit;
                    "
                >

            </div>


            {{-- ========================================================= --}}
            {{-- CTA --}}
            {{-- ========================================================= --}}

            <h6 style="
                margin:35px 0 15px;
                color:var(--accent);
            ">
                <i class="fa-solid fa-bullhorn"></i>
                CTA
            </h6>


            <input
                type="text"
                name="cta_title"
                value="{{ old('cta_title') }}"
                placeholder="عنوان CTA"
                style="
                    width:100%;
                    padding:10px;
                    border-radius:8px;
                    border:1px solid var(--border);
                    background:transparent;
                    color:inherit;
                    margin-bottom:10px;
                "
            >


            <textarea
                name="cta_text"
                rows="4"
                placeholder="متن CTA"
                style="
                    width:100%;
                    padding:10px;
                    border-radius:8px;
                    border:1px solid var(--border);
                    background:transparent;
                    color:inherit;
                "
            >{{ old('cta_text') }}</textarea>


            {{-- ========================================================= --}}
            {{-- STATE --}}
            {{-- ========================================================= --}}

            <h6 style="
                margin:35px 0 15px;
                color:var(--accent);
            ">
                <i class="fa-solid fa-chart-simple"></i>
                اطلاعات آماری
            </h6>


            <div style="
                display:grid;
                grid-template-columns:1fr 1fr;
                gap:15px;
            ">

                @for($i = 1; $i <= 4; $i++)

                    <div style="
                        padding:15px;
                        border:1px solid var(--border);
                        border-radius:10px;
                    ">

                        <strong>
                            مورد {{ $i }}
                        </strong>


                        <input
                            type="text"
                            name="state_text_{{ $i }}"
                            value="{{ old('state_text_'.$i) }}"
                            placeholder="عنوان"
                            style="
                                width:100%;
                                margin-top:10px;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >


                        <input
                            type="text"
                            name="state_value_{{ $i }}"
                            value="{{ old('state_value_'.$i) }}"
                            placeholder="مقدار"
                            style="
                                width:100%;
                                margin-top:10px;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >

                    </div>

                @endfor

            </div>


            {{-- ========================================================= --}}
            {{-- WHAT RECEIVE --}}
            {{-- ========================================================= --}}

            <h6 style="
                margin:35px 0 15px;
                color:var(--accent);
            ">
                <i class="fa-solid fa-box-open"></i>
                چه چیزی دریافت می‌کنید
            </h6>


            <div id="whatReceiveContainer">

                <div
                    class="what-receive-item"
                    style="
                        border:1px solid var(--border);
                        border-radius:10px;
                        padding:15px;
                        margin-bottom:15px;
                    "
                >

                    <div style="
                        display:grid;
                        grid-template-columns:2fr 1fr 1fr;
                        gap:15px;
                    ">

                        <input
                            type="text"
                            name="what_receive[0][title]"
                            placeholder="عنوان"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >


                        <input
                            type="text"
                            name="what_receive[0][icon]"
                            placeholder="fa-comments"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >


                        <input
                            type="number"
                            name="what_receive[0][number]"
                            value="0"
                            placeholder="اولویت"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >

                    </div>


                    <textarea
                        name="what_receive[0][text]"
                        rows="3"
                        placeholder="توضیحات"
                        style="
                            width:100%;
                            margin-top:10px;
                            padding:10px;
                            border-radius:8px;
                            border:1px solid var(--border);
                            background:transparent;
                            color:inherit;
                        "
                    ></textarea>

                </div>

            </div>


            <button
                type="button"
                id="addWhatReceive"
                class="btn btn-secondary"
                style="
                    margin-bottom:25px;
                    border-radius:8px;
                "
            >
                <i class="fa-solid fa-plus"></i>
                افزودن مورد
            </button>


            {{-- ========================================================= --}}
            {{-- TECHNOLOGIES --}}
            {{-- ========================================================= --}}

            <h6 style="
                margin:35px 0 15px;
                color:var(--accent);
            ">
                <i class="fa-solid fa-toolbox"></i>
                ابزارها و تکنولوژی‌ها
            </h6>


            <div id="techContainer">

                <div
                    class="tech-item"
                    style="
                        border:1px solid var(--border);
                        border-radius:10px;
                        padding:15px;
                        margin-bottom:15px;
                    "
                >

                    <div style="
                        display:grid;
                        grid-template-columns:2fr 1fr 1fr;
                        gap:15px;
                    ">

                        <input
                            type="text"
                            name="techs[0][text]"
                            placeholder="مثلاً Laravel"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >


                        <input
                            type="text"
                            name="techs[0][icon]"
                            placeholder="fa-code"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >


                        <input
                            type="number"
                            name="techs[0][number]"
                            value="0"
                            placeholder="اولویت"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >

                    </div>

                </div>

            </div>


            <button
                type="button"
                id="addTech"
                class="btn btn-secondary"
                style="
                    margin-bottom:25px;
                    border-radius:8px;
                "
            >
                <i class="fa-solid fa-plus"></i>
                افزودن تکنولوژی
            </button>


            {{-- ========================================================= --}}
            {{-- BUTTONS --}}
            {{-- ========================================================= --}}

            <div style="margin-top:25px;">

                <button
                    type="submit"
                    class="btn btn-primary"
                    style="
                        padding:10px 20px;
                        border-radius:8px;
                        border:none;
                        cursor:pointer;
                    "
                >
                    <i class="fa-solid fa-check"></i>
                    ذخیره خدمت
                </button>


                <a
                    href="{{ route('pages.index') }}"
                    class="btn btn-secondary"
                    style="text-decoration:none;"
                >
                    بازگشت
                </a>

            </div>

        </form>

    </div>

</div>

@endsection


@section('scripts')

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.css"
>

<script src="https://cdn.jsdelivr.net/npm/jodit/build/jodit.min.js"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /*
    |--------------------------------------------------------------------------
    | Jodit Editor
    |--------------------------------------------------------------------------
    */

    const editor = new Jodit('#overviewEditor', {

        width: 1400,

        height: 300,

        allowResize: true,

        allowResizeImages: true,

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

                iconURL:
                    'https://cdn-icons-png.flaticon.com/512/1829/1829586.png',

                tooltip: 'آپلود تصویر',

                exec: (editor) => {

                    let input =
                        document.createElement('input');

                    input.type = 'file';

                    input.accept = 'image/*';


                    input.onchange = () => {

                        let file =
                            input.files[0];

                        if (!file) return;


                        let formData =
                            new FormData();

                        formData.append(
                            'file',
                            file
                        );


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

                                editor.s.insertNode(img);

                            } else {

                                alert(
                                    'خطا در آپلود تصویر'
                                );

                            }

                        })
                        .catch(err => {

                            alert(
                                'Upload error: ' + err
                            );

                        });

                    };


                    input.click();

                }

            },


            {

                name: 'uploadVideo',

                iconURL:
                    'https://cdn-icons-png.flaticon.com/512/727/727245.png',

                tooltip: 'آپلود ویدیو',

                exec: (editor) => {

                    let input =
                        document.createElement('input');

                    input.type = 'file';

                    input.accept = 'video/*';


                    input.onchange = () => {

                        let file =
                            input.files[0];

                        if (!file) return;


                        let formData =
                            new FormData();

                        formData.append(
                            'file',
                            file
                        );


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

                                video.style.maxWidth =
                                    '100%';

                                video.src =
                                    data.files[0].url;


                                wrapper.appendChild(
                                    video
                                );


                                editor.s.insertNode(
                                    wrapper
                                );

                            } else {

                                alert(
                                    'خطا در آپلود ویدیو'
                                );

                            }

                        })
                        .catch(err => {

                            alert(
                                'Upload error: ' + err
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


    /*
    |--------------------------------------------------------------------------
    | Image / Icon
    |--------------------------------------------------------------------------
    */

    const imageInput =
        document.getElementById('imageInput');

    const iconInput =
        document.getElementById('iconInput');


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

                imageInput.value = '';

            } else {

                imageInput.disabled = false;

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | What Receive
    |--------------------------------------------------------------------------
    */

    let whatReceiveIndex = 1;


    document
        .getElementById('addWhatReceive')
        .addEventListener(
            'click',
            function () {

                const container =
                    document.getElementById(
                        'whatReceiveContainer'
                    );


                const item =
                    document.createElement('div');


                item.className =
                    'what-receive-item';


                item.style.cssText = `
                    border:1px solid var(--border);
                    border-radius:10px;
                    padding:15px;
                    margin-bottom:15px;
                `;


                item.innerHTML = `

                    <div style="
                        display:grid;
                        grid-template-columns:2fr 1fr 1fr;
                        gap:15px;
                    ">

                        <input
                            type="text"
                            name="what_receive[${whatReceiveIndex}][title]"
                            placeholder="عنوان"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >

                        <input
                            type="text"
                            name="what_receive[${whatReceiveIndex}][icon]"
                            placeholder="fa-comments"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >

                        <input
                            type="number"
                            name="what_receive[${whatReceiveIndex}][number]"
                            value="${whatReceiveIndex}"
                            placeholder="اولویت"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >

                    </div>


                    <textarea
                        name="what_receive[${whatReceiveIndex}][text]"
                        rows="3"
                        placeholder="توضیحات"
                        style="
                            width:100%;
                            margin-top:10px;
                            padding:10px;
                            border-radius:8px;
                            border:1px solid var(--border);
                            background:transparent;
                            color:inherit;
                        "
                    ></textarea>

                `;


                container.appendChild(item);


                whatReceiveIndex++;

            }
        );


    /*
    |--------------------------------------------------------------------------
    | Technologies
    |--------------------------------------------------------------------------
    */

    let techIndex = 1;


    document
        .getElementById('addTech')
        .addEventListener(
            'click',
            function () {

                const container =
                    document.getElementById(
                        'techContainer'
                    );


                const item =
                    document.createElement('div');


                item.className =
                    'tech-item';


                item.style.cssText = `
                    border:1px solid var(--border);
                    border-radius:10px;
                    padding:15px;
                    margin-bottom:15px;
                `;


                item.innerHTML = `

                    <div style="
                        display:grid;
                        grid-template-columns:2fr 1fr 1fr;
                        gap:15px;
                    ">

                        <input
                            type="text"
                            name="techs[${techIndex}][text]"
                            placeholder="مثلاً Laravel"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >

                        <input
                            type="text"
                            name="techs[${techIndex}][icon]"
                            placeholder="fa-code"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >

                        <input
                            type="number"
                            name="techs[${techIndex}][number]"
                            value="${techIndex}"
                            placeholder="اولویت"
                            style="
                                width:100%;
                                padding:10px;
                                border-radius:8px;
                                border:1px solid var(--border);
                                background:transparent;
                                color:inherit;
                            "
                        >

                    </div>

                `;


                container.appendChild(item);


                techIndex++;

            }
        );

});

</script>

@endsection