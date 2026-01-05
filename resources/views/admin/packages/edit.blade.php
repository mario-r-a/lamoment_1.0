@extends('layouts.mainlayout')

@section('title', 'Edit Package - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Edit Package</h1>

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
            <form action="{{ route('admin.packages.update', $package) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input name="name" value="{{ old('name', $package->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $package->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Base Price (Rp) <span class="text-danger">*</span></label>
                    <input name="base_price" type="number" value="{{ old('base_price', $package->base_price) }}" class="form-control @error('base_price') is-invalid @enderror" required>
                    @error('base_price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Display Current Image --}}
                @if($package->has_image)
                    <div class="mb-3">
                        <label class="form-label">Current Image</label>
                        <div class="mb-2">
                            <img src="{{ $package->image_url }}" 
                                 alt="{{ $package->name }}" 
                                 style="max-width: 200px; border-radius: 8px; border: 1px solid #ddd; padding: 4px;">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="remove_image" value="1" class="form-check-input" id="removeImage">
                            <label class="form-check-label text-danger" for="removeImage">
                                Remove current image
                            </label>
                        </div>
                    </div>
                @endif

                {{-- Upload New Image --}}
                <div class="mb-3">
                    <label class="form-label">
                        {{ $package->has_image ? 'Replace Image' : 'Upload Image' }}
                    </label>
                    <input name="image" type="file" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    <small class="text-muted d-block mt-1">
                        Format: JPEG, PNG, JPG, GIF, WebP | Max: 5MB
                        @if($package->has_image)
                            <br>Leave empty to keep current image (unless you check "Remove" above)
                        @endif
                    </small>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3 form-check">
                    <input name="is_active" type="checkbox" value="1" class="form-check-input" {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection