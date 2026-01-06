<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lamoment - Audio Guestbook Surabaya')</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Preload self-hosted fonts --}}
    <link rel="preload" href="{{ asset('fonts/Playfair_Display/PlayfairDisplay-VariableFont_wght.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/PT_Serif/PTSerif-Regular.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/PT_Serif/PTSerif-Bold.woff2') }}" as="font" type="font/woff2" crossorigin>

    {{-- CUSTOM CSS - Main entry point --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    {{-- Yield untuk CSS tambahan per-page --}}
    @yield('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    @include('layouts.navbar')

    <main class="shrink-0"> 
        @yield('content')
    </main>

    <div class="mt-auto"> 
        @include('layouts.footer')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Yield untuk script JS per-page --}}
    @yield('scripts')
</body>
</html>