@extends('layouts.mainlayout')

@section('title', 'Lamoment - Audio Guest Book Surabaya')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section -->
    <div class="row align-items-center hero-section" style="background-image: url('{{ asset('images/home/hero.jpg') }}'); background-size: cover; background-position: bottom center; min-height: 75vh;">

        <!-- Left Side (Text and Button) -->
        <div class="col-12 col-md-6 text-white p-5">
            <h1 class="display-4 font-weight-bold mb-4">
                Audio Guest Books for Unforgettable Moments.
            </h1>
            <p class="lead mb-4">
                Capture voice messages from your loved ones on a retro phone.
            </p>
            <a href="{{ route('packages') }}" class="btn btn-book-now btn-lg">Book Now</a>
        </div>
    </div>

    <!-- Featured Brands -->
    <div class="logo-slider">
        <div class="logo-slide-track">

            <!-- Daftar logo -->
            <img src="{{ asset('images/home/logo_test.png') }}" alt="">
            <img src="{{ asset('images/home/logo_test.png') }}" alt="">
            <img src="{{ asset('images/home/logo_test.png') }}" alt="">
            <img src="{{ asset('images/home/logo_test.png') }}" alt="">
            <img src="{{ asset('images/home/logo_test.png') }}" alt="">

            <!-- Duplicate list (untuk infinite looping) -->
            <img src="{{ asset('images/home/logo_test.png') }}" alt="">
            <img src="{{ asset('images/home/logo_test.png') }}" alt="">
            <img src="{{ asset('images/home/logo_test.png') }}" alt="">
            <img src="{{ asset('images/home/logo_test.png') }}" alt="">
            <img src="{{ asset('images/home/logo_test.png') }}" alt="">

        </div>
    </div>

    <!-- NEW: Hero section setelah featured brands -->
    <section class="container py-5">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <h2 class="display-4 font-retro mb-4">Throw out the boring guestbook...</h2>
                <p class="lead mb-4">
                    There's a new way to capture messages from your loved ones. The Off The Hook Audio Guest Book will have your loved ones lining up to leave you voice messages so you can relive your wedding forever.
                </p>
            </div>

            <div class="col-12 col-md-6 text-center">
                <img src="{{ asset('images/home/phone.png') }}" alt="Audio Guest Book" class="img-fluid rounded shadow" style="max-width: 90%;">
            </div>
        </div>
    </section>
</div>
@endsection
