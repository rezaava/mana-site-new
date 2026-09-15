@extends('admin.panel')

@section('content')
    <style>
        /* ===== استایل مشاهده سفارش - هماهنگ با فرم‌های پنل ===== */
        .order-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }

        .order-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .order-form-title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-back-form {
            color: var(--text-dim);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .btn-back-form:hover {
            color: var(--text);
        }

        .order-id-chip {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 6px;
            background: var(--surface-2);
            color: var(--text-dim);
            font-size: 0.75rem;
            font-weight: 700;
            margin-right: 8px;
        }

        .order-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 99px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .order-status-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .order-status-badge.new {
            background: rgba(16, 185, 129, 0.12);
            color: #10b981;
        }

        .order-status-badge.new::before {
            background: #10b981;
        }

        .order-status-badge.pending {
            background: rgba(245, 158, 11, 0.12);
            color: #f59e0b;
        }

        .order-status-badge.pending::before {
            background: #f59e0b;
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

        .form-input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: transparent;
            color: var(--text);
            font-family: inherit;
            font-size: 0.9rem;
            word-break: break-word;
        }

        .form-input.readonly {
            background: var(--surface-2);
            color: var(--text-dim);
            cursor: default;
            min-height: 42px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-input.readonly i {
            opacity: 0.6;
            font-size: 0.85rem;
        }

        .form-textarea {
            width: 100%;
            padding: 14px 16px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--surface-2);
            color: var(--text);
            font-family: inherit;
            font-size: 0.9rem;
            line-height: 2;
            white-space: pre-line;
            word-break: break-word;
            min-height: 120px;
        }

        .order-phone-box {
            direction: ltr;
            text-align: right;
            justify-content: flex-end;
        }

        .service-badge-show {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            background: color-mix(in srgb, var(--brand) 10%, transparent);
            color: var(--brand);
            font-size: 0.88rem;
            font-weight: 600;
            min-height: 42px;
        }

        .service-badge-show i {
            font-size: 0.9rem;
        }

        .budget-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 8px;
            background: color-mix(in srgb, var(--accent) 12%, transparent);
            color: var(--accent);
            font-size: 0.85rem;
            font-weight: 600;
            min-height: 42px;
        }

        .timeline-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 8px;
            background: color-mix(in srgb, var(--accent-2) 12%, transparent);
            color: var(--accent-2);
            font-size: 0.85rem;
            font-weight: 600;
            min-height: 42px;
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
            color: var(--oncta);
        }

        .btn-back-form-footer {
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

        .btn-back-form-footer:hover {
            background: var(--card-hover);
            color: var(--text);
        }

        /* ===== ریسپانسیو ===== */
        @media (max-width: 768px) {
            .order-form-card {
                padding: 15px;
            }

            .form-grid-2 {
                grid-template-columns: 1fr;
            }

            .order-form-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="order-form-card">
            <div class="order-form-header">
                <h5 class="order-form-title">
                    <i class="fa-solid fa-file-invoice"></i>
                    مشاهده سفارش
                    <span class="order-id-chip">#{{ $order->id }}</span>

                    <span class="order-status-badge new">جدید</span>
                </h5>

                <a href="{{ route('orders.index') }}" class="btn-back-form">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت به سفارشات
                </a>
            </div>

            {{-- اطلاعات کاربر --}}
            <h6 class="form-section-title">
                <i class="fa-solid fa-user"></i> اطلاعات کاربر
            </h6>

            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label class="form-label">نام و نام‌خانوادگی</label>
                    <div class="form-input readonly">
                        <i class="fa-solid fa-user"></i>
                        {{ $order->fullname }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">شماره تماس</label>
                    <div class="form-input readonly order-phone-box">
                        <i class="fa-solid fa-phone" style="margin-left: 6px;"></i>
                        {{ $order->phone }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">ایمیل</label>
                    <div class="form-input readonly">
                        <i class="fa-solid fa-envelope"></i>
                        {{ $order->email ?? 'وارد نشده' }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">نام کسب‌وکار / شرکت</label>
                    <div class="form-input readonly">
                        <i class="fa-solid fa-building"></i>
                        {{ $order->company ?? 'وارد نشده' }}
                    </div>
                </div>
            </div>

            {{-- اطلاعات خدمت --}}
            <h6 class="form-section-title">
                <i class="fa-solid fa-layer-group"></i> اطلاعات خدمت
            </h6>

            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label class="form-label">خدمت مورد نظر</label>
                    @if($order->service)
                        <div class="service-badge-show">
                            <i class="fa-solid {{ $order->service->icon ?? 'fa-layer-group' }}"></i>
                            {{ $order->service->title }}
                        </div>
                    @else
                        <div class="form-input readonly" style="color: var(--text-dimmer);">
                            <i class="fa-solid fa-circle-info"></i>
                            خدمت مشخص نشده
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label">بودجه تقریبی</label>
                    @php
                        $budgetLabels = [
                            'under50' => 'کمتر از ۵۰ میلیون تومان',
                            '50to200' => '۵۰ تا ۲۰۰ میلیون تومان',
                            '200to500' => '۲۰۰ تا ۵۰۰ میلیون تومان',
                            'over500' => 'بیشتر از ۵۰۰ میلیون تومان',
                            'unknown' => 'هنوز مشخص نیست',
                        ];
                    @endphp
                    @if($order->budget && isset($budgetLabels[$order->budget]))
                        <div class="budget-badge">
                            <i class="fa-solid fa-sack-dollar"></i>
                            {{ $budgetLabels[$order->budget] }}
                        </div>
                    @else
                        <div class="form-input readonly" style="color: var(--text-dimmer);">
                            <i class="fa-solid fa-circle-info"></i>
                            وارد نشده
                        </div>
                    @endif
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label">بازه زمانی مدنظر</label>
                    @php
                        $timelineLabels = [
                            'urgent' => 'فوری (کمتر از یک ماه)',
                            'short' => 'کوتاه‌مدت (۱ تا ۳ ماه)',
                            'mid' => 'میان‌مدت (۳ تا ۶ ماه)',
                            'long' => 'بلندمدت (بیش از ۶ ماه)',
                        ];
                    @endphp
                    @if($order->timeline && isset($timelineLabels[$order->timeline]))
                        <div class="timeline-badge">
                            <i class="fa-solid fa-clock"></i>
                            {{ $timelineLabels[$order->timeline] }}
                        </div>
                    @else
                        <div class="form-input readonly" style="color: var(--text-dimmer);">
                            <i class="fa-solid fa-circle-info"></i>
                            وارد نشده
                        </div>
                    @endif
                </div>
            </div>

            {{-- توضیحات پروژه --}}
            <h6 class="form-section-title">
                <i class="fa-solid fa-message"></i> توضیحات پروژه
            </h6>

            <div class="form-group" style="margin-bottom: 20px;">
                <label class="form-label">پیام کاربر</label>
                <div class="form-textarea">{{ $order->description }}</div>
            </div>

            {{-- زمان‌ها --}}
            <h6 class="form-section-title">
                <i class="fa-regular fa-calendar"></i> زمان‌ها
            </h6>

            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label class="form-label">تاریخ ثبت</label>
                    <div class="form-input readonly">
                        <i class="fa-regular fa-clock"></i>
                        {{ $order->created_at->format('Y/m/d H:i') }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">آخرین بروزرسانی</label>
                    <div class="form-input readonly">
                        <i class="fa-regular fa-clock"></i>
                        {{ $order->updated_at->format('Y/m/d H:i') }}
                    </div>
                </div>
            </div>

            {{-- دکمه‌ها --}}
            <div style="margin-top: 25px; display: flex; gap: 10px; flex-wrap: wrap;">
                @if($order->email)
                    <a href="mailto:{{ $order->email }}" class="btn-submit-form">
                        <i class="fa-solid fa-envelope"></i> ارسال ایمیل
                    </a>
                @endif

                @if($order->phone)
                    <a href="tel:{{ $order->phone }}" class="btn-submit-form">
                        <i class="fa-solid fa-phone"></i> تماس تلفنی
                    </a>
                @endif

                <a href="{{ route('orders.index') }}" class="btn-back-form-footer">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت
                </a>
            </div>
        </div>
    </div>
@endsection