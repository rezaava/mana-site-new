@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-users"></i> مدیریت اعضای تیم
            </h5>
            <a href="{{ route('create_team_form') }}" class="btn btn-sm btn-primary" style="padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                <i class="fa-solid fa-plus"></i> افزودن عضو جدید
            </a>
        </div>

        @if(session('success'))
            <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10b981; color: #10b981; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--border);">
                        <th style="padding: 12px; text-align: right;">#</th>
                        <th style="padding: 12px; text-align: right;">تصویر</th>
                        <th style="padding: 12px; text-align: right;">نام و نام خانوادگی</th>
                        <th style="padding: 12px; text-align: right;">سمت شغلی</th>
                        <th style="padding: 12px; text-align: right;">ترتیب</th>
                        <th style="padding: 12px; text-align: right;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 12px;">{{ $loop->iteration }}</td>
                            <td style="padding: 12px;">
                                @if($member->image_url)
                                    <img src="{{ asset('storage/' . $member->image_url) }}" alt="{{ $member->name }}" style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%;">
                                @else
                                    <span style="color: var(--text-light);">بدون تصویر</span>
                                @endif
                            </td>
                            <td style="padding: 12px;">{{ $member->name }}</td>
                            <td style="padding: 12px;">{{ $member->title ?? '-' }}</td>
                            <td style="padding: 12px;">{{ $member->number ?? '-' }}</td>
                            <td style="padding: 12px;">
                                <a href="{{ route('edit_team_form', $member->id) }}" class="btn btn-sm btn-warning" style="margin-left: 5px; display: inline-block; padding: 6px 10px; border-radius: 6px; text-decoration: none;">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('destroy_team', $member->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('آیا از حذف این عضو تیم اطمینان دارید؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" style="padding: 6px 10px; border-radius: 6px; border: none; cursor: pointer;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-light);">
                                <i class="fa-solid fa-inbox"></i> هیچ عضوی یافت نشد
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection