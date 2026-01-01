@extends('layouts.mainlayout')

@section('title', 'Cek Tarif Tol - Lamoment')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-geo-alt-fill me-2"></i>Cek Tarif Tol</h4>
                </div>
                <div class="card-body">
                    {{-- Error Messages --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form Input --}}
                    <form method="POST" action="{{ route('admin.toll.calculate') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="origin" class="form-label">Alamat Asal</label>
                            <input type="text" class="form-control @error('origin') is-invalid @enderror" 
                                   id="origin" name="origin" 
                                   placeholder="Contoh: New York, NY" 
                                   value="{{ old('origin') }}" required>
                            @error('origin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="destination" class="form-label">Alamat Tujuan</label>
                            <input type="text" class="form-control @error('destination') is-invalid @enderror" 
                                   id="destination" name="destination" 
                                   placeholder="Contoh: Philadelphia, PA" 
                                   value="{{ old('destination') }}" required>
                            @error('destination')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-2"></i>Cek Harga Tol
                        </button>
                    </form>

                    {{-- Display Result --}}
                    @if (session('toll_result'))
                        @php
                            $result = session('toll_result');
                        @endphp

                        <hr class="my-4">

                        <div class="alert {{ $result['success'] ? 'alert-success' : 'alert-warning' }}">
                            <h5 class="alert-heading">{{ $result['message'] }}</h5>

                            @if ($result['success'] && $result['data'])
                                <ul class="mb-0">
                                    <li><strong>Jarak:</strong> {{ number_format($result['data']['distance'] / 1000, 2) }} km</li>
                                    <li><strong>Durasi:</strong> {{ gmdate('H:i:s', (int) filter_var($result['data']['duration'], FILTER_SANITIZE_NUMBER_INT)) }}</li>
                                    @if ($result['data']['toll_price'])
                                        <li><strong>Tarif Tol:</strong> {{ $result['data']['currency'] }} {{ number_format($result['data']['toll_price'], 0, ',', '.') }}</li>
                                    @else
                                        <li class="text-muted">Tarif tol tidak tersedia (rute tanpa tol atau data Google belum update)</li>
                                    @endif
                                </ul>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- Back Button --}}
            <div class="mt-3">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection