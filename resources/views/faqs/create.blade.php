@extends('layouts.mainlayout')

@section('title', 'New FAQ - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Create FAQ</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('faqs.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="faq_category_id" class="form-select @error('faq_category_id') is-invalid @enderror" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->faq_category_id }}" {{ old('faq_category_id') == $category->faq_category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('faq_category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Question</label>
                    <input name="question" value="{{ old('question') }}" class="form-control @error('question') is-invalid @enderror" required>
                    @error('question') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Answer</label>
                    <textarea name="answer" rows="5" class="form-control @error('answer') is-invalid @enderror" required>{{ old('answer') }}</textarea>
                    @error('answer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Position</label>
                    <input name="position" type="number" value="{{ old('position', 0) }}" class="form-control">
                </div>

                <div class="mb-3 form-check">
                    <input name="is_active" type="checkbox" value="1" class="form-check-input" {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>

                <div class="d-flex">
                    <button class="btn btn-primary me-2">Create</button>
                    <a href="{{ route('faqs.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection