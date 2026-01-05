@extends('layouts.mainlayout')

@section('title', 'FAQs - Lamoment')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0 text-theme-maroon">FAQs</h1>
        <div>
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-outline-secondary me-2">New FAQ</a>
            <a href="{{ route('admin.faq-categories.index') }}" class="btn btn-outline-secondary me-2">Manage Categories</a>
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
                        <th>Question</th>
                        <th>Category</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($faqs as $faq)
                    <tr>
                        <td>{{ $faq->faq_id }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->category->name ?? '-' }}</td>
                        <td>{{ $faq->position ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $faq->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $faq->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Hapus FAQ ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No FAQs found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $faqs->links() }}
    </div>
</div>
@endsection