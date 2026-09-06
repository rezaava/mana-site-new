<!DOCTYPE html>
<html lang="fa" dir="rtl">
@include('layout.head')

<body>
    <div class="cur-dot" id="curDot"></div>
    <div class="cur-ring" id="curRing"></div>

    <div class="scroll-progress" id="scrollProgress"></div>
    @include('layout.header')
    @yield('main')
    @include('layout.footer')
    @yield('js')
</body>
</html>