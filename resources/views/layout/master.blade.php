<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('layout.head')
<body>
    @include('layout.header')
    <div class="header-spacer"></div>
    <div class="dashboard-wrapper">
        <div class="main-content">
            <div class="empty-content">
                @yield('mohtava')
            </div>
            @include('layout.footer')
        </div>
    </div>
</body>
</html>