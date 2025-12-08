<footer class="py-3" style="background-color: #f4e1d2;">
    <div class="container text-center">
        <!-- Social Media Icons -->
        <div class="mb-3">
            <a href="#" class="mx-3 text-dark">
                <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
            </a>
            <a href="#" class="mx-3 text-dark">
                <i class="bi bi-tiktok" style="font-size: 1.5rem;"></i>
            </a>
        </div>

        <!-- Footer Links -->
        <div class="mb-3">
            <a href="{{ route('home') }}" class="mx-2 text-dark">Home</a>
            <a href="{{ route('packages') }}" class="mx-2 text-dark">Book Now</a>
            <a href="{{ route('contact') }}" class="mx-2 text-dark">Contact Us</a>
            <a href="{{ route('reviews') }}" class="mx-2 text-dark">Reviews</a>
            <a href="{{ route('faqs') }}" class="mx-2 text-dark">FAQs</a>
        </div>

        <!-- Copyright -->
        <div class="mt-3">
            <p>&copy; {{ date('Y') }} Lamoment. All Rights Reserved.</p>
        </div>
    </div>
</footer>
