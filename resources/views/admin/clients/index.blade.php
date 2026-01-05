@extends('layouts.mainlayout')

@section('title', 'Clients - Lamoment')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0 text-theme-maroon">Clients</h1>
        <div>
            @can('manage-crm')
                <a href="{{ route('admin.clients.create') }}" class="btn btn-outline-secondary me-2">New Client</a>
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
                        <th>Phone</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Created</th>
                        @can('manage-crm')
                            <th class="text-end">Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                @forelse($clients as $client)
                    <tr>
                        <td>{{ $client->client_id }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->phone ?? '-' }}</td>
                        <td>{{ $client->source ?? '-' }}</td>
                        <td>
                            @php
                                $statusClass = match($client->status) {
                                    'belum deal' => 'bg-secondary',
                                    'perlu remind dp' => 'bg-warning text-dark',
                                    'perlu remind lunas' => 'bg-info text-dark',
                                    'perlu mengingat tanggal hari-h' => 'bg-primary',
                                    'selesai acara' => 'bg-success',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $statusClass }}">
                                {{ $client->status ?? 'belum deal' }}
                            </span>
                        </td>
                        <td>{{ optional($client->created_at)->format('Y-m-d') ?? '-' }}</td>
                        @can('manage-crm')
                            <td class="text-end">
                                <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                                <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus client ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ Gate::allows('manage-crm') ? '7' : '6' }}" class="text-center py-4">No clients found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $clients->links() }}
    </div>
</div>
@endsection