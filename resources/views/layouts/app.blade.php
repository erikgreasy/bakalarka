<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#2A464F">
    <link rel="apple-touch-icon" href="icon/maskable_icon_x192.png">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- SLICK -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
</head>
<body class="">
    @auth
        <header>
            <x-desktop_navbar></x-desktop_navbar>
        </header>
    @endauth
    <div id="app">
        
        <div>

            @yield('content')
        </div>
        @auth
            @include( 'partials.navigation' )
        @endauth
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
