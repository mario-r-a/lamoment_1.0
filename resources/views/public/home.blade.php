@extends('layouts.mainlayout')

@section('title', 'Lamoment - Audio Guest Book Surabaya')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section -->
    <div class="hero-section" style="background-image: url('{{ asset('images/home/hero.jpg') }}'); background-size: cover; background-position: bottom center;">
        <div class="row align-items-center h-100 g-0">
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
    </div>

    <!-- Our Client Section (FULL WIDTH - restructured) -->
    <div class="our-client-section">
        <!-- "Our Client" Text (beige background) -->
        <div class="our-client-text-container">
            <p class="our-client-text">Our Clients</p>
        </div>
        
        <!-- Logo Slider Container (taupe background with equal padding) -->
        <div class="logo-slider-container">
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
    </div>

    <!-- Throw Out the Boring Guest Book Section -->
    <section class="throw-out-section">
        <div class="container-fluid px-0">
            <div class="row align-items-center g-0">
                <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center py-5 px-5">
                    <div class="throw-out-content text-center">
                        <h2>It's Time for a Better<br>Guest Book...</h2>
                        <p class="lead">
                            There's a more meaningful way to capture messages from your loved ones. The La Moment Audio Guest Book invites them to leave heartfelt voice messages so you can relive your special moments forever.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-6 p-0" style="min-height: 400px;">
                    <div class="img_slider">
                        <figure>
                            <div class="my_slide">
                                <img src="{{ asset('images/home/lamoment_lg_1.webp') }}" alt="Audio Guest Book">
                            </div>
                            <div class="my_slide">
                                <img src="{{ asset('images/home/lamoment_lg_2.webp') }}" alt="Audio Guest Book">
                            </div>
                            <div class="my_slide">
                                <img src="{{ asset('images/home/lamoment_lg_3.webp') }}" alt="Audio Guest Book">
                            </div>
                            <div class="my_slide">
                                <img src="{{ asset('images/home/lamoment_lg_4.webp') }}" alt="Audio Guest Book">
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How does it work? Section -->
    <section class="how-it-works-section">
        <div class="container">
            <h2 class="how-it-works-title text-center">How does it work?</h2>

            <div class="how-it-works-grid">
                <!-- Step 1 -->
                <div class="hiw-step hiw-step-1">
                    <div class="hiw-img-wrap">
                        <img src="{{ asset('images/home/lamoment_illustration_2.webp') }}" alt="Book the phone">
                        <div class="hiw-badge hiw-badge-1">1</div>
                    </div>
                    <div class="hiw-text">
                        <h3>Book La Moment for Your Event.</h3>
                        <p>Choose a package that suits your styling. For personalised customisation, simply contact us. We're happy to tailor the experience just for you.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="hiw-step hiw-step-2">
                    <div class="hiw-img-wrap">
                        <img src="{{ asset('images/home/lamoment_illustration_3.webp') }}" alt="Leave voice messages">
                        <div class="hiw-badge hiw-badge-2">2</div>
                    </div>
                    <div class="hiw-text">
                        <h3>We Take Care of Everything.</h3>
                        <p>The La Moment Audio Guest Book comes complete with a dedicated team and a fully styled setup, ready to serve your guests throughout your event. All phone decoration and setup elements are prepared, so you can enjoy the moment stress-free.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="hiw-step hiw-step-3">
                    <div class="hiw-img-wrap">
                        <img src="{{ asset('images/home/lamoment_illustration_4.webp') }}" alt="Receive memories">
                        <div class="hiw-badge hiw-badge-3">3</div>
                    </div>
                    <div class="hiw-text">
                        <h3>Relive Your Memories, Anytime.</h3>
                        <p>Your guests' voice messages are professionally edited and delivered as MP3 audio files and an MP4 highlight video via Google Drive within 5-7 days after your event.<br>For a more meaningful keepsake, elevate your experience with our personalised Retro Custom Package, exclusive to the Premium package.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trusted By / Reviews Section -->
    @if($fiveStarReviews->count() >= 2)
    <section class="trusted-section">
        <div class="container">
            <div class="trusted-content">
                <div class="trusted-left">
                    <h2 class="trusted-title">
                        Trusted by <span class="highlight">100+</span> couples across Indonesia
                    </h2>
                    <a href="{{ route('reviews') }}" class="trusted-btn">Read More Reviews</a>
                </div>

                <div class="trusted-right">
                    <button class="carousel-nav-btn prev" id="reviewsPrev">
                        <i class="bi bi-chevron-left"></i>
                    </button>

                    <div class="reviews-track" id="reviewsTrack">
                        @foreach($fiveStarReviews as $review)
                            @php
                                $colorIndex = crc32($review->name) % count($avatarColors);
                                $avatarColor = $avatarColors[$colorIndex];
                            @endphp
                            <div class="review-card-home">
                                <div class="avatar" style="background-color: {{ $avatarColor }};">
                                    {{ strtoupper(substr($review->name, 0, 1)) }}
                                </div>
                                <div class="name">{{ $review->name }}</div>
                                <div class="date">{{ $review->date->diffForHumans() }}</div>
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <p class="content">{{ $review->content }}</p>
                                <a href="{{ route('reviews') }}" class="read-all">Read All Reviews</a>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-nav-btn next" id="reviewsNext">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- What Makes Us Different Section -->
    <section class="what-different-section">
        <div class="container">
            <h2 class="what-different-title">What makes us different?</h2>

            <div class="row g-4 mb-4">
                <div class="col-12 col-md-4">
                    <div class="what-different-item">
                        <div class="icon-wrap">
                            <img src="{{ asset('images/home/icon-vip.svg') }}" alt="VIP">
                        </div>
                        <div>
                            <h4>We'll Take Care of Your Guests</h4>
                            <p>Our team will be on hand to assist your guests with the audio guest book, so everything runs smoothly without you having to worry.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="what-different-item">
                        <div class="icon-wrap">
                            <img src="{{ asset('images/home/icon-no-cords.svg') }}" alt="No Cords">
                        </div>
                        <div>
                            <h4>No Cables to Disrupt Your Styling</h4>
                            <p>A clean, cordless design with an internal battery so there are no messy cables or power banks in sight.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="what-different-item">
                        <div class="icon-wrap">
                            <img src="{{ asset('images/home/icon-colour.svg') }}" alt="Colour Options">
                        </div>
                        <div>
                            <h4>Designed to Match Your Style</h4>
                            <p>With a range of design options available, you can choose a guest book setup that complements your styling and feels right for your celebration.</p>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('packages') }}" class="btn btn-book-now">Book Now</a>
        </div>
    </section>

    <!-- With You Every Step Section -->
    <section class="with-you-section">
        <div class="container-fluid px-0">
            <div class="row g-0 align-items-stretch">
                <div class="col-12 col-lg-6">
                    <img src="{{ asset('images/home/lamoment_sm_1.webp') }}" alt="With You Every Step" class="with-you-image">
                </div>
                <div class="col-12 col-lg-6 d-flex">
                    <div class="with-you-content">
                        <h2>With You Along the Way</h2>
                        <p>We're happy to support your celebration and be part of your special moments. We'll be with you along the way, offering the support you need so you can enjoy the experience as it unfolds.</p>
                        <p>Drop us a chat or give us a call - 7 days a week.</p>
                        <div class="d-flex gap-3 mt-3 flex-wrap justify-content-center">
                            <a href="{{ route('packages') }}" class="btn btn-book-now">Book Now</a>
                            <a href="{{ route('contact') }}" class="btn-outline-taupe px-4 py-2">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Any Questions / FAQ Preview Section -->
    @if($previewFaqs->count() >= 3)
    <section class="faq-preview-section">
        <div class="container">
            <h2 class="faq-preview-title">Any Questions?</h2>

            <div class="mx-auto" style="max-width: 700px;">
                <div class="accordion" id="faqPreviewAccordion">
                    @foreach($previewFaqs as $index => $faq)
                        <div class="faq-preview-item">
                            <button class="faq-preview-question collapsed" type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#faqPreview{{ $index }}" 
                                    aria-expanded="false">
                                <i class="bi bi-chevron-down"></i>
                                <span>{{ $faq->question }}</span>
                            </button>
                            <div id="faqPreview{{ $index }}" class="collapse" data-bs-parent="#faqPreviewAccordion">
                                <div class="faq-preview-answer">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex gap-3 mt-4 justify-content-center flex-wrap">
                    <a href="{{ route('packages') }}" class="btn btn-book-now px-5">Book Now</a>
                    <a href="{{ route('faqs.public') }}" class="btn-outline-taupe px-5 py-2">Read FAQs</a>
                </div>
            </div>
        </div>
    </section>
    @endif

</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('reviewsTrack');
    const prevBtn = document.getElementById('reviewsPrev');
    const nextBtn = document.getElementById('reviewsNext');

    if (!track || !prevBtn || !nextBtn) return;

    const cards = track.querySelectorAll('.review-card-home');
    const totalCards = cards.length;
    
    let currentIndex = 0;
    let autoSlideInterval;

    // Get cards per view
    function getCardsPerView() {
        return window.innerWidth >= 992 ? 2 : 1;
    }

    // Calculate and slide
    function slide() {
        const cardsPerView = getCardsPerView();
        const container = track.parentElement;
        const containerWidth = container.offsetWidth;
        
        // Set card width based on container
        cards.forEach(card => {
            if (cardsPerView === 1) {
                // Mobile: full container width
                card.style.width = containerWidth + 'px';
            } else {
                // Desktop: half container width minus gap
                card.style.width = 'calc(50% - 0.75rem)';
            }
        });
        
        // Calculate offset
        const gap = cardsPerView === 1 ? 0 : 24; // 1.5rem = 24px
        let offset = 0;
        
        for (let i = 0; i < currentIndex; i++) {
            offset += cards[i].offsetWidth + gap;
        }
        
        track.style.transform = `translateX(-${offset}px)`;
    }

    function next() {
        const cardsPerView = getCardsPerView();
        const maxIndex = totalCards - cardsPerView;
        
        currentIndex++;
        if (currentIndex > maxIndex) {
            currentIndex = 0;
        }
        slide();
    }

    function prev() {
        const cardsPerView = getCardsPerView();
        const maxIndex = totalCards - cardsPerView;
        
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = maxIndex;
        }
        slide();
    }

    function startAuto() {
        autoSlideInterval = setInterval(next, 3000);
    }

    function stopAuto() {
        clearInterval(autoSlideInterval);
    }

    // Event listeners
    nextBtn.addEventListener('click', function() {
        stopAuto();
        next();
        startAuto();
    });

    prevBtn.addEventListener('click', function() {
        stopAuto();
        prev();
        startAuto();
    });

    // Handle resize
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            currentIndex = 0;
            slide();
        }, 100);
    });

    // Pause on hover
    track.addEventListener('mouseenter', stopAuto);
    track.addEventListener('mouseleave', startAuto);

    // Initial setup
    slide();
    startAuto();
});
</script>
@endsection