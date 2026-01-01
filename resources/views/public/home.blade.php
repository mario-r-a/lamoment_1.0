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

    <!-- Content Section dengan Auto-Rotating Image Carousel -->
    <section class="container-fluid px-0">
        <div class="row align-items-center g-0">
            <!-- Left-Text -->
            <div class="col-12 col-lg-6 py-5 px-5">
                <h2 class="mb-4">Throw Out the Boring Guest Book...</h2>
                <p class="lead">
                    There's a new way to capture messages from your loved ones. The Off The Hook Audio Guest Book will have your loved ones lining up to leave you voice messages so you can relive your wedding forever.
                </p>
            </div>

            <!-- Right-Image -->
            <div class="col-12 col-lg-6 p-0" style="min-height: 400px;">
                <div class="img_slider">
                    <figure>
                        <div class="my_slide">
                            <img src="{{ asset('images/home/hero.jpg') }}" alt="Audio Guest Book" class="w-100 h-100">
                        </div>
                        <div class="my_slide">
                            <img src="{{ asset('images/home/hero.jpg') }}" alt="Audio Guest Book" class="w-100 h-100">
                        </div>
                        <div class="my_slide">
                            <img src="{{ asset('images/home/hero.jpg') }}" alt="Audio Guest Book" class="w-100 h-100">
                        </div>
                        <div class="my_slide">
                            <img src="{{ asset('images/home/hero.jpg') }}" alt="Audio Guest Book" class="w-100 h-100">
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </section>

    
</div>
@endsection