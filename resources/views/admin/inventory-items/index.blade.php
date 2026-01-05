@extends('layouts.mainlayout')

@section('title', 'Inventory Items - Lamoment')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0 text-theme-maroon">Inventory Items</h1>
        <div>
            <a href="{{ route('admin.inventory-items.create') }}" class="btn btn-outline-secondary me-2">New Item</a>
            <a href="{{ route('admin.inventory-units.index') }}" class="btn btn-outline-secondary me-2">View Units</a>
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
                        <th>Name</th>
                        <th>Picture</th>
                        <th>Total Units</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->inventory_item_id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @if($item->picture && Storage::disk('public')->exists($item->picture))
                                <img src="{{ Storage::url($item->picture) }}" 
                                     alt="{{ $item->name }}" 
                                     style="max-width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-info">{{ $item->units_count ?? 0 }} units</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.inventory-items.edit', $item) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                            <form action="{{ route('admin.inventory-items.destroy', $item) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus item ini? Units terkait akan ikut terhapus.');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No inventory items found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $items->links() }}
    </div>
</div>
@endsection