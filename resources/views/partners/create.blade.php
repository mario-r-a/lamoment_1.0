@extends('layouts.mainlayout')

@section('title', 'New Partner - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Create Partner</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('partners.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact Person</label>
                    <input name="contact_person" value="{{ old('contact_person') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input name="phone" value="{{ old('phone') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <input name="type" value="{{ old('type') }}" class="form-control">
                </div>

                <div class="d-flex">
                    <button class="btn btn-primary me-2">Create</button>
                    <a href="{{ route('partners.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection