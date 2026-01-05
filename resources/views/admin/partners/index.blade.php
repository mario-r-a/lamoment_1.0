@extends('layouts.mainlayout')

@section('title', 'Partners - Lamoment')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0 text-theme-maroon">Partners</h1>
        <div>
            @can('manage-crm')
                <a href="{{ route('admin.partners.create') }}" class="btn btn-outline-secondary me-2">New Partner</a>
            @endcan
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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact Person</th>
                        <th>Phone</th>
                        <th>Type</th>
                        @can('manage-crm')
                            <th class="text-end">Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                @forelse($partners as $partner)
                    <tr>
                        <td>{{ $partner->partner_id }}</td>
                        <td>{{ $partner->name }}</td>
                        <td>{{ $partner->contact_person ?? '-' }}</td>
                        <td>{{ $partner->phone ?? '-' }}</td>
                        <td>{{ $partner->type ?? '-' }}</td>
                        @can('manage-crm')
                            <td class="text-end">
                                <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                                <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus partner ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ Gate::allows('manage-crm') ? '6' : '5' }}" class="text-center py-4">No partners found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $partners->links() }}
    </div>
</div>
@endsection