@extends('layouts.mainlayout')

@section('title', 'New Package - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Create Package</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Base Price (Rp) <span class="text-danger">*</span></label>
                    <input name="base_price" type="number" value="{{ old('base_price') }}" class="form-control @error('base_price') is-invalid @enderror" required>
                    @error('base_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input name="image" type="file" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    <small class="text-muted d-block mt-1">Format: JPEG, PNG, JPG, GIF, WebP | Max: 5MB</small>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 form-check">
                    <input name="is_active" type="checkbox" value="1" class="form-check-input" {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">Create</button>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection