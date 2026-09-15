@extends('layout.master')

@section('title')
    مانا
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endsection

@section('main')
    <div class="mnav-backdrop" id="mnavBackdrop"></div>
    <!-- ============ SIDE QUICK NAV ============ -->
    <div class="side-nav" id="sideNav">
        <a href="#top" class="active">
            <span>معرفی</span>
        </a>
        <a href="#order-form">
            <span>فرم سفارش</span>
        </a>
        <a href="#process">
            <span>مراحل کار</span>
        </a>
        <a href="#order-faq">
            <span>سوالات متداول</span>
        </a>
    </div>
    <!-- ============ ORDER HERO ============ -->
    <section class="case-hero" id="top">
        <div class="container-x">
            <div class="breadcrumb-x reveal in">
                <a href="/">خانه</a>
                <i class="fa-solid fa-chevron-left"></i>
                <span class="cur">سفارش پروژه</span>
            </div>
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="eyebrow reveal in">
                        <i class="fa-solid fa-rocket"></i> شروع همکاری
                    </span>
                    <h1 class="reveal in">
                        پروژه بعدی خودتان را
                        <br>
                        همین‌جا سفارش دهید
                    </h1>
                    <p class="section-sub reveal in reveal-delay-1" style="max-width: 640px; margin-bottom: 0">
                        فرم زیر را با اطلاعات پروژه‌تان پر کنید و نوع خدمت مدنظرتان را از فهرست انتخاب کنید؛ تیم مانا در
                        کمتر از ۲۴ ساعت برای هماهنگی جلسه مشاوره رایگان با شما تماس می‌گیرد.
                    </p>
                    <div class="case-meta-row reveal in reveal-delay-2">
                        <div class="case-meta-chip">
                            <i class="fa-regular fa-clock"></i>
                            پاسخ زیر ۲۴ ساعت
                        </div>
                        <div class="case-meta-chip">
                            <i class="fa-solid fa-comments"></i>
                            مشاوره اولیه رایگان
                        </div>
                        <div class="case-meta-chip">
                            <i class="fa-solid fa-shield-halved"></i>
                            قرارداد و محرمانگی NDA
                        </div>
                    </div>
                    <div class="case-hero-btns reveal in reveal-delay-3">
                        <a href="#order-form" class="btn-flow">شروع ثبت سفارش
                            <i class="fa-solid fa-arrow-down"></i>
                        </a>
                        <a href="{{ url('/') }}#services" class="btn-ghost">
                            <i class="fa-solid fa-layer-group"></i> مشاهده خدمات
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============ ORDER FORM ============ -->
    <section class="order-section" id="order-form">
        <div class="container-x">
            <div class="row g-4">
                <!-- sidebar -->
                <div class="col-lg-5">
                    <span class="eyebrow reveal">
                        <i class="fa-solid fa-circle-info"></i> قبل از ارسال بدانید
                    </span>
                    <h2 class="section-title reveal reveal-delay-1" style="margin-bottom: 18px">
                        چرا سفارش خود را به مانا بسپارید؟
                    </h2>
                    <p class="section-sub reveal reveal-delay-1" style="margin-bottom: 30px">
                        فقط کافی‌ست فرم را پر کنید؛ بقیه مسیر - از مشاوره تا اجرا - با تیم ماست.
                    </p>
                    <div class="order-perks">
                        <div class="order-perk reveal reveal-delay-1">
                            <div class="ic">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <div>
                                <h6>مشاور اختصاصی</h6>
                                <p>یک کارشناس، پیگیر پروژه شما از ابتدا تا تحویل نهایی.</p>
                            </div>
                        </div>
                        <div class="order-perk reveal reveal-delay-2">
                            <div class="ic">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                            <div>
                                <h6>پیش‌فاکتور شفاف</h6>
                                <p>برآورد هزینه و زمان‌بندی، پیش از شروع هر همکاری.</p>
                            </div>
                        </div>
                        <div class="order-perk reveal reveal-delay-3">
                            <div class="ic">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <div>
                                <h6>محرمانگی کامل</h6>
                                <p>ایده و اطلاعات پروژه شما تحت قرارداد NDA محفوظ می‌ماند.</p>
                            </div>
                        </div>
                        <div class="order-perk reveal reveal-delay-4">
                            <div class="ic">
                                <i class="fa-solid fa-headset"></i>
                            </div>
                            <div>
                                <h6>پشتیبانی ۲۴/۷</h6>
                                <p>حتی بعد از تحویل پروژه، همراه شما و کسب‌وکارتان هستیم.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- form card -->
                <div class="col-lg-7">
                    <div class="contact-card order-card reveal reveal-delay-2">
                        <span class="eyebrow">
                            <i class="fa-solid fa-file-pen"></i> فرم سفارش پروژه
                        </span>
                        <h3 style="font-weight: 800; font-size: 1.5rem; margin-bottom: 6px">
                            اطلاعات پروژه‌تان را وارد کنید
                        </h3>
                        <p class="section-sub" style="margin-bottom: 26px">
                            فیلدهای ستاره‌دار الزامی هستند؛ بقیه به ما کمک می‌کند دقیق‌تر مشاوره بدهیم.
                        </p>
                        <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                        @csrf

                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label-x">نام و نام‌خانوادگی
                                    <span class="req">*</span>
                                </label>
                                <input class="form-control-x" name="fullname" placeholder="مثلاً علی محمدی" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label-x">شماره تماس
                                    <span class="req">*</span>
                                </label>
                                <input class="form-control-x" name="phone" type="tel" placeholder="۰۹1۲۳۴۵۶۷۸۹" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label-x">ایمیل</label>
                                <input class="form-control-x" name="email" type="email" placeholder="you@example.com">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label-x">نام کسب‌وکار / شرکت</label>
                                <input class="form-control-x" name="company" placeholder="اختیاری">
                            </div>
                        </div>
                        <label class="form-label-x">نوع خدمت مورد نظر
                            <span class="req">*</span>
                        </label>
                        <div class="cs-select" id="serviceSelect">
                            <button type="button" class="cs-trigger" id="csTrigger" aria-haspopup="listbox"
                                aria-expanded="false">
                                <span class="cs-trigger-txt">
                                    <i class="fa-solid {{ $currentService->icon ?? 'fa-layer-group' }} cs-trigger-ic"></i>
                                    <span id="csLabel">{{ $currentService->title }}</span>
                                </span>
                                <i class="fa-solid fa-chevron-down cs-arrow"></i>
                            </button>

                            <ul class="cs-panel" id="csPanel" role="listbox">
                                @foreach ($services as $serviceItem)
                                    <li class="cs-option {{ $currentService->id == $serviceItem->id ? 'selected active' : '' }}"
                                        role="option" data-value="{{ $serviceItem->id }}" data-title="{{ $serviceItem->title }}"
                                        data-icon="{{ $serviceItem->icon ?? 'fa-window-restore' }}">
                                        <i class="fa-solid {{ $serviceItem->icon ?? 'fa-window-restore' }}"></i>
                                        {{ $serviceItem->title }}
                                    </li>
                                @endforeach
                            </ul>

                            <input type="hidden" name="service" id="serviceInput" value="{{ $currentService->id }}"
                                required>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label-x">بودجه تقریبی</label>
                                <select class="form-control-x form-select-x" name="budget">
                                    <option value="" selected>انتخاب کنید (اختیاری)</option>
                                    <option value="under50">کمتر از ۵۰ میلیون تومان</option>
                                    <option value="50to200">۵۰ تا ۲۰۰ میلیون تومان</option>
                                    <option value="200to500">۲۰۰ تا ۵۰۰ میلیون تومان</option>
                                    <option value="over500">بیشتر از ۵۰۰ میلیون تومان</option>
                                    <option value="unknown">هنوز مشخص نیست</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label-x">بازه زمانی مدنظر</label>
                                <select class="form-control-x form-select-x" name="timeline">
                                    <option value="" selected>انتخاب کنید (اختیاری)</option>
                                    <option value="urgent">فوری (کمتر از یک ماه)</option>
                                    <option value="short">کوتاه‌مدت (۱ تا ۳ ماه)</option>
                                    <option value="mid">میان‌مدت (۳ تا ۶ ماه)</option>
                                    <option value="long">بلندمدت (بیش از ۶ ماه)</option>
                                </select>
                            </div>
                        </div>
                        <label class="form-label-x">توضیحات پروژه
                            <span class="req">*</span>
                        </label>
                        <textarea class="form-control-x" name="description"
                            placeholder="کمی درباره پروژه، هدف و امکانات مدنظرتان بنویسید..." required></textarea>
                        <button type="submit" class="btn-flow w-100 justify-content-center" id="orderSubmit"
                            style="border: none">
                            ارسال درخواست سفارش
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                        <p class="form-note">
                            <i class="fa-solid fa-lock"></i> اطلاعات شما محرمانه باقی می‌ماند و صرفاً برای تماس با شما
                            استفاده می‌شود.
                        </p>
                        </form>
                        <!-- success state -->
                        <div class="order-success" id="orderSuccess">
                            <div class="ok-ic">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <h3>درخواست شما ثبت شد!</h3>
                            <p>همکاران ما در کمتر از ۲۴ ساعت کاری از طریق شماره تماسی که وارد کرده‌اید با شما تماس می‌گیرند.
                            </p>
                            <button type="button" class="btn-ghost" id="orderReset">
                                <i class="fa-solid fa-arrow-rotate-right"></i> ثبت سفارش جدید
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============ PROCESS ============ -->
    <section class="process" id="process">
        <div class="container-x">
            <div class="text-center mb-4 reveal">
                <span class="eyebrow">
                    <i class="fa-solid fa-route"></i> بعد از ثبت سفارش چه می‌شود؟
                </span>
                <h2 class="section-title">از ثبت فرم تا تحویل پروژه</h2>
                <p class="section-sub" style="margin: 14px auto 0">
                    مسیری شفاف و بدون ابهام؛ همین حالا شروع کنید.
                </p>
            </div>
            <div class="process-grid">
                <div class="process-step reveal reveal-delay-1">
                    <div class="pnum">۱</div>
                    <h4>ثبت درخواست</h4>
                    <p>فرم سفارش را با اطلاعات پروژه‌تان تکمیل و ارسال می‌کنید.</p>
                </div>
                <div class="process-step reveal reveal-delay-2">
                    <div class="pnum">۲</div>
                    <h4>تماس و مشاوره</h4>
                    <p>کارشناس ما تماس می‌گیرد و نیاز واقعی شما را بررسی می‌کند.</p>
                </div>
                <div class="process-step reveal reveal-delay-3">
                    <div class="pnum">۳</div>
                    <h4>پیش‌فاکتور و زمان‌بندی</h4>
                    <p>برآورد شفاف هزینه و بازه زمانی اجرای پروژه ارائه می‌شود.</p>
                </div>
                <div class="process-step reveal reveal-delay-4">
                    <div class="pnum">۴</div>
                    <h4>شروع اجرا</h4>
                    <p>پس از تأیید نهایی شما، تیم مانا اجرای پروژه را آغاز می‌کند.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ============ ORDER FAQ ============ -->
    <section class="faqc order-faqc" id="order-faq">
        <div class="container-x">
            <div class="text-center mb-5 reveal">
                <span class="eyebrow">
                    <i class="fa-solid fa-circle-question"></i> سوالات متداول
                </span>
                <h2 class="section-title">قبل از سفارش، این‌ها را بخوانید</h2>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="acc-list">
                        <div class="acc-item open reveal">
                            <button class="acc-btn">
                                بعد از ارسال فرم، چه زمانی با من تماس می‌گیرید؟
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <div class="acc-panel">
                                <p>
                                    در کمتر از ۲۴ ساعت کاری، یکی از کارشناسان ما از طریق شماره تماسی که وارد کرده‌اید، تماس
                                    می‌گیرد تا جلسه مشاوره رایگان هماهنگ شود.
                                </p>
                            </div>
                        </div>
                        <div class="acc-item reveal reveal-delay-1">
                            <button class="acc-btn">
                                اگر نوع خدمت مدنظرم در فهرست نبود چه کنم؟
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <div class="acc-panel">
                                <p>
                                    گزینه «سایر» را انتخاب کنید و در بخش توضیحات، نیاز خود را شرح دهید؛ تیم ما آن را بررسی
                                    می‌کند.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="acc-list">
                        <div class="acc-item reveal reveal-delay-2">
                            <button class="acc-btn">
                                آیا برای ثبت سفارش باید بودجه دقیق داشته باشم؟
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <div class="acc-panel">
                                <p>
                                    خیر. اگر بودجه دقیقی ندارید، گزینه «هنوز مشخص نیست» را انتخاب کنید؛ در جلسه مشاوره با هم
                                    به
                                    یک برآورد واقع‌بینانه می‌رسیم.
                                </p>
                            </div>
                        </div>
                        <div class="acc-item reveal reveal-delay-3">
                            <button class="acc-btn">
                                آیا اطلاعات پروژه من محرمانه می‌ماند؟
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <div class="acc-panel">
                                <p>
                                    بله؛ در صورت نیاز پیش از شروع همکاری قرارداد محرمانگی (NDA) امضا می‌شود و اطلاعات شما
                                    فقط در
                                    اختیار تیم پروژه قرار می‌گیرد.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============ FINAL CTA ============ -->
    <section class="final-cta">
        <div class="container-x">
            <div class="cta-banner reveal">
                <h2>هنوز فرم را پر نکرده‌اید؟</h2>
                <p>
                    فقط چند دقیقه زمان می‌برد؛ همین الان اطلاعات پروژه‌تان را ثبت کنید تا تیم مانا با شما تماس بگیرد.
                </p>
                <a href="#order-form" class="btn-flow">بازگشت به فرم سفارش
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </section>

    <button class="to-top" id="toTop">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
    <a href="index.html#contact" class="chat-fab" id="chatFab">
        <i class="fa-solid fa-comment-dots"></i>
    </a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

    @section('js')
        <script src="{{ asset('js/client/order.js') }}"></script>
    @endsection
@endsection