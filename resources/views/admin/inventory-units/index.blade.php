@extends('layouts.mainlayout')

@section('title', 'Inventory Units - Lamoment')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0 text-theme-maroon">Inventory Units</h1>
        <div>
            <a href="{{ route('admin.inventory-units.create') }}" class="btn btn-outline-secondary me-2">New Unit</a>
            <a href="{{ route('admin.inventory-items.index') }}" class="btn btn-outline-secondary me-2">View Items</a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Condition</th>
                        <th>Purchase Date</th>
                        <th>Price</th>
                        <th>Lifespan (months)</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($units as $unit)
                    <tr>
                        <td>{{ $unit->unit_id }}</td>
                        <td>{{ $unit->item->name ?? '-' }}</td>
                        <td>{{ $unit->condition ?? '-' }}</td>
                        <td>{{ optional($unit->purchase_date)->format('Y-m-d') ?? '-' }}</td>
                        <td>{{ $unit->purchase_price ? 'Rp ' . number_format($unit->purchase_price, 0, ',', '.') : '-' }}</td>
                        <td>{{ $unit->lifespan_months ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $unit->status === 'available' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $unit->status ?? 'unknown' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.inventory-units.edit', $unit) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                            <form action="{{ route('admin.inventory-units.destroy', $unit) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus unit ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">No inventory units found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $units->links() }}
    </div>
</div>
@endsection