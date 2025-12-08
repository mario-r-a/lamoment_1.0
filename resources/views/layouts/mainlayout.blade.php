<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lamoment - Audio Guestbook Surabaya')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    {{-- Menambahkan yield untuk CSS atau meta tag tambahan (Ideal Inheritance) --}}
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Menambahkan yield untuk skrip JS spesifik halaman (Ideal Inheritance) --}}
    @yield('scripts')
</body>
</html>