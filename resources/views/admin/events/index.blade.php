@extends('layouts.mainlayout')

@section('title', 'Events - Lamoment')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0 text-theme-maroon">Events</h1>
        <div>
            <a href="{{ route('admin.events.create') }}" class="btn btn-outline-secondary me-2">New Event</a>
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
                        <th>Client</th>
                        <th>Package</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>{{ $event->event_id }}</td>
                        <td>{{ $event->client->name ?? '-' }}</td>
                        <td>{{ $event->package->name ?? '-' }}</td>
                        <td>{{ $event->event_type }}</td>
                        <td>{{ optional($event->actual_date)->format('Y-m-d') ?? '-' }}</td>
                        <td>{{ $event->location ?? '-' }}</td>
                        <td>
                            <span class="badge {{ in_array($event->status, ['completed', 'active']) ? 'bg-success' : 'bg-warning' }}">
                                {{ $event->status ?? 'pending' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                            <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus event ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">No events found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $events->links() }}
    </div>
</div>
@endsection