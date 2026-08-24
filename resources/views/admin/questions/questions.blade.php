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
                <i class="fa-solid fa-circle-question"></i> مدیریت سوالات متداول
            </h5>
            <a href="{{ route('questions.create') }}" class="btn btn-primary" style="padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-plus"></i> افزودن سوال جدید
            </a>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; color: inherit;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border); text-align: right;">
                        <th style="padding: 12px; width: 60px;">#</th>
                        <th style="padding: 12px; width: 80px;">ترتیب</th>
                        <th style="padding: 12px; width: 30%;">عنوان سوال</th>
                        <th style="padding: 12px;">پاسخ</th>
                        <th style="padding: 12px; width: 150px;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($questions as $question)
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 12px;">{{ $question->id }}</td>
                            <td style="padding: 12px;">
                                <span style="background: var(--border); padding: 4px 10px; border-radius: 6px; font-weight: bold;">
                                    {{ $question->number }}
                                </span>
                            </td>
                            <td style="padding: 12px; font-weight: 600;">{{ $question->question }}</td>
                            <td style="padding: 12px; color: var(--text-light); font-size: 0.9rem;">
                                {{ Str::limit($question->answer, 120, '...') }}
                            </td>
                            <td style="padding: 12px;">
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('questions.edit', $question->id) }}" style="background: #f59e0b; color: #fff; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.85rem;">
                                        <i class="fa-solid fa-pen"></i> ویرایش
                                    </a>
                                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #ef4444; color: #fff; padding: 6px 12px; border-radius: 6px; border: none; cursor: pointer; font-size: 0.85rem;" onclick="return confirm('آیا از حذف این سوال اطمینان دارید؟')">
                                            <i class="fa-solid fa-trash"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 20px; color: var(--text-light);">هیچ سوالی ثبت نشده است.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $questions->links() }}
        </div>
    </div>
</div>
@endsection