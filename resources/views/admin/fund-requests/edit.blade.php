@extends('layouts.mainlayout')

@section('title', 'Edit Fund Request - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Edit Fund Request</h1>

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
            <form action="{{ route('admin.fund-requests.update', $fundRequest) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Requestor</label>
                    <input type="text" class="form-control" value="{{ $fundRequest->requestor->name ?? '-' }}" disabled>
                    <small class="text-muted">Request dibuat oleh: {{ $fundRequest->requestor->name }}</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input name="title" value="{{ old('title', $fundRequest->title) }}" class="form-control @error('title') is-invalid @enderror" maxlength="120">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Request Date <span class="text-danger">*</span></label>
                    <input name="request_date" type="date" value="{{ old('request_date', $fundRequest->request_date) }}" class="form-control @error('request_date') is-invalid @enderror" required>
                    @error('request_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Total Estimated (Rp)</label>
                    <input name="total_estimated" type="number" step="0.01" value="{{ old('total_estimated', $fundRequest->total_estimated) }}" class="form-control @error('total_estimated') is-invalid @enderror">
                    @error('total_estimated') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $fundRequest->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                @if($canManageFinance)
                    {{-- CEO/CFO: Bisa ubah status --}}
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ old('status', $fundRequest->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="needs revision" {{ old('status', $fundRequest->status) == 'needs revision' ? 'selected' : '' }}>Needs Revision</option>
                            <option value="approved" {{ old('status', $fundRequest->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ old('status', $fundRequest->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <small class="text-muted d-block mt-1">Approver akan otomatis diset ke Anda ketika status berubah ke "Approved" atau "Rejected".</small>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                @else
                    {{-- Non-CEO/CFO: Status read-only --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" value="{{ ucfirst($fundRequest->status) }}" disabled>
                        <small class="text-muted d-block mt-1">Hanya CEO/CFO yang dapat mengubah status.</small>
                    </div>
                @endif

                {{-- Approver Info (Read-only, auto-filled) --}}
                @if($fundRequest->approver)
                    <div class="mb-3">
                        <label class="form-label">Approver (Last Updated By)</label>
                        <input type="text" class="form-control" value="{{ $fundRequest->approver->name }} ({{ $fundRequest->approver->role }})" disabled>
                        <small class="text-muted d-block mt-1">{{ optional($fundRequest->updated_at)->format('Y-m-d H:i') }}</small>
                    </div>
                @endif

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <a href="{{ route('admin.fund-requests.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection