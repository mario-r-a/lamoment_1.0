@extends('layouts.mainlayout')

@section('title', 'Edit FAQ Category - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Edit FAQ Category</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.faq-categories.update', $faqCategory) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input name="name" value="{{ old('name', $faqCategory->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $faqCategory->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Position</label>
                    <input name="position" type="number" value="{{ old('position', $faqCategory->position) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-select">
                        <option value="1" {{ old('is_active', $faqCategory->is_active) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('is_active', $faqCategory->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="d-flex">
                    <button class="btn btn-primary me-2">Save changes</button>
                    <a href="{{ route('admin.faq-categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection