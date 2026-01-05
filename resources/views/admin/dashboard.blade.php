@extends('layouts.mainlayout')

@section('title', 'Dashboard - Lamoment')

@section('content')
<div class="container py-5">
    {{-- Welcome Section + Cek Tarif Tol Button (Header Row) --}}
    <div class="row mb-4 align-items-start">
        {{-- Left: Welcome Text --}}
        <div class="col">
            <h1 class="h3 text-theme-maroon mb-1">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="text-muted mb-0">Role: <strong>{{ Auth::user()->role }}</strong> | Quick access to your responsibilities below.</p>
        </div>

        {{-- Right: Cek Tarif Tol Button --}}
        @if(in_array(Auth::user()->role, ['CEO', 'CFO', 'COO']))
            <div class="col-auto">
                <div class="card border-0 shadow-sm" style="width: 280px; background-color: rgba(146, 116, 88, 0.05);">
                    <div class="card-body p-3">
                        <p class="card-text small text-muted mb-2" style="font-family: 'PT Serif', serif;">
                            <i class="bi bi-geo-alt-fill me-1" style="color: var(--primary-taupe);"></i>
                            Features
                        </p>
                        <a href="{{ route('admin.toll.index') }}" class="btn btn-sm" style="background-color: var(--primary-taupe); color: var(--primary-beige); width: 100%; font-family: 'PT Serif', serif; font-weight: 500;">
                            Cek Kebutuhan Perjalanan
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="row g-4">

        {{-- === MAIN RESPONSIBILITIES (Semua Role) === --}}
        <div class="col-12">
            <h5 class="mb-3">📌 Main Responsibilities</h5>
        </div>

        {{-- Events & Packages (CEO, CFO, COO) --}}
        @can('manage-operations')
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-primary">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Events</h5>
                        <p class="card-text text-muted small">Manage event schedules and statuses.</p>
                        <div class="mt-auto">
                            <a href="{{ route('admin.events.index') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-calendar-event me-1"></i> Open Events
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-primary">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Packages</h5>
                        <p class="card-text text-muted small">Create and edit packages & pricing.</p>
                        <div class="mt-auto">
                            <a href="{{ route('admin.packages.index') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-box-seam me-1"></i> Open Packages
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        {{-- === ROLE-SPECIFIC MODULES === --}}
        
        {{-- Finance (Semua Admin bisa akses, tapi akses berbeda) --}}
        @can('access-fund-requests')
            <div class="col-12 mt-4">
                <h5 class="mb-3">💰 Finance</h5>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-success">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Fund Requests</h5>
                        <p class="card-text text-muted small">
                            @if(Gate::allows('manage-fund-requests'))
                                Manage fund requests and approvals (Full Access).
                            @else
                                Create and view fund requests (Limited Access).
                            @endif
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('admin.fund-requests.index') }}" class="btn btn-success btn-sm">
                                <i class="bi bi-cash-stack me-1"></i> Open Fund Requests
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        {{-- Operations (CEO, CFO, COO) - Inventory --}}
        @if(in_array(Auth::user()->role, ['CEO', 'CFO', 'COO']))
            <div class="col-12 mt-4">
                <h5 class="mb-3">📦 Operations (Inventory)</h5>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-warning">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Inventory Items</h5>
                        <p class="card-text text-muted small">Manage inventory items catalog.</p>
                        <div class="mt-auto">
                            <a href="{{ route('admin.inventory-items.index') }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-box me-1"></i> Open Items
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-warning">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Inventory Units</h5>
                        <p class="card-text text-muted small">Track individual inventory units.</p>
                        <div class="mt-auto">
                            <a href="{{ route('admin.inventory-units.index') }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-boxes me-1"></i> Open Units
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- CRM (CEO & CMO) --}}
        @can('manage-crm')
            <div class="col-12 mt-4">
                <h5 class="mb-3">👥 Customer Relationship Management</h5>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-info">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Clients</h5>
                        <p class="card-text text-muted small">Client list and CRM actions.</p>
                        <div class="mt-auto">
                            <a href="{{ route('admin.clients.index') }}" class="btn btn-info btn-sm text-white">
                                <i class="bi bi-people me-1"></i> Open Clients
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-info">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Partners</h5>
                        <p class="card-text text-muted small">Manage business partners.</p>
                        <div class="mt-auto">
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-info btn-sm text-white">
                                <i class="bi bi-building me-1"></i> Open Partners
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        {{-- Web Content (Semua Admin) --}}
        @can('manage-content')
            <div class="col-12 mt-4">
                <h5 class="mb-3">🌐 Web Content</h5>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Reviews</h5>
                        <p class="card-text text-muted small">
                            Manage customer reviews.
                            @php
                                $newReviewsCount = App\Models\Review::where('created_at', '>=', now()->subDays(7))->count();
                            @endphp
                            @if($newReviewsCount > 0)
                                <span class="badge bg-danger ms-1">{{ $newReviewsCount }} new from last 7 days</span>
                            @endif
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('reviews') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-chat-left-text me-1"></i> Open Reviews
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">FAQs</h5>
                        <p class="card-text text-muted small">Manage frequently asked questions.</p>
                        <div class="mt-auto">
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-question-circle me-1"></i> Open FAQs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        {{-- === VIEW-ONLY SECTION === --}}
        @if(in_array(Auth::user()->role, ['CFO', 'CMO', 'COO']))
            <div class="col-12 mt-5">
                <h5 class="mb-3 text-muted">👁️ View-Only Access</h5>
            </div>

            {{-- CFO: View Inventory & CRM --}}
            @if(Auth::user()->role === 'CFO')
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Inventory Items</h6>
                            <a href="{{ route('admin.inventory-items.index') }}" class="btn btn-outline-secondary btn-sm">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Inventory Units</h6>
                            <a href="{{ route('admin.inventory-units.index') }}" class="btn btn-outline-secondary btn-sm">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Clients</h6>
                            <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary btn-sm">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Partners</h6>
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary btn-sm">View</a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- CMO: View Inventory & Fund Requests --}}
            @if(Auth::user()->role === 'CMO')
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Inventory Items</h6>
                            <a href="{{ route('admin.inventory-items.index') }}" class="btn btn-outline-secondary btn-sm">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Inventory Units</h6>
                            <a href="{{ route('admin.inventory-units.index') }}" class="btn btn-outline-secondary btn-sm">View</a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- COO: View CRM --}}
            @if(Auth::user()->role === 'COO')
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Clients</h6>
                            <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary btn-sm">View</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 bg-light">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Partners</h6>
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary btn-sm">View</a>
                        </div>
                    </div>
                </div>
            @endif
        @endif

    </div>
</div>
@endsection
