@extends('layouts.mainlayout')

@section('title', 'Edit Client - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Edit Client</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.clients.update', $client) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input name="name" value="{{ old('name', $client->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input name="phone" value="{{ old('phone', $client->phone) }}" class="form-control @error('phone') is-invalid @enderror">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Source</label>
                    <input name="source" value="{{ old('source', $client->source) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="belum deal" {{ old('status', $client->status) == 'belum deal' ? 'selected' : '' }}>Belum Deal</option>
                        <option value="perlu remind dp" {{ old('status', $client->status) == 'perlu remind dp' ? 'selected' : '' }}>Perlu Remind DP</option>
                        <option value="perlu remind lunas" {{ old('status', $client->status) == 'perlu remind lunas' ? 'selected' : '' }}>Perlu Remind Lunas</option>
                        <option value="perlu mengingat tanggal hari-h" {{ old('status', $client->status) == 'perlu mengingat tanggal hari-h' ? 'selected' : '' }}>Perlu Mengingat Tanggal Hari-H</option>
                        <option value="selesai acara" {{ old('status', $client->status) == 'selesai acara' ? 'selected' : '' }}>Selesai Acara</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="3" class="form-control">{{ old('notes', $client->notes) }}</textarea>
                </div>

                <div class="d-flex">
                    <button class="btn btn-primary me-2">Save changes</button>
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection