@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h5 style="margin: 0;">
                <i class="fa-solid fa-layer-group"></i> مدیریت خدمات
            </h5>
            <a href="{{ route('pages.create') }}" class="btn btn-sm btn-primary" style="padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                <i class="fa-solid fa-plus"></i> افزودن خدمت جدید
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
                        <th style="padding: 12px; text-align: right;">عنوان</th>
                        <th style="padding: 12px; text-align: right;">شماره</th>
                        <th style="padding: 12px; text-align: right;">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $index => $service)
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 12px;">{{ persianNum($services->firstItem() + $index) }}</td>
                            <td style="padding: 12px;">
                                @if($service->image_url)
                                    <img src="{{ asset('storage/') }}) }} . $service->image_url) }}" style="width: 45px; height: 45px; object-fit: cover; border-radius: 6px;">
                                @else
                                    <span style="color: var(--text-light);">بدون تصویر</span>
                                @endif
                            </td>
                            <td style="padding: 12px;">{{ $service->title }}</td>
                            <td style="padding: 12px;">{{ persianNum($service->number ?? '-') }}</td>
                            <td style="padding: 12px;">
                                <a href="{{ route('pages.edit', $service->id) }}" class="btn btn-sm btn-warning" style="margin-left: 5px; display: inline-block; padding: 6px 10px; border-radius: 6px; text-decoration: none;">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('pages.destroy', $service->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('آیا از حذف این خدمت اطمینان دارید؟');">
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
                            <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-light);">
                                <i class="fa-solid fa-inbox"></i> هیچ خدمتی یافت نشد
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 20px;">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection
