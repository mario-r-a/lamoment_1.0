@extends('layouts.mainlayout')

@section('title', 'New Event - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Create Event</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('events.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Client</label>
                    <select name="client_id" class="form-select @error('client_id') is-invalid @enderror" required>
                        <option value="">Select Client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->client_id }}" {{ old('client_id') == $client->client_id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('client_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Package</label>
                    <select name="package_id" class="form-select @error('package_id') is-invalid @enderror" required>
                        <option value="">Select Package</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->package_id }}" {{ old('package_id') == $package->package_id ? 'selected' : '' }}>
                                {{ $package->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('package_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Event Type</label>
                    <input name="event_type" value="{{ old('event_type') }}" class="form-control @error('event_type') is-invalid @enderror" required>
                    @error('event_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Actual Date</label>
                    <input name="actual_date" type="date" value="{{ old('actual_date') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input name="location" value="{{ old('location') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <input name="status" value="{{ old('status', 'pending') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="3" class="form-control">{{ old('notes') }}</textarea>
                </div>

                <div class="d-flex">
                    <button class="btn btn-primary me-2">Create</button>
                    <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection