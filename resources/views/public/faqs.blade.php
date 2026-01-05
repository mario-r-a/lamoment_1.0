@extends('layouts.mainlayout')

@section('title', 'FAQs - Lamoment')

@section('content')
<!-- Canvas Wave Text Animation -->
<div class="wave-text-container">
    <canvas id="waveCanvasFAQs"></canvas>
</div>

<!-- FAQs Content Section -->
<div class="container py-5 px-5">
    <!-- Header & Image Row -->
    <div class="row g-4 align-items-center mb-5">
        <!-- Left Column: Header -->
        <div class="col-lg-8">
            <h1 class="mb-3" style="font-family: 'Playfair Display', serif; color: var(--primary-maroon); font-size: 3rem; font-weight: 700;">
                Frequently Asked Questions
            </h1>
            <p class="mb-0" style="color: var(--text-dark); font-size: 1rem;">
                Browse our FAQs, and if you can't find the answer you're looking for <a href="{{ route('contact') }}" style="color: var(--primary-taupe); text-decoration: underline;">Contact us</a>.
            </p>
        </div>

        <!-- Right Column: Image -->
        <div class="col-lg-4 text-center">
            <img src="{{ asset('images/faqs/lamoment_illustration_6.webp') }}" 
                 alt="FAQ Illustration" 
                 class="img-fluid" 
                 style="max-width: 220px;">
        </div>
    </div>

    @php
        // Filter categories that have at least one active FAQ
        $visibleCategories = $categories->filter(function($category) {
            return $category->faqs->count() > 0;
        });
    @endphp

    @if($visibleCategories->isEmpty())
        <!-- No FAQs Available Message -->
        <div class="text-center py-5">
            <p class="lead" style="color: var(--text-dark); font-size: 1.25rem;">
                FAQs are currently unavailable. For further questions, please <a href="{{ route('contact') }}" style="color: var(--primary-taupe); text-decoration: underline; font-weight: 600;">Contact us</a>.
            </p>
        </div>
    @else
        <!-- FAQ Accordion by Category -->
        @foreach($visibleCategories as $category)
            <div class="faq-category-block mb-5">
                <!-- Category Title -->
                <h2 class="mb-4" style="font-family: 'PT Serif', serif; color: var(--text-dark); font-size: 1.5rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px;">
                    {{ $category->name }}
                </h2>

                <!-- FAQ Accordion -->
                <div class="accordion accordion-flush" id="accordion{{ $category->faq_category_id }}">
                    @foreach($category->faqs as $index => $faq)
                        <div class="accordion-item mb-2" style="border: none; border-bottom: 2px solid rgba(146, 116, 88, 0.5);">
                            <h3 class="accordion-header">
                                <button class="accordion-button collapsed" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#faq{{ $faq->faq_id }}" 
                                        aria-expanded="false" 
                                        aria-controls="faq{{ $faq->faq_id }}"
                                        style="font-family: 'PT Serif', serif; color: var(--text-dark); font-size: 1rem; background-color: transparent; border: none; padding: 1rem 0 1rem 3.5rem; box-shadow: none; position: relative; display: flex; align-items: center;">
                                    {{ $faq->question }}
                                </button>
                            </h3>
                            <div id="faq{{ $faq->faq_id }}" 
                                 class="accordion-collapse collapse" 
                                 data-bs-parent="#accordion{{ $category->faq_category_id }}">
                                <div class="accordion-body" style="font-family: 'PT Serif', serif; color: var(--text-dark); font-size: 0.95rem; line-height: 1.7; padding: 0 0 1rem 3.5rem; background-color: transparent;">
                                    {!! nl2br(e($faq->answer)) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif

    <!-- Book Now Button (Large) -->
    <div class="text-center mt-5 pt-4">
        <a href="{{ route('packages') }}" class="btn btn-lg px-5 py-3" style="background-color: var(--primary-maroon); color: var(--primary-beige); font-family: 'Playfair Display', serif; font-weight: 600; border-radius: 8px; font-size: 1.25rem;">
            Book Now
        </a>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Custom Accordion Styling - PERSIS seperti screenshot */
    .accordion-button {
        position: relative;
        background-color: transparent;
        box-shadow: none;
    }

    /* Left-side arrow (down when collapsed, up when expanded) */
    .accordion-button::after {
        content: "";
        display: block;
        position: absolute;
        left: 0.5rem;
        top: 50%;
        width: 20px;
        height: 20px;
        transform: translateY(-50%) rotate(0deg);
        transition: transform 0.18s ease;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23927458'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        pointer-events: none;
    }

    /* When expanded, rotate arrow 180deg to point up */
    .accordion-button:not(.collapsed)::after {
        transform: translateY(-50%) rotate(180deg);
    }

    .accordion-button:focus {
        box-shadow: none;
        border: none;
    }

    .accordion-item {
        background-color: transparent;
    }

    .accordion-button:hover {
        background-color: transparent;
    }

    /* Remove default accordion borders */
    .accordion-flush .accordion-item {
        border-right: 0;
        border-left: 0;
        border-radius: 0;
    }

    .accordion-flush .accordion-item:first-of-type {
        border-top: 0;
    }

    .accordion-flush .accordion-item:last-of-type {
        border-bottom: 0;
    }

    .accordion-flush .accordion-collapse {
        border-width: 0;
    }

    /* Increase spacing between categories so they're not too close */
    .faq-category-block {
        margin-bottom: 3.5rem; /* slightly larger than mb-5 */
        padding-bottom: 1.5rem; /* breathing room after last FAQ */
    }
</style>
@endsection

@section('scripts')
    <script src="{{ asset('js/wave-text-canvas.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('waveCanvasFAQs')) {
                new WaveTextAnimation('waveCanvasFAQs', "GET CLEAR   ", '#6f7b91');
            }

            // Ensure only one accordion is open at a time across all categories
            const accordions = document.querySelectorAll('.accordion-collapse');
            accordions.forEach(accordion => {
                accordion.addEventListener('show.bs.collapse', function () {
                    // Close all other accordions
                    accordions.forEach(otherAccordion => {
                        if (otherAccordion !== accordion && otherAccordion.classList.contains('show')) {
                            const bsCollapse = new bootstrap.Collapse(otherAccordion, {
                                toggle: false
                            });
                            bsCollapse.hide();
                        }
                    });
                });
            });
        });
    </script>
@endsection
