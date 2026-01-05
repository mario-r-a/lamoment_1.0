@extends('layouts.mainlayout')

@section('title', 'New Inventory Unit - Lamoment')

@section('content')
<div class="container py-5">
    <h1 class="h5 mb-4">Create Inventory Unit</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.inventory-units.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Inventory Item</label>
                    <select name="inventory_item_id" class="form-control @error('inventory_item_id') is-invalid @enderror" required>
                        <option value="">-- Select Item --</option>
                        @foreach($items as $item)
                            <option value="{{ $item->inventory_item_id }}" {{ old('inventory_item_id') == $item->inventory_item_id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('inventory_item_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Condition</label>
                    <input name="condition" value="{{ old('condition') }}" class="form-control" maxlength="50">
                </div>

                <div class="mb-3">
                    <label class="form-label">Purchase Date</label>
                    <input name="purchase_date" type="date" value="{{ old('purchase_date') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Purchase Price (Rp)</label>
                    <input name="purchase_price" type="number" step="0.01" value="{{ old('purchase_price') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Lifespan (months)</label>
                    <input name="lifespan_months" type="number" value="{{ old('lifespan_months') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <input name="status" value="{{ old('status', 'available') }}" class="form-control" maxlength="50">
                </div>

                <div class="d-flex">
                    <button class="btn btn-primary me-2">Create</button>
                    <a href="{{ route('admin.inventory-units.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection