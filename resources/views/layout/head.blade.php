<head>
   <link rel="icon" type="image/x-icon" href="/img/mana.png">
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>
        {{ $siteTexts['footer_brand']->value ?? 'مانا' }} | راهکارهای هوشمند دیجیتال
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com" >
    <link
      href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{asset('bootstrap/bootstrap.min.css')}}">
    <script src="{{ asset('bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('alert/alert.js') }}"></script>
    <script src="{{ asset('js/alert.js') }}"></script>

    <link
      rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      />
    <link rel="stylesheet" href="/css/index.css" />
    <meta name="google-site-verification" content="SV1Ox0Izkm5EIZiqiZXR2VW_vC97bxoLqxV0nAhvdt8" />
     @yield('head')
</head>