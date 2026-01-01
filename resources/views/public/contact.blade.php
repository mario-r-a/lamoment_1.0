@extends('layouts.mainlayout')

@section('title', 'Contact Us - Lamoment')

@section('content')
<!-- Canvas Wave Text Animation -->
<div class="wave-text-container">
    <canvas id="waveCanvas"></canvas>
</div>

<!-- Contact Content Section -->
<div class="container pt-5">
    <!-- Header & Image Row -->
    <div class="row g-4 align-items-start mb-5">
        <!-- Left Column: Header & Info -->
        <div class="col-lg-6">
            <h1 class="mb-3" style="color: var(--primary-maroon)">Contact Us</h1>
            <p class="lead mb-4" style="color: var(--text-dark);">We want to hear from you, contact us via any of the options below.</p>
            
            <!-- Contact Options List -->
            <ol class="mb-5" style="color: var(--text-dark);">
                <li class="mb-2">
                    Complete the contact form
                </li>
                <li class="mb-2">
                    Email us at
                    <a href="mailto:lamoment.idn@gmail.com" class="text-decoration-none" style="color: var(--primary-taupe);">
                        lamoment.idn@gmail.com
                    </a>
                </li>
                <li class="mb-2">
                    Call us at
                    <a href="tel:082318606525" class="text-decoration-none" style="color: var(--primary-taupe);">
                        0823-1860-6525
                    </a>
                </li>
            </ol>

            <!-- Contact Form (directly below the list) -->
            <div class="shadow-none border-0 bg-transparent">
                <div class="body p-0">
                    <h4 class="my-4" style="color: var(--primary-maroon); font-family: 'Playfair Display', serif;">
                        Contact Form
                    </h4>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf

                        <!-- Name Label -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Name <span class="text-danger">*</span>
                            </label>
                        </div>

                        <!-- First Name & Last Name (Side by Side) -->
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="first_name" class="form-label small" style="color: var(--primary-taupe);">First Name *</label>
                                <input 
                                    type="text" 
                                    name="first_name" 
                                    id="first_name" 
                                    value="{{ old('first_name') }}" 
                                    class="form-control @error('first_name') is-invalid @enderror" 
                                    required
                                >
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label small" style="color: var(--primary-taupe);">Last Name *</label>
                                <input 
                                    type="text" 
                                    name="last_name" 
                                    id="last_name" 
                                    value="{{ old('last_name') }}" 
                                    class="form-control @error('last_name') is-invalid @enderror" 
                                    required
                                >
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email') }}" 
                                class="form-control @error('email') is-invalid @enderror" 
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div class="mb-3">
                            <label for="subject" class="form-label fw-bold">
                                Subject <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="subject" 
                                id="subject" 
                                value="{{ old('subject') }}" 
                                class="form-control @error('subject') is-invalid @enderror" 
                                required
                            >
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="mb-4">
                            <label for="message" class="form-label fw-bold">
                                Message <span class="text-danger">*</span>
                            </label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="5" 
                                class="form-control @error('message') is-invalid @enderror" 
                                required
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="btn btn-send px-5 py-2">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Image -->
        <div class="col-lg-6">
            <div class="position-relative text-center">
                <img src="{{ asset('images/contact/foto_kontak_1.webp') }}"
                     alt="Vintage Phone Lamoment"
                     class="img-fluid rounded-4 shadow-sm img-frame" loading="lazy">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/wave-text-canvas.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('waveCanvas')) {
                new WaveTextAnimation('waveCanvas', "WE ARE HERE   ");
            }
        });
    </script>
@endsection
