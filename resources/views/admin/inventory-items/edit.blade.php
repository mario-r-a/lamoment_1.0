@extends('layouts.mainlayout')

@section('title', 'Edit Inventory Item - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Edit Inventory Item</h1>

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
            <form action="{{ route('admin.inventory-items.update', $inventoryItem) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input name="name" value="{{ old('name', $inventoryItem->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Display Current Picture --}}
                @if($inventoryItem->picture)
                    <div class="mb-3">
                        <label class="form-label">Current Picture</label>
                        <div class="mb-2">
                            <img src="{{ Storage::url($inventoryItem->picture) }}" 
                                 alt="{{ $inventoryItem->name }}" 
                                 style="max-width: 200px; border-radius: 8px; border: 1px solid #ddd; padding: 4px;">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="remove_picture" value="1" class="form-check-input" id="removePicture">
                            <label class="form-check-label text-danger" for="removePicture">
                                Remove current picture
                            </label>
                        </div>
                    </div>
                @endif

                {{-- Upload New Picture --}}
                <div class="mb-3">
                    <label class="form-label">
                        {{ $inventoryItem->picture ? 'Replace Picture' : 'Upload Picture' }}
                    </label>
                    <input name="picture" type="file" class="form-control @error('picture') is-invalid @enderror" accept="image/*">
                    <small class="text-muted d-block mt-1">
                        Format: JPEG, PNG, JPG, GIF, WebP | Max: 5MB
                        @if($inventoryItem->picture)
                            <br>Leave empty to keep current picture (unless you check "Remove" above)
                        @endif
                    </small>
                    @error('picture') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <a href="{{ route('admin.inventory-items.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection