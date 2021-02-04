<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- <title>{{ config('app.name', 'Laman Kreasi') }}</title> --}}
    <title>@yield('title', 'Laman Kreasi')</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ url('') }}/assets/frontend/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/fancybox.min.css">
    
    <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/cubeportfolio.min.css">
    <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/dzsparallaxer.min.css">
    @stack('styles')
    <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/styles.css">
    <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/responsive.css">
    
    @livewireStyles
    
</head>
<body>
    
    @livewire('frontend.main.header')
   
        @yield('content')
        {{-- {{ $slot }} --}}
        
    {{-- @livewire('frontend.main.footerfile') --}}
    
    @stack('modals')
    <!-- Bootstrap JS -->
    <script src="{{ url('') }}/assets/frontend/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="{{ url('') }}/assets/frontend/js/jquery-migrate.min.js"></script>
    <script src="{{ url('') }}/assets/frontend/js/jquery-ui.min.js"></script>
    <script src="{{ url('') }}/assets/frontend/js/modernizr.min.js"></script>
    <script src="{{ url('') }}/assets/frontend/js/bootstrap.bundle.min.js"></script>
    
    <!-- Particles JS -->
    <script src="{{ url('') }}/assets/frontend/js/particles.min.js"></script>
    <script src="{{ url('') }}/assets/frontend/js/particle-active.js"></script>
    <script src="{{ url('') }}/assets/frontend/js/theme.js"></script>
    <script src="{{ url('') }}/assets/frontend/js/main.js"></script>
    
    @stack('scripts')
    @livewireScripts
</body>
</html>
