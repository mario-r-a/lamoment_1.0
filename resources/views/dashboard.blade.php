@extends('layouts.mainlayout')

@section('title', 'Dashboard - Lamoment')

@section('content')
<div class="container py-5">
    <div class="row mb-3">
        <div class="col">
            <h1 class="h4 text-theme-maroon">Dashboard</h1>
            <p class="text-muted mb-0">Quick access to admin features. Buttons shown according to your permissions.</p>
        </div>
    </div>

    <div class="row g-3">

        {{-- Buttons visible to all admin roles (use gate: manage-content) --}}
        @can('manage-content')
            <div class="col-12">
                <div class="card shadow-sm p-3">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('reviews') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-chat-left-text me-1"></i> Reviews
                        </a>
                        <a href="{{ route('faqs.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-question-circle me-1"></i> FAQs
                        </a>
                    </div>
                </div>
            </div>
        @endcan

        {{-- Operations (CEO, CFO, COO) --}}
        @can('manage-operations')
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Events</h5>
                        <p class="card-text text-muted">Manage event schedules and statuses.</p>
                        <div class="mt-auto">
                            <a href="{{ route('events.index') }}" class="btn btn-primary">
                                <i class="bi bi-calendar-event me-1"></i> Open Events
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Packages</h5>
                        <p class="card-text text-muted">Create and edit packages & pricing.</p>
                        <div class="mt-auto">
                            <a href="{{ route('packages.index') }}" class="btn btn-primary">
                                <i class="bi bi-box-seam me-1"></i> Open Packages
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        {{-- CRM (CEO & CMO) --}}
        @can('manage-crm')
            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Clients</h5>
                        <p class="card-text text-muted">Client list and CRM actions.</p>
                        <div class="mt-auto">
                            <a href="{{ route('clients.index') }}" class="btn btn-primary">
                                <i class="bi bi-people me-1"></i> Open Clients
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Partners</h5>
                        <p class="card-text text-muted">Manage partners and contacts.</p>
                        <div class="mt-auto">
                            <a href="{{ route('partners.index') }}" class="btn btn-primary">
                                <i class="bi bi-building me-1"></i> Open Partners
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        {{-- Users (CEO only) - show if route exists to avoid broken link --}}
        @can('manage-users')
            @if (Route::has('users.index'))
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text text-muted">User management (CEO only).</p>
                            <div class="mt-auto">
                                <a href="{{ route('users.index') }}" class="btn btn-warning">
                                    <i class="bi bi-person-lines-fill me-1"></i> Manage Users
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endcan

    </div>
</div>
@endsection
