<footer class="py-5" style="background-color: var(--primary-beige);">
    <div class="container">
        <div class="row" style="min-height: 208px;">
            <!-- Left Column: Navigation Links -->
            <div class="col-12 col-md-4 d-flex flex-column justify-content-start">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3"><a href="{{ route('home') }}" class="text-decoration-underline" style="color: var(--primary-maroon);">Home</a></li>
                    <li class="mb-3"><a href="{{ route('packages') }}" class="text-decoration-underline" style="color: var(--primary-maroon);">Book Now</a></li>
                    <li class="mb-3"><a href="{{ route('faqs.public') }}" class="text-decoration-underline" style="color: var(--primary-maroon);">FAQs</a></li>
                    <li class="mb-3"><a href="{{ route('reviews') }}" class="text-decoration-underline" style="color: var(--primary-maroon);">Reviews</a></li>
                    <li class="mb-3"><a href="{{ route('contact') }}" class="text-decoration-underline" style="color: var(--primary-maroon);">Contact Us</a></li>
                </ul>
            </div>

            <!-- Center Column: Logo -->
            <div class="col-12 col-md-4 text-center d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/navbar/logo_lamoment_1b.png') }}" alt="Lamoment" style="height: 180px; width: auto;" class="img-fluid">
            </div>

            <!-- Right Column: Social Media & Copyright -->
            <div class="col-12 col-md-4 d-flex flex-column justify-content-start align-items-end">
                <!-- Social Media Icons (Top Right) -->
                <div class="mb-4">
                    <a href="https://www.instagram.com/lamoment.id/" target="_blank" rel="noopener noreferrer" class="text-decoration-none me-3" style="color: var(--primary-maroon);">
                        <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
                    </a>
                    <a href="https://www.tiktok.com/@la.moment" target="_blank" rel="noopener noreferrer" class="text-decoration-none" style="color: var(--primary-maroon);">
                        <i class="bi bi-tiktok" style="font-size: 1.5rem;"></i>
                    </a>
                </div>

                <!-- Spacer to push copyright to same level as last link -->
                <div style="flex-grow: 1;"></div>

                <!-- Copyright (Bottom Right - aligned with FAQs link) -->
                <div class="text-end">
                    <p class="mb-3 small" style="color: var(--primary-maroon);">&copy; {{ date('Y') }} Lamoment. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
