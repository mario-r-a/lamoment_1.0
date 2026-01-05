@extends('layouts.mainlayout')

@section('title', 'New Inventory Item - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Create Inventory Item</h1>

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
            {{-- PENTING: enctype="multipart/form-data" WAJIB untuk upload file --}}
            <form action="{{ route('admin.inventory-items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Picture</label>
                    <input name="picture" type="file" class="form-control @error('picture') is-invalid @enderror" accept="image/*">
                    <small class="text-muted d-block mt-1">Format: JPEG, PNG, JPG, GIF, WebP | Max: 5MB</small>
                    @error('picture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">Create</button>
                    <a href="{{ route('admin.inventory-items.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection