@extends('admin.panel')

@section('content')
<div style="padding: 20px;">
    <div style="background: var(--card-bg); border-radius: 12px; padding: 20px;">
        <h5 style="margin-bottom: 20px;">
            <i class="fa-solid fa-file"></i> صفحات (سرویس‌ها)
        </h5>

        <div id="pagesTable">
            <p style="text-align: center; padding: 40px; color: var(--text-light);">
                <i class="fa-solid fa-spinner fa-spin"></i> در حال بارگذاری...
            </p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadServices();
});

function loadServices() {
    fetch('/admin/services/services')
        .then(response => response.json())
        .then(data => {
            const services = data.services || [];

            let html = `
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border);">
                            <th style="padding: 12px; text-align: right;">#</th>
                            <th style="padding: 12px; text-align: right;">عنوان</th>
                            <th style="padding: 12px; text-align: right;">متن</th>
                            <th style="padding: 12px; text-align: right;">تصویر</th>
                            <th style="padding: 12px; text-align: right;">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>`;

            if (services.length > 0) {
                services.forEach((service, index) => {
                    html += `
                        <tr style="border-bottom: 1px solid var(--border);">
                            <td style="padding: 12px;">${service.id}</td>
                            <td style="padding: 12px;">${service.title || '---'}</td>
                            <td style="padding: 12px;">${(service.text || '---').substring(0, 60)}...</td>
                            <td style="padding: 12px;">
                                ${service.image_url
                                    ? `<img src="${service.image_url}" style="width: 40px; height: 40px; border-radius: 5px;">`
                                    : '---'}
                            </td>
                            <td style="padding: 12px;">
                                <button class="btn btn-sm btn-warning" style="margin-left: 3px;">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>`;
                });
            } else {
                html += `
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-light);">
                            <i class="fa-solid fa-inbox"></i> هیچ سرویسی یافت نشد
                        </td>
                    </tr>`;
            }

            html += '</tbody></table>';
            document.getElementById('pagesTable').innerHTML = html;
        })
        .catch(error => {
            document.getElementById('pagesTable').innerHTML = `
                <p style="text-align: center; padding: 40px; color: #ef4444;">
                    <i class="fa-solid fa-exclamation-triangle"></i> خطا در بارگذاری
                </p>`;
        });
}
</script>
@endsection
