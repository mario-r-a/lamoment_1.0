@extends('layouts.mainlayout')

@section('title', 'Edit Partner - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Edit Partner</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.partners.update', $partner) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input name="name" value="{{ old('name', $partner->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact Person</label>
                    <input name="contact_person" value="{{ old('contact_person', $partner->contact_person) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input name="phone" value="{{ old('phone', $partner->phone) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <input name="type" value="{{ old('type', $partner->type) }}" class="form-control">
                </div>

                <div class="d-flex">
                    <button class="btn btn-primary me-2">Save changes</button>
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection