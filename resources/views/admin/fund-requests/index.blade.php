@extends('layouts.mainlayout')

@section('title', 'Fund Requests - Lamoment')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0 text-theme-maroon">Fund Requests</h1>
        <div>
            <a href="{{ route('admin.fund-requests.create') }}" class="btn btn-outline-secondary me-2">New Request</a>
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
                        <th>Title</th>
                        <th>Requestor</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Approver</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($fundRequests as $fr)
                    <tr>
                        <td>{{ $fr->fund_request_id }}</td>
                        <td>{{ $fr->title ?? '-' }}</td>
                        <td>{{ $fr->requestor->name ?? '-' }}</td>
                        <td>{{ $fr->request_date }}</td>
                        <td>Rp {{ number_format($fr->total_estimated ?? 0, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge 
                                @if($fr->status == 'approved') bg-success
                                @elseif($fr->status == 'rejected') bg-danger
                                @elseif($fr->status == 'needs revision') bg-warning
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($fr->status ?? 'pending') }}
                            </span>
                        </td>
                        <td>{{ $fr->approver->name ?? '-' }}</td>
                        <td class="text-end">
                            {{-- Edit: CEO/CFO bisa edit semua, CMO/COO hanya milik sendiri --}}
                            @if(Gate::allows('manage-fund-requests') || $fr->requestor_id === Auth::id())
                                <a href="{{ route('admin.fund-requests.edit', $fr) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                            @endif
                            
                            {{-- Delete: 
                                - CEO/CFO: bisa delete semua
                                - CMO/COO: bisa delete milik sendiri HANYA jika status = "pending"
                            --}}
                            @php
                                $canDelete = Gate::allows('manage-fund-requests') // CEO/CFO bisa semua
                                    || ($fr->requestor_id === Auth::id() && $fr->status === 'pending'); // Owner + pending
                            @endphp
                            
                            @if($canDelete)
                                <form action="{{ route('admin.fund-requests.destroy', $fr) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus fund request ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">No fund requests found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $fundRequests->links() }}
    </div>
</div>
@endsection