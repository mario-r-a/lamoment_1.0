@extends('layouts.mainlayout')

@section('title', 'Lamoment - Audio Guest Book Surabaya')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section -->
    <div class="row">
        <!-- Left Side (Text and Button) -->
        <div class="col-12 col-md-6 d-flex flex-column justify-center align-items-start text-white p-5">
            <h1 class="display-4 font-weight-bold mb-4">
                Audio Guest Books for Unforgettable Weddings.
            </h1>
            <p class="lead mb-4">
                Capture voice messages from your loved ones on a retro phone.
            </p>
            <a href="#book-now" class="btn btn-lg btn-warning text-white font-weight-bold">
                Book Now
            </a>
        </div>

        <!-- Right Side (Hero Image) -->
        <div class="col-12 col-md-6 p-0">
            <img src="{{ asset('images/home/hero.jpg') }}" alt="Hero Image" class="w-100 h-100 object-cover" />
        </div>
    </div>

    <!-- Featured Brands -->
    <div class="mt-5 text-center">
        <div class="d-flex justify-content-center">
            <img src="https://via.placeholder.com/120" alt="Brand logo" class="h-12 mx-3" />
            <img src="https://via.placeholder.com/120" alt="Brand logo" class="h-12 mx-3" />
            <img src="https://via.placeholder.com/120" alt="Brand logo" class="h-12 mx-3" />
            <img src="https://via.placeholder.com/120" alt="Brand logo" class="h-12 mx-3" />
            <img src="https://via.placeholder.com/120" alt="Brand logo" class="h-12 mx-3" />
        </div>
    </div>
</div>
@endsection
