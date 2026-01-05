@extends('layouts.mainlayout')

@section('title', 'Profile - Lamoment')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="h4 text-theme-maroon mb-0">Profile</h2>
            <p class="text-muted mb-0">Manage your account information and security settings.</p>
        </div>

        <div class="d-none d-md-flex align-items-center">
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary me-2">Back to Dashboard</a>
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">View Site</a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Left: Forms -->
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Profile Information</h5>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Update Password</h5>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card shadow-sm mb-4 border-danger">
                <div class="card-body">
                    <h5 class="mb-3 text-danger">Danger Zone</h5>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>

        <!-- Right: User summary & quick actions -->
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center" style="width:72px;height:72px;">
                            <span class="text-white h4 mb-0">{{ strtoupper(substr($user->name,0,1)) }}</span>
                        </div>
                    </div>
                    <h5 class="mb-0">{{ $user->name }}</h5>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>

                    <ul class="list-unstyled text-start mb-3">
                        <li class="d-flex justify-content-between"><span class="fw-medium">Role:</span> <span>{{ $user->role }}</span></li>
                        <li class="d-flex justify-content-between"><span class="fw-medium">Status:</span> <span>{{ $user->status }}</span></li>
                        <li class="d-flex justify-content-between"><span class="fw-medium">Member since:</span> <span>{{ optional($user->created_at)->format('Y-m-d') ?? '-' }}</span></li>
                    </ul>

                    <div class="d-grid gap-2">
                        @can('manage-operations')
                            <a href="{{ route('admin.events.index') }}" class="btn btn-sm btn-primary">Events</a>
                            <a href="{{ route('admin.packages.index') }}" class="btn btn-sm btn-outline-primary">Packages</a>
                        @endcan

                        @can('manage-crm')
                            <a href="{{ route('admin.clients.index') }}" class="btn btn-sm btn-outline-success">Clients</a>
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-sm btn-outline-success">Partners</a>
                        @endcan

                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-light">Refresh</a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="mb-3">Help</h6>
                    <p class="small text-muted mb-2">Jika perlu bantuan, hubungi admin atau cek dokumentasi internal.</p>
                    <a href="{{ route('home') }}" class="small text-decoration-none">Go to public site</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
