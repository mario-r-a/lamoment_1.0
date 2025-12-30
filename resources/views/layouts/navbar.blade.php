<nav class="navbar navbar-expand-lg navbar-dark sticky-top navbar-custom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <img src="{{ asset('images/navbar/logo_lamoment_3e.png') }}" alt="Lamoment" height="40" class="d-inline-block align-text-top">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Semua item kanan: pages, lalu gap, lalu dashboard, lalu user -->
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Pages (sekarang berada di kanan, tapi sedikit memberi jarak ke kanan melalui margin) -->
                <li class="nav-item me-3">
                    <a class="nav-link @if (Route::is('home')) active @endif" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link @if (Route::is('packages')) active @endif" href="{{ route('packages') }}">Packages</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link @if (Route::is('faqs.public')) active @endif" href="{{ route('faqs.public') }}">FAQs</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link @if (Route::is('reviews')) active @endif" href="{{ route('reviews') }}">Reviews</a>
                </li>

                {{-- spacer lebih besar antara pages dan admin/dashboard --}}
                <li class="nav-item me-4 d-none d-lg-block" aria-hidden="true"></li>

                @auth
                    <!-- Dashboard (dekati sisi kanan) -->
                    <li class="nav-item me-3">
                        <a class="nav-link @if (Route::is('dashboard')) active @endif" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>

                    <!-- User Dropdown (paling kanan) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Form logout (hidden) -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <!-- Book Now Button (jika belum login) - tetap di kanan bersama pages -->
                    <li class="nav-item">
                        <a href="{{ route('packages') }}" class="btn btn-book-now btn-sm px-3 py-2">Book Now</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
