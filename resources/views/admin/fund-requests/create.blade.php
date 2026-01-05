@extends('layouts.mainlayout')

@section('title', 'New Fund Request - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Create Fund Request</h1>

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
            <form action="{{ route('admin.fund-requests.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" maxlength="120" placeholder="e.g., B2B dengan Wedding Organizer X">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Request Date <span class="text-danger">*</span></label>
                    <input name="request_date" type="date" value="{{ old('request_date', now()->toDateString()) }}" class="form-control @error('request_date') is-invalid @enderror" required>
                    @error('request_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Estimated (Rp)</label>
                    <input name="total_estimated" type="number" step="0.01" value="{{ old('total_estimated') }}" class="form-control @error('total_estimated') is-invalid @enderror" placeholder="0">
                    @error('total_estimated') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror" placeholder="Jelaskan detail fund request...">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                @if(in_array(Auth::user()->role, ['CEO', 'CFO']))
                    {{-- Hanya CEO/CFO yang bisa set status --}}
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="needs revision" {{ old('status') == 'needs revision' ? 'selected' : '' }}>Needs Revision</option>
                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                @else
                    {{-- Non-CEO/CFO: status otomatis "pending", tidak bisa diubah --}}
                    <div class="alert alert-info mb-3">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Status:</strong> Request akan otomatis dibuat dengan status <strong>"Pending"</strong>. 
                        Hanya CEO/CFO yang dapat mengubah status setelah direview.
                    </div>
                @endif

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">Create</button>
                    <a href="{{ route('admin.fund-requests.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection