@extends('layouts.mainlayout')

@section('title', 'Clients - Lamoment')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0 text-theme-maroon">Clients</h1>
        <div>
            <a href="{{ route('clients.create') }}" class="btn btn-outline-secondary me-2">New Client</a>
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
                        <th>Phone</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-end">Actions</th>
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
                            <span class="badge {{ ($client->status === 'active') ? 'bg-success' : 'bg-secondary' }}">
                                {{ $client->status ?? 'unknown' }}
                            </span>
                        </td>
                        <td>{{ optional($client->created_at)->format('Y-m-d') ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                            <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus client ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">No clients found.</td>
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