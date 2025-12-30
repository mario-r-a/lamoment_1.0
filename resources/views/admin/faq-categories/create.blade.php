@extends('layouts.mainlayout')

@section('title', 'New FAQ Category - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Create FAQ Category</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.faq-categories.store') }}" method="POST">
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
                    <label class="form-label">Position</label>
                    <input name="position" type="number" value="{{ old('position', 0) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-select">
                        <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="d-flex">
                    <button class="btn btn-primary me-2">Create</button>
                    <a href="{{ route('admin.faq-categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection