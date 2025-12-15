@extends('layouts.mainlayout')

@section('title', 'New Package - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Create Package</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('packages.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Base Price (Rp)</label>
                    <input name="base_price" type="number" step="0.01" value="{{ old('base_price', 0) }}" class="form-control @error('base_price') is-invalid @enderror" required>
                    @error('base_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 form-check">
                    <input name="is_active" type="checkbox" value="1" class="form-check-input" {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>

                <div class="d-flex">
                    <button class="btn btn-primary me-2">Create</button>
                    <a href="{{ route('packages.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection