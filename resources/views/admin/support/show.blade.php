@extends('admin.panel')

@section('content')
    <style>
        /* ===== استایل مشاهده تیکت - هماهنگ با فرم‌های پنل ===== */
        .ticket-form-card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: var(--shadow-strong);
            padding: 25px;
        }

        .ticket-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .ticket-form-title {
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

        .ticket-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 99px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .ticket-status-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .ticket-status-badge.open {
            background: rgba(16, 185, 129, 0.12);
            color: #10b981;
        }

        .ticket-status-badge.open::before {
            background: #10b981;
        }

        .ticket-status-badge.closed {
            background: rgba(107, 114, 128, 0.12);
            color: #6b7280;
        }

        .ticket-status-badge.closed::before {
            background: #6b7280;
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
            min-height: 100px;
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

        .btn-close-ticket {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(245, 158, 11, 0.12);
            color: #f59e0b;
            border: 1px solid #f59e0b;
            transition: all 0.3s var(--ease);
            text-decoration: none;
            font-family: inherit;
            font-size: 0.9rem;
        }

        .btn-close-ticket:hover {
            background: #f59e0b;
            color: #fff;
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

        .ticket-id-chip {
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

        /* ===== ریسپانسیو ===== */
        @media (max-width: 768px) {
            .ticket-form-card {
                padding: 15px;
            }

            .form-grid-2 {
                grid-template-columns: 1fr;
            }

            .ticket-form-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>

    <div style="padding: 20px;">
        <div class="ticket-form-card">
            <div class="ticket-form-header">
                <h5 class="ticket-form-title">
                    <i class="fa-solid fa-ticket"></i>
                    مشاهده تیکت
                    <span class="ticket-id-chip">#{{ $ticket->id }}</span>

                    @if($ticket->status === 'open')
                        <span class="ticket-status-badge open">باز</span>
                    @else
                        <span class="ticket-status-badge closed">بسته</span>
                    @endif
                </h5>

                <a href="{{ route('support.index') }}" class="btn-back-form">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت به تیکت‌ها
                </a>
            </div>

            {{-- موضوع تیکت --}}
            <h6 class="form-section-title">
                <i class="fa-solid fa-heading"></i> موضوع تیکت
            </h6>

            <div class="form-group" style="margin-bottom: 20px;">
                <label class="form-label">عنوان</label>
                <div class="form-input readonly">{{ $ticket->subject }}</div>
            </div>

            {{-- اطلاعات کاربر --}}
            <h6 class="form-section-title">
                <i class="fa-solid fa-user"></i> اطلاعات کاربر
            </h6>

            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label class="form-label">نام کاربر</label>
                    <div class="form-input readonly">{{ $ticket->user_name }}</div>
                </div>

                <div class="form-group">
                    <label class="form-label">ایمیل</label>
                    <div class="form-input readonly">{{ $ticket->email ?? '-' }}</div>
                </div>
            </div>

            {{-- زمان‌ها --}}
            <h6 class="form-section-title">
                <i class="fa-regular fa-calendar"></i> زمان‌ها
            </h6>

            <div class="form-grid form-grid-2">
                <div class="form-group">
                    <label class="form-label">تاریخ ثبت</label>
                    <div class="form-input readonly">
                        <i class="fa-regular fa-clock" style="margin-left: 6px; opacity: 0.6;"></i>
                        {{ $ticket->created_at->format('Y/m/d H:i') }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">آخرین بروزرسانی</label>
                    <div class="form-input readonly">
                        <i class="fa-regular fa-clock" style="margin-left: 6px; opacity: 0.6;"></i>
                        {{ $ticket->updated_at->format('Y/m/d H:i') }}
                    </div>
                </div>
            </div>

            {{-- متن پیام --}}
            <h6 class="form-section-title">
                <i class="fa-solid fa-message"></i> متن پیام
            </h6>

            <div class="form-group" style="margin-bottom: 20px;">
                <label class="form-label">پیام کاربر</label>
                <div class="form-textarea">{{ $ticket->message }}</div>
            </div>

            {{-- دکمه‌ها --}}
            <div style="margin-top: 25px; display: flex; gap: 10px; flex-wrap: wrap;">
                @if($ticket->status === 'open')
                    <a href="{{ route('support.close', $ticket->id) }}" class="btn-close-ticket"
                        onclick="return confirm('آیا می‌خواهید این تیکت را ببندید؟');">
                        <i class="fa-solid fa-lock"></i> بستن تیکت
                    </a>
                @endif

                <a href="{{ route('support.index') }}" class="btn-back-form-footer">
                    <i class="fa-solid fa-arrow-right"></i> بازگشت
                </a>
            </div>
        </div>
    </div>
@endsection