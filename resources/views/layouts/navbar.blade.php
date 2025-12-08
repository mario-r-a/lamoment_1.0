<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color: #f4e1d2;">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}" style="color: #b4472c;">Lamoment</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link @if(Route::is('home')) active @endif" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if(Route::is('packages')) active @endif" href="{{ route('packages') }}">Packages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if(Route::is('faqs')) active @endif" href="{{ route('faqs') }}">FAQs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if(Route::is('reviews')) active @endif" href="{{ route('reviews') }}">Reviews</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('packages') }}" class="btn btn-warning text-white">Book Now</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
