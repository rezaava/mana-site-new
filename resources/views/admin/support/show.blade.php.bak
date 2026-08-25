@extends('admin.panel')

@section('content')
<div style="padding: 20px; max-width: 800px; margin: 0 auto;">
    <a href="{{ route('support.index') }}" style="color: var(--text-light); text-decoration: none; display: inline-block; margin-bottom: 20px;">
        <i class="fa-solid fa-arrow-right"></i> بازگشت
    </a>

    <div style="background: var(--card-bg); border-radius: 12px; padding: 25px;">
        <h4 style="margin-bottom: 20px;">{{ $ticket->subject }}</h4>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px; padding-bottom: 20px; border-bottom: 1px solid var(--border);">
            <div>
                <small style="color: var(--text-light);">از طرف:</small>
                <p style="margin: 5px 0;">{{ $ticket->user_name }}</p>
            </div>
            <div>
                <small style="color: var(--text-light);">ایمیل:</small>
                <p style="margin: 5px 0;">{{ $ticket->email }}</p>
            </div>
            <div>
                <small style="color: var(--text-light);">وضعیت:</small>
                <p style="margin: 5px 0;">
                    @if($ticket->status == 'open')
                        <span style="background: #10b981; color: white; padding: 2px 12px; border-radius: 10px; font-size: 13px;">باز</span>
                    @else
                        <span style="background: #6b7280; color: white; padding: 2px 12px; border-radius: 10px; font-size: 13px;">بسته</span>
                    @endif
                </p>
            </div>
            <div>
                <small style="color: var(--text-light);">تاریخ:</small>
                <p style="margin: 5px 0;">{{ $ticket->created_at->format('Y/m/d H:i') }}</p>
            </div>
        </div>

        <div style="line-height: 1.8; white-space: pre-line;">
            {{ $ticket->message }}
        </div>
    </div>
</div>
@endsection
