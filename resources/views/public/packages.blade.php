@extends('layouts.mainlayout')

@section('title', 'Packages - Lamoment')

@section('content')
<div class="container-fluid px-0">
    <div class="container py-5">
        {{-- Header Section --}}
        <div class="text-center mb-5">
            <h1 class="mb-4" style="font-family: 'Playfair Display', serif; color: var(--primary-maroon); font-size: 3.5rem; font-weight: var(--playfair-weight);">
                Book La Moment
            </h1>
            <p class="lead" style="color: var(--text-dark); max-width: 700px; margin: 0 auto; font-size: 0.95rem;">
                Don't compromise on your special celebrations. Enjoy a VIP experience with our fully inclusive package.
            </p>
        </div>

        {{-- "YOUR HIRE INCLUDES:" Title (Full Width Center) --}}
        <div class="text-center mb-4">
            <h2 style="font-family: 'PT Serif', serif; color: var(--primary-taupe); font-size: 1.75rem; font-weight: 700;">
                YOUR HIRE INCLUDES:
            </h2>
        </div>

        {{-- Package Includes Section --}}
        <div class="row mb-3 g-2 align-items-center justify-content-center">
            {{-- Left: Phone Image --}}
            <div class="col-12 col-lg-4 text-center">
                <img src="{{ asset('images/packages/lamoment_illustration_5.webp') }}" 
                     alt="La Moment Audio Guest Book" 
                     class="img-fluid" 
                     style="max-width: 350px;">
            </div>

            {{-- Right: Includes List --}}
            <div class="col-12 col-lg-4">
                <ul class="list-unstyled" style="font-family: 'PT Serif', serif; color: var(--text-dark); font-size: 1rem;">
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-plus-lg me-3" style="color: var(--primary-taupe); font-size: 1.5rem; flex-shrink: 0; line-height: 1;"></i>
                        <span>La Moment Audio Guest Book</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-plus-lg me-3" style="color: var(--primary-taupe); font-size: 1.5rem; flex-shrink: 0; line-height: 1;"></i>
                        <span>Custom Audio Greeting, Personalised for Your Event</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-plus-lg me-3" style="color: var(--primary-taupe); font-size: 1.5rem; flex-shrink: 0; line-height: 1;"></i>
                        <span>On-Site Crew Support (Up to 3 Hours)</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-plus-lg me-3" style="color: var(--primary-taupe); font-size: 1.5rem; flex-shrink: 0; line-height: 1;"></i>
                        <span>Styled Setup & Decoration Included</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-plus-lg me-3" style="color: var(--primary-taupe); font-size: 1.5rem; flex-shrink: 0; line-height: 1;"></i>
                        <span>High-Quality MP3 Audio Files via Google Drive</span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="bi bi-plus-lg me-3" style="color: var(--primary-taupe); font-size: 1.5rem; flex-shrink: 0; line-height: 1;"></i>
                        <span>Edited Highlight Video (MP4) Included</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Select Your Date Section (Full Width Background) --}}
    <div class="py-5" style="background-color: var(--primary-taupe); width: 100%;">
        <div class="container">
            <h2 class="text-center mb-4" style="font-family: 'PT Serif', serif; color: var(--primary-beige); font-size: 2.5rem; font-weight: 700; letter-spacing: 1px;">
                SELECT YOUR DATE
            </h2>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-5">
                    <div class="mb-4 d-flex justify-content-center">
                        <input type="date" 
                               class="form-control" 
                               id="eventDate"
                               placeholder="Event Date"
                               style="border-radius: 8px; padding: 0.65rem 1rem; max-width: 250px; font-size: 0.95rem;">
                    </div>

                    <div class="text-center">
                        <p class="mb-0" style="color: var(--primary-beige); font-family: 'PT Serif', serif; font-size: 1rem;">
                            Select the date your event is on. Need help for your order?<br><a href="{{ route('contact') }}" style="color: var(--primary-beige); text-decoration: underline; font-weight: 600;">Contact us</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Available Packages --}}
    <div class="container py-5">
        @if($packages->count() > 0)
        <div>
            <h2 class="text-center mb-3" style="font-family: 'PT Serif', serif; color: var(--primary-maroon); font-size: 2.5rem; font-weight: 700; letter-spacing: 1px;">
                CHOOSE YOUR STYLE
            </h2>
            <div class="text-center mb-4">
                <p class="mb-0" style="color: var(--text-dark); font-family: 'PT Serif', serif; font-size: 1rem;">
                    Read details in each package, <a href="{{ route('contact') }}" style="color: var(--primary-taupe); text-decoration: underline;">Contact us</a> for more information
                </p>
            </div>

            <div class="row g-4">
                @foreach($packages as $package)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                        {{-- Package Image --}}
                        @if($package->has_image)
                            <img src="{{ $package->image_url }}" 
                                 class="card-img-top" 
                                 alt="{{ $package->name }}"
                                 style="height: 250px; object-fit: cover;">
                        @endif

                        <div class="card-body p-4">
                            <h3 class="card-title mb-3" style="font-family: 'Playfair Display', serif; color: var(--primary-maroon); font-size: 1.75rem;">
                                {{ $package->name }}
                            </h3>
                            
                            @if($package->description)
                            <p class="card-text mb-4" style="font-family: 'PT Serif', serif; color: var(--text-dark); font-size: 0.95rem;">
                                {{ $package->description }}
                            </p>
                            @endif

                            <div class="mb-4">
                                <span class="h3 mb-0" style="font-family: 'Playfair Display', serif; color: var(--primary-taupe);">
                                    Rp {{ number_format($package->base_price, 0, ',', '.') }}
                                </span>
                            </div>

                            @if($package->items->count() > 0)
                            <ul class="list-unstyled mb-4" style="font-family: 'PT Serif', serif; color: var(--text-dark); font-size: 0.95rem;">
                                @foreach($package->items as $item)
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill me-2" style="color: var(--primary-taupe);"></i>
                                    {{ $item->name }}
                                    @if($item->quantity > 1)
                                        <small class="text-muted">({{ $item->quantity }}x)</small>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            @endif

                            <button class="btn w-100 book-now-btn" 
                                    data-package-name="{{ $package->name }}"
                                    data-whatsapp="{{ $whatsappNumber }}"
                                    style="background-color: var(--primary-maroon); color: var(--primary-beige); font-family: 'Playfair Display', serif; font-weight: 600; border-radius: 8px; padding: 0.75rem;">
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="py-5 text-center">
            <p class="lead" style="color: var(--text-dark);">No packages available at the moment. Please check back later or <a href="{{ route('contact') }}">contact us</a> for custom packages.</p>
        </div>
        @endif
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('eventDate');
    const bookNowButtons = document.querySelectorAll('.book-now-btn');

    // Set min date to today & placeholder
    if (dateInput) {
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        const minDate = `${year}-${month}-${day}`;
        
        dateInput.setAttribute('min', minDate);
        dateInput.setAttribute('placeholder', 'Event Date');
        dateInput.style.color = '#927458';
    }

    // Handle Book Now button clicks
    bookNowButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            const packageName = this.getAttribute('data-package-name');
            const whatsappNumber = this.getAttribute('data-whatsapp');
            const selectedDate = dateInput.value;

            // Validasi: Date WAJIB diisi
            if (!selectedDate) {
                alert('Please select your event date before booking.');
                dateInput.focus();
                return;
            }

            // Format date ke bahasa Indonesia (DD Month YYYY)
            const dateObj = new Date(selectedDate);
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            const formattedDate = dateObj.toLocaleDateString('id-ID', options);

            // Template message untuk WhatsApp
            const message = `Halo La Moment, saya ingin bertanya lebih lanjut tentang paket ${packageName} untuk tanggal ${formattedDate}.`;

            // Encode message untuk URL
            const encodedMessage = encodeURIComponent(message);

            // Redirect ke WhatsApp dengan pre-filled message
            const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;
            window.open(whatsappUrl, '_blank');
        });
    });
});
</script>
@endsection
@endsection