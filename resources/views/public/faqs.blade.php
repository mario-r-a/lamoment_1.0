@extends('layouts.mainlayout')

@section('title', 'Contact Us - Lamoment')

@section('content')
<!-- Canvas Wave Text Animation -->
<div class="wave-text-container">
    <canvas id="waveCanvasFAQs"></canvas>
</div>

<!-- Contact Content Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="text-center mb-4">Get In Touch</h2>
            <p class="text-center lead mb-5">Have questions about our audio guest book? We'd love to hear from you!</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/wave-text-canvas.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (document.getElementById('waveCanvasFAQs')) {
                new WaveTextAnimation('waveCanvasFAQs', "GET CLEAR   ", '#6f7b91');
            }
        });
    </script>
@endsection
