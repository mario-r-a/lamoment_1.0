@extends('layouts.mainlayout')

@section('title', 'Cek Tarif Tol - Lamoment')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- Header Section --}}
            <div class="text-center mb-5">
                <h1 class="h3 mb-3" style="font-family: 'Playfair Display', serif; color: var(--primary-maroon); font-size: 2.5rem; font-weight: 700;">
                    Cek Tarif Tol
                </h1>
                <p class="lead" style="color: var(--text-dark); font-family: 'PT Serif', serif; font-size: 0.95rem;">
                    Hitung tarif tol dari lokasi asal ke lokasi tujuan menggunakan Google Routes API.
                </p>
            </div>

            {{-- Form Card --}}
            <div class="card shadow-sm" style="border-radius: 12px; border: none;">
                <div class="card-body p-5">
                    {{-- Error Messages --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                            <strong><i class="bi bi-exclamation-circle me-2"></i>Validasi Gagal</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Form Input --}}
                    <form method="POST" action="{{ route('admin.toll.calculate') }}" novalidate>
                        @csrf

                        {{-- Alamat Asal --}}
                        <div class="mb-4">
                            <label for="origin" class="form-label fw-bold" style="color: var(--primary-maroon); font-family: 'PT Serif', serif;">
                                Alamat Asal <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('origin') is-invalid @enderror" 
                                   id="origin" 
                                   name="origin" 
                                   placeholder="Contoh: Jakarta, Indonesia" 
                                   value="{{ old('origin') }}" 
                                   style="border-radius: 8px; padding: 0.75rem 1rem; font-family: 'PT Serif', serif;"
                                   required>
                            @error('origin')
                                <div class="invalid-feedback" style="display: block;">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Alamat Tujuan --}}
                        <div class="mb-4">
                            <label for="destination" class="form-label fw-bold" style="color: var(--primary-maroon); font-family: 'PT Serif', serif;">
                                Alamat Tujuan <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('destination') is-invalid @enderror" 
                                   id="destination" 
                                   name="destination" 
                                   placeholder="Contoh: Surabaya, Indonesia" 
                                   value="{{ old('destination') }}" 
                                   style="border-radius: 8px; padding: 0.75rem 1rem; font-family: 'PT Serif', serif;"
                                   required>
                            @error('destination')
                                <div class="invalid-feedback" style="display: block;">
                                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" 
                                class="btn w-100" 
                                style="background-color: var(--primary-maroon); color: var(--primary-beige); font-family: 'Playfair Display', serif; font-weight: 600; border-radius: 8px; padding: 0.75rem; font-size: 1rem; transition: all 0.2s ease;"
                                onmouseover="this.style.backgroundColor='var(--primary-maroon-dark)'; this.style.transform='translateY(-2px)';"
                                onmouseout="this.style.backgroundColor='var(--primary-maroon)'; this.style.transform='translateY(0)';">
                            <i class="bi bi-search me-2"></i>Cek Harga Tol
                        </button>
                    </form>

                    {{-- Display Result --}}
                    @if (session('toll_result'))
                        @php
                            $result = session('toll_result');
                        @endphp

                        <hr class="my-5" style="border-color: rgba(146, 116, 88, 0.2);">

                        {{-- Result Alert --}}
                        <div class="alert {{ $result['success'] ? 'alert-success' : 'alert-info' }} alert-dismissible fade show" 
                             role="alert" 
                             style="border-radius: 8px; border: 1px solid {{ $result['success'] ? '#34A853' : '#1F97D9' }};">
                            
                            <h5 class="alert-heading" style="font-family: 'Playfair Display', serif; font-weight: 700; color: {{ $result['success'] ? '#34A853' : '#1F97D9' }};">
                                <i class="bi {{ $result['success'] ? 'bi-check-circle-fill' : 'bi-info-circle-fill' }} me-2"></i>
                                {{ $result['message'] }}
                            </h5>

                            @if ($result['success'] && $result['data'])
                                <hr style="border-color: rgba(0,0,0,0.1); margin: 1rem 0;">

                                <div class="row g-3">
                                    {{-- Jarak --}}
                                    <div class="col-md-6">
                                        <div class="bg-light p-3" style="border-radius: 8px; border-left: 4px solid var(--primary-taupe);">
                                            <p class="text-muted small mb-1" style="font-family: 'PT Serif', serif;">Jarak Tempuh</p>
                                            <p class="mb-0" style="font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; color: var(--primary-maroon);">
                                                {{ number_format($result['data']['distance'] / 1000, 2) }} <span style="font-size: 0.8rem;">km</span>
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Durasi --}}
                                    <div class="col-md-6">
                                        <div class="bg-light p-3" style="border-radius: 8px; border-left: 4px solid var(--primary-taupe);">
                                            <p class="text-muted small mb-1" style="font-family: 'PT Serif', serif;">Durasi Perjalanan</p>
                                            <p class="mb-0" style="font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 700; color: var(--primary-maroon);">
                                                {{ gmdate('H:i:s', (int) filter_var($result['data']['duration'], FILTER_SANITIZE_NUMBER_INT)) }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Tarif Tol --}}
                                    <div class="col-12">
                                        @if ($result['data']['toll_price'])
                                            <div class="bg-light p-4" style="border-radius: 8px; border-left: 4px solid var(--primary-taupe); text-align: center;">
                                                <p class="text-muted small mb-2" style="font-family: 'PT Serif', serif;">Estimasi Tarif Tol</p>
                                                <p class="mb-0" style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: var(--primary-maroon);">
                                                    {{ $result['data']['currency'] }} {{ number_format($result['data']['toll_price'], 0, ',', '.') }}
                                                </p>
                                            </div>
                                        @else
                                            <div class="bg-light p-4" style="border-radius: 8px; border-left: 4px solid #FFC107; text-align: center;">
                                                <p class="mb-0 text-muted" style="font-family: 'PT Serif', serif;">
                                                    <i class="bi bi-info-circle me-2"></i>
                                                    Tarif tol tidak tersedia (rute tanpa tol atau data Google belum terupdate)
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Back Button --}}
            <div class="mt-4">
                <a href="{{ route('dashboard') }}" 
                   class="btn btn-outline-secondary" 
                   style="border-color: var(--primary-taupe); color: var(--primary-taupe); font-family: 'PT Serif', serif; border-radius: 8px; transition: all 0.2s ease;"
                   onmouseover="this.style.backgroundColor='var(--primary-taupe)'; this.style.color='var(--primary-beige)';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--primary-taupe)';">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection