@extends('layouts.mainlayout')

@section('title', 'Lamoment - Audio Guest Book Surabaya')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section -->
    <div class="row align-items-center hero-section" style="background-image: url('{{ asset('images/home/hero.jpg') }}'); background-size: cover; background-position: bottom center; min-height: 75vh;">
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

    <!-- Our Client Section (FULL WIDTH - no .container wrapper) -->
    <div class="our-client-section">
        <div class="container">
            <!-- "Our Client" Text -->
            <p class="our-client-text text-center">Our Client</p>
        </div>
        
        <!-- Logo Slider (extends beyond container for edge-to-edge) -->
        <div class="logo-slider-new">
            <div class="logo-slide-track-new">
                
                <!-- Container 1: White background (3 logos) -->
                <div class="logo-container bg-white">
                    <img src="{{ asset('images/home/logo-little_things.webp') }}" alt="Little Things">
                    <img src="{{ asset('images/home/logo-universitas_ciputra.webp') }}" alt="Universitas Ciputra">
                    <img src="{{ asset('images/home/logo-priscanara_organizer.webp') }}" alt="Priscanara Organizer">
                </div>

                <!-- Gap -->
                <div class="logo-gap"></div>

                <!-- Container 2: Black background (3 logos) -->
                <div class="logo-container bg-black">
                    <img src="{{ asset('images/home/logo-perfect_moment.webp') }}" alt="Perfect Moment">
                    <img src="{{ asset('images/home/logo-fairytale.webp') }}" alt="Fairytale">
                    <img src="{{ asset('images/home/logo-exquisite.webp') }}" alt="Exquisite">
                </div>

                <!-- Gap -->
                <div class="logo-gap"></div>

                <!-- Duplicate for seamless loop -->
                <div class="logo-container bg-white">
                    <img src="{{ asset('images/home/logo-little_things.webp') }}" alt="Little Things">
                    <img src="{{ asset('images/home/logo-universitas_ciputra.webp') }}" alt="Universitas Ciputra">
                    <img src="{{ asset('images/home/logo-priscanara_organizer.webp') }}" alt="Priscanara Organizer">
                </div>

                <!-- Gap -->
                <div class="logo-gap"></div>
                
                <div class="logo-container bg-black">
                    <img src="{{ asset('images/home/logo-perfect_moment.webp') }}" alt="Perfect Moment">
                    <img src="{{ asset('images/home/logo-fairytale.webp') }}" alt="Fairytale">
                    <img src="{{ asset('images/home/logo-exquisite.webp') }}" alt="Exquisite">
                </div>

                <!-- Gap -->
                <div class="logo-gap"></div>

            </div>
        </div>
    </div>

    <!-- Throw Out the Boring Guest Book Section -->
    <section class="container-fluid px-0 content-section-spacing">
        <div class="row align-items-center g-0">
            <div class="col-12 col-lg-6 py-5 px-5">
                <h2 class="mb-4">Throw Out the Boring Guest Book...</h2>
                <p class="lead">
                    There's a new way to capture messages from your loved ones. The Off The Hook Audio Guest Book will have your loved ones lining up to leave you voice messages so you can relive your wedding forever.
                </p>
            </div>
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

    <!-- How does it work? Section (Zigzag Layout) -->
    <section class="how-it-works-section">
        <div class="container">
            <!-- Section Title -->
            <h2 class="how-it-works-title text-center mb-5">How does it work?</h2>

            <!-- Zigzag Container (Relative Positioning) -->
            <div class="zigzag-container">
                
                <!-- Step 1: Top Left -->
                <div class="step-item step-1">
                    <img src="{{ asset('images/home/lamoment_illustration_2.webp') }}" alt="Book the phone" class="step-image">
                    <div class="step-number step-number-1">1</div>
                </div>
                <div class="step-text step-text-1">
                    <h3 class="step-heading">Book Off The Hook for your wedding.</h3>
                    <p class="step-content">Choose a phone colour that suits your styling, we'll ensure it arrives <strong>at least 3 days before</strong> your wedding. Set up with the included signage or make it your own.</p>
                </div>

                <!-- Step 2: Middle Right -->
                <div class="step-item step-2">
                    <img src="{{ asset('images/home/lamoment_illustration_3.webp') }}" alt="Leave voice messages" class="step-image">
                    <div class="step-number step-number-2">2</div>
                </div>
                <div class="step-text step-text-2">
                    <h3 class="step-heading">Your loved ones leave you voice messages.</h3>
                    <p class="step-content">They pick up the phone, hear your personalised greeting and speak from the heart. From sentimental to fun to downright hilarious, these moments will be with you for the rest of time.</p>
                </div>

                <!-- Step 3: Bottom Left -->
                <div class="step-item step-3">
                    <img src="{{ asset('images/home/lamoment_illustration_4.webp') }}" alt="Receive memories" class="step-image">
                    <div class="step-number step-number-3">3</div>
                </div>
                <div class="step-text step-text-3">
                    <h3 class="step-heading">You receive memories to cherish forever.</h3>
                    <p class="step-content">You send us the phone back in the 3 days after your wedding and receive your online voice message gallery within 48 hours. Download, listen and replay on every wedding anniversary. Make it extra special with an optional custom vinyl record or usb box.</p>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection