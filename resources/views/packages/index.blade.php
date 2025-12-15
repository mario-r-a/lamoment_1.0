@extends('layouts.mainlayout')

@section('title', 'Packages - Lamoment')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0 text-theme-maroon">Packages</h1>
        <div>
            <a href="{{ route('packages.create') }}" class="btn btn-outline-secondary me-2">New Package</a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Back</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Base Price</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($packages as $package)
                    <tr>
                        <td>{{ $package->package_id }}</td>
                        <td>{{ $package->name }}</td>
                        <td>{{ substr($package->description ?? '-', 0, 40) }}...</td>
                        <td>Rp {{ number_format($package->base_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $package->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $package->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('packages.edit', $package) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                            <form action="{{ route('packages.destroy', $package) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus package ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No packages found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $packages->links() }}
    </div>
</div>
@endsection