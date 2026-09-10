@extends('admin.panel')

@section('content')
    <style>
        .ticket-show-page {
            padding: 24px;
            direction: rtl;
        }

        .ticket-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            color: var(--text-light);
            text-decoration: none;
            font-size: 13px;
            transition: .2s;
        }

        .back-link:hover {
            color: var(--text);
        }

        .ticket-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
        }

        .ticket-header {
            padding: 22px 24px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            border-bottom: 2px solid var(--border);
        }

        .ticket-title-area {
            display: flex;
            align-items: flex-start;
            gap: 13px;
        }

        .ticket-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(59, 130, 246, .11);
            color: #3b82f6;
        }

        .ticket-title {
            margin: 0;
            color: var(--text);
            font-size: 19px;
            font-weight: 800;
            line-height: 1.6;
        }

        .ticket-id {
            margin-top: 3px;
            color: var(--text-light);
            font-size: 11px;
        }

        .detail-status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .detail-status.open {
            background: rgba(16, 185, 129, .11);
            color: #10b981;
        }

        .detail-status.closed {
            background: rgba(107, 114, 128, .11);
            color: #6b7280;
        }

        .detail-status i {
            font-size: 6px;
        }

        .ticket-info {
            padding: 22px 24px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-bottom: 2px solid var(--border);
        }

        .info-item {
            min-height: 65px;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 1px solid var(--border);
        }

        .info-item:nth-child(2n) {
            border-left: none;
        }

        .info-item:nth-child(n + 3) {
            border-top: 1px solid var(--border);
            padding-top: 17px;
            margin-top: 5px;
        }

        .info-icon {
            width: 36px;
            height: 36px;
            min-width: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: rgba(127, 127, 127, .09);
            color: var(--text-light);
            font-size: 13px;
        }

        .info-label {
            color: var(--text-light);
            font-size: 10px;
            margin-bottom: 4px;
        }

        .info-value {
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            word-break: break-word;
        }

        .message-section {
            padding: 24px;
            border-bottom: 2px solid var(--border);
        }

        .message-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 13px;
            color: var(--text);
            font-size: 14px;
            font-weight: 800;
        }

        .message-title i {
            color: #3b82f6;
        }

        .message-box {
            padding: 18px 20px;
            background: rgba(127, 127, 127, .035);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            font-size: 13px;
            line-height: 2;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .ticket-footer {
            padding: 17px 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .ticket-button {
            min-height: 37px;
            padding: 0 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .ticket-button.back {
            background: rgba(127, 127, 127, .09);
            color: var(--text-light);
        }

        .ticket-button.back:hover {
            background: rgba(127, 127, 127, .15);
            color: var(--text);
        }

        .ticket-button.close {
            background: rgba(245, 158, 11, .11);
            color: #f59e0b;
        }

        .ticket-button.close:hover {
            background: #f59e0b;
            color: white;
        }

        @media (max-width: 700px) {
            .ticket-show-page {
                padding: 15px;
            }

            .ticket-header {
                padding: 18px;
                flex-direction: column;
            }

            .ticket-info {
                padding: 12px;
                grid-template-columns: 1fr;
            }

            .info-item {
                border-left: none !important;
                border-top: 1px solid var(--border);
                margin: 0 !important;
                padding: 13px 8px !important;
            }

            .info-item:first-child {
                border-top: none;
            }

            .message-section {
                padding: 18px;
            }

            .ticket-footer {
                padding: 15px 18px;
            }

            .ticket-title {
                font-size: 17px;
            }
        }
    </style>

    <div class="ticket-show-page">
        <div class="ticket-container">

            <a href="{{ route('support.index') }}" class="back-link">
                <i class="fa-solid fa-arrow-right"></i>
                بازگشت به تیکت‌ها
            </a>

            <div class="ticket-card">

                {{-- Header --}}
                <div class="ticket-header">

                    <div class="ticket-title-area">

                        <div class="ticket-icon">
                            <i class="fa-solid fa-ticket"></i>
                        </div>

                        <div>
                            <h4 class="ticket-title">
                                {{ $ticket->subject }}
                            </h4>

                            <div class="ticket-id">
                                شماره تیکت #{{ $ticket->id }}
                            </div>
                        </div>

                    </div>

                    @if($ticket->status === 'open')
                        <span class="detail-status open">
                            <i class="fa-solid fa-circle"></i>
                            باز
                        </span>
                    @else
                        <span class="detail-status closed">
                            <i class="fa-solid fa-circle"></i>
                            بسته
                        </span>
                    @endif

                </div>

                {{-- اطلاعات تیکت --}}
                <div class="ticket-info">

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <div>
                            <div class="info-label">
                                نام کاربر
                            </div>

                            <div class="info-value">
                                {{ $ticket->user_name }}
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <div>
                            <div class="info-label">
                                ایمیل
                            </div>

                            <div class="info-value">
                                {{ $ticket->email }}
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-regular fa-calendar"></i>
                        </div>

                        <div>
                            <div class="info-label">
                                تاریخ ثبت
                            </div>

                            <div class="info-value">
                                {{ $ticket->created_at->format('Y/m/d H:i') }}
                            </div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>

                        <div>
                            <div class="info-label">
                                آخرین بروزرسانی
                            </div>

                            <div class="info-value">
                                {{ $ticket->updated_at->format('Y/m/d H:i') }}
                            </div>
                        </div>
                    </div>

                </div>

                {{-- متن پیام --}}
                <div class="message-section">

                    <div class="message-title">
                        <i class="fa-solid fa-message"></i>
                        متن پیام
                    </div>

                    <div class="message-box">
                        {{ $ticket->message }}
                    </div>

                </div>

                {{-- عملیات --}}
                <div class="ticket-footer">

                    <a
                        href="{{ route('support.index') }}"
                        class="ticket-button back"
                    >
                        <i class="fa-solid fa-arrow-right"></i>
                        بازگشت
                    </a>

                    @if($ticket->status === 'open')
                        <a
                            href="{{ route('support.close', $ticket->id) }}"
                            class="ticket-button close"
                            onclick="return confirm('آیا می‌خواهید این تیکت را ببندید؟');"
                        >
                            <i class="fa-solid fa-lock"></i>
                            بستن تیکت
                        </a>
                    @endif

                </div>

            </div>

        </div>
    </div>
@endsection