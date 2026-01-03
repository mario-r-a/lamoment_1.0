@extends('layouts.mainlayout')

@section('title', 'Reviews - Lamoment')

@section('styles')
<style>
    /* Masonry layout for reviews */
    .reviews-masonry {
        column-count: 3;
        column-gap: 1.5rem;
    }

    .review-card-wrapper {
        break-inside: avoid;
        margin-bottom: 1.5rem;
    }

    .review-card {
        background-color: #ffffff;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.06);
        box-shadow: none;
        transition: box-shadow 0.25s ease, transform 0.2s ease;
    }

    .review-card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }

    /* Profile picture colors (Google-style) */
    .avatar-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.1rem;
        color: #fff;
        flex-shrink: 0;
    }

    /* Star rating display */
    .star-rating-display i {
        color: #F4A460;
        font-size: 1rem;
    }

    /* Interactive star rating input */
    .star-rating-input {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
        gap: 0.25rem;
    }

    .star-rating-input input {
        display: none;
    }

    .star-rating-input label {
        cursor: pointer;
        font-size: 1.75rem;
        color: #d4d4d4;
        transition: color 0.15s ease;
    }

    .star-rating-input label:hover,
    .star-rating-input label:hover ~ label,
    .star-rating-input input:checked ~ label {
        color: #F4A460;
    }

    /* Collapsible form */
    .collapse-toggle {
        cursor: pointer;
        user-select: none;
    }

    .collapse-toggle:hover {
        opacity: 0.8;
    }

    .collapse-toggle .chevron-icon {
        transition: transform 0.3s ease;
    }

    .collapse-toggle[aria-expanded="true"] .chevron-icon {
        transform: rotate(180deg);
    }

    /* Responsive masonry */
    @media (max-width: 991px) {
        .reviews-masonry {
            column-count: 2;
        }
    }

    @media (max-width: 576px) {
        .reviews-masonry {
            column-count: 1;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    
    {{-- Header Section --}}
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <div class="mb-4">
                <img src="{{ asset('images/reviews/lamoment_illustration_1.webp') }}" alt="Reviews icon" style="max-width: 320px;" class="img-fluid">
            </div>
            <h1 class="mb-4" style="font-family: 'Playfair Display', serif; color: var(--primary-maroon); font-size: 2.5rem;">
                Reviews from All Across The World
            </h1>
            <p class="lead" style="color: var(--text-dark);">
                From birthdays to special celebrations, our phones are designed to capture every unforgettable moment. Experience it through the voices of our customers.
            </p>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- User Submission Form (Collapsible, only if enabled) --}}
    @if($userCanSubmit)
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                {{-- Collapsible Toggle --}}
                <div class="collapse-toggle d-flex align-items-center justify-content-center gap-2 mb-3" 
                     data-bs-toggle="collapse" 
                     data-bs-target="#reviewFormCollapse" 
                     aria-expanded="false" 
                     aria-controls="reviewFormCollapse">
                    <span style="font-family: 'Playfair Display', serif; font-size: 1.5rem; color: var(--primary-maroon);">
                        Share your experience
                    </span>
                    <i class="bi bi-chevron-down chevron-icon" style="color: var(--primary-maroon); font-size: 1.25rem;"></i>
                </div>

                {{-- Collapsible Form --}}
                <div class="collapse" id="reviewFormCollapse">
                    <div class="card border-0" style="background-color: rgba(146, 116, 88, 0.08); border-radius: 12px;">
                        <div class="card-body p-4">
                            <form action="{{ route('reviews.store') }}" method="POST">
                                @csrf

                                <div class="row g-4">
                                    {{-- Left Column: Name + Rating --}}
                                    <div class="col-md-5">
                                        <div class="mb-4">
                                            <label for="name" class="form-label fw-bold" style="color: var(--text-dark);">Your Name *</label>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   placeholder="Enter your name" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold" style="color: var(--text-dark);">Rating *</label>
                                            <div class="star-rating-input">
                                                @for($i = 5; $i >= 1; $i--)
                                                    <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} required>
                                                    <label for="star{{ $i }}" title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">
                                                        <i class="bi bi-star-fill"></i>
                                                    </label>
                                                @endfor
                                            </div>
                                            @error('rating')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Right Column: Tell your story --}}
                                    <div class="col-md-7">
                                        <label for="content" class="form-label fw-bold" style="color: var(--text-dark);">Tell us your story *</label>
                                        <textarea name="content" id="content" rows="5" 
                                                  class="form-control @error('content') is-invalid @enderror" 
                                                  placeholder="Share your experience with Lamoment..." required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-send px-4 py-2">
                                        Submit Review
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Public Reviews Display (Masonry Layout) --}}
    <div class="reviews-masonry">
        @forelse($reviews as $review)
            <div class="review-card-wrapper">
                <div class="review-card p-4">
                    {{-- Header: Avatar + Name + Date --}}
                    @php
                        $avatarColors = ['#4285F4', '#EA4335', '#FBBC05', '#34A853', '#FF6D01', '#46BDC6', '#7B1FA2', '#C2185B', '#00ACC1', '#8E24AA'];
                        $colorIndex = crc32($review->name) % count($avatarColors);
                        $avatarColor = $avatarColors[$colorIndex];
                    @endphp

                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-circle me-3" style="background-color: {{ $avatarColor }};">
                            {{ strtoupper(substr($review->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-bold" style="font-family: 'PT Serif', serif; color: var(--text-dark); font-size: 1rem;">
                                {{ $review->name }}
                            </div>
                            <small style="color: var(--primary-taupe);">{{ $review->date->diffForHumans() }}</small>
                        </div>
                    </div>

                    {{-- Star Rating --}}
                    <div class="star-rating-display mb-3">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <i class="bi bi-star-fill"></i>
                            @else
                                <i class="bi bi-star" style="color: #d4d4d4;"></i>
                            @endif
                        @endfor
                    </div>

                    {{-- Review Content --}}
                    <p class="mb-0" style="font-family: 'PT Serif', serif; color: var(--text-dark); line-height: 1.7;">
                        {{ $review->content }}
                    </p>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">No reviews yet. Be the first to share your experience!</p>
            </div>
        @endforelse
    </div> {{-- end reviews-masonry --}}

    @php
        $initialLoaded = $reviews->count();
        $totalVisibleCount = $totalVisible ?? \App\Models\Review::where('is_active', true)->count();
    @endphp

    {{-- Load more wrapper always rendered (button shown only when needed) --}}
    <div id="loadMoreWrap" class="text-center mt-4" data-offset="{{ $initialLoaded }}" data-total="{{ $totalVisibleCount }}">
        @if($totalVisibleCount > $initialLoaded)
            <button id="loadMoreBtn" class="btn" style="background-color: var(--primary-taupe); color: var(--primary-beige);" data-offset="{{ $initialLoaded }}">
                More
            </button>
        @else
            <div id="loadMorePlaceholder" style="display:none;"></div>
        @endif
    </div>

    {{-- Admin Section (only visible to admin with manage-content permission) --}}
    @can('manage-content')
        <div id="manageReviews" class="admin-section mt-5 pt-5 border-top">
             <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 style="font-family: 'Playfair Display', serif; color: var(--primary-maroon);">
                    Manage Reviews
                </h2>
                <div>
                    <!-- Search box (inline, before New Review button) -->
                    <form action="{{ route('reviews') }}" method="GET" class="d-inline-block me-2" onsubmit="this.action += '#manageReviews';">
                        <div class="input-group" style="max-width: 280px;">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search name or content..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('reviews') }}#manageReviews" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            @endif
                        </div>
                    </form>

                    <!-- New review button for admin: styled like "More" -->
                    <button class="btn" style="background-color: var(--primary-taupe); color: #ffffff;" id="openAdminCreateReview" data-bs-toggle="modal" data-bs-target="#adminCreateReviewModal">
                        New Review
                    </button>

                    <form action="{{ route('admin.reviews.toggle-submission') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn {{ $userCanSubmit ? 'btn-danger' : 'btn-success' }}">
                            {{ $userCanSubmit ? 'Disable' : 'Enable' }} User Submissions
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Rating</th>
                                <th>Content</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allReviews as $review)
                                <tr>
                                    <td>{{ ($allReviews->currentPage() - 1) * $allReviews->perPage() + $loop->iteration }}</td>
                                    <td>{{ $review->name }}</td>
                                    <td>
                                        @for($i = 1; $i <= $review->rating; $i++)
                                            ⭐
                                        @endfor
                                    </td>
                                    <td>{{ Str::limit($review->content, 50) }}</td>
                                    <td>{{ $review->date->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="badge {{ $review->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $review->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-primary me-2" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal{{ $review->review_id }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('admin.reviews.destroy', $review) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Delete this review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Edit Modal --}}
                                <div class="modal fade" id="editModal{{ $review->review_id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.reviews.update', $review) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Review</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name" value="{{ $review->name }}" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Rating</label>
                                                        <select name="rating" class="form-control" required>
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <option value="{{ $i }}" {{ $review->rating == $i ? 'selected' : '' }}>
                                                                    {{ $i }} star{{ $i > 1 ? 's' : '' }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Content</label>
                                                        <textarea name="content" rows="4" class="form-control" required>{{ $review->content }}</textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Date</label>
                                                        <input type="date" name="date" value="{{ $review->date->format('Y-m-d') }}" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3 form-check">
                                                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive{{ $review->review_id }}" {{ $review->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="isActive{{ $review->review_id }}">Active (visible to public)</label>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">No reviews found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-3">
                <div class="pagination-taupe">
                    {{ $allReviews->fragment('manageReviews')->links() }}
                </div>
            </div>

            <!-- Admin Create Review Modal -->
            <div class="modal fade" id="adminCreateReviewModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.reviews.store') }}" method="POST" id="adminCreateReviewForm">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Create Review</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input name="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <div class="star-rating-input">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" name="rating" id="adminStar{{ $i }}" value="{{ $i }}" {{ $i === 5 ? 'checked' : '' }} required>
                                            <label for="adminStar{{ $i }}" title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">
                                                <i class="bi bi-star-fill"></i>
                                            </label>
                                        @endfor
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Content</label>
                                    <textarea name="content" rows="4" class="form-control" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="date" id="adminCreateDate" class="form-control" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="adminIsActive" checked>
                                    <label class="form-check-label" for="adminIsActive">Active (visible to public)</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn-send">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    @endcan

</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const wrap = document.getElementById('loadMoreWrap');
    console.log('reviews:initLoaded=', wrap?.dataset.offset, ' totalVisible=', wrap?.dataset.total);

    const loadMoreBtn = document.getElementById('loadMoreBtn');
    if (!loadMoreBtn) {
        return;
    }

    loadMoreBtn.addEventListener('click', function () {
        const btn = this;
        const offset = parseInt(btn.getAttribute('data-offset') || '0', 10);
        btn.disabled = true;
        btn.textContent = 'Loading...';

        fetch(`{{ route('reviews.more') }}?offset=${offset}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            if (data.html) {
                // robust container lookup (support different container ids/classes)
                const container = document.getElementById('reviewsGrid')
                    || document.getElementById('reviewsMasonry')
                    || document.querySelector('.reviews-masonry')
                    || document.querySelector('.reviews-grid');

                if (!container) {
                    console.warn('No reviews container found to append new items.');
                } else {
                     container.insertAdjacentHTML('beforeend', data.html);
                 }
                 btn.setAttribute('data-offset', data.nextOffset);
                 document.getElementById('loadMoreWrap').dataset.offset = data.nextOffset;
                 if (!data.hasMore) {
                     document.getElementById('loadMoreWrap')?.remove();
                 } else {
                     btn.disabled = false;
                     btn.textContent = 'More';
                 }
             } else {
                 btn.remove();
             }
         })
        .catch((err) => {
             console.error('Failed to load more reviews:', err);
             btn.disabled = false;
             btn.textContent = 'More';
         });
    });

    // ensure admin modal date & rating defaults when opened
    var adminModal = document.getElementById('adminCreateReviewModal');
    if (adminModal) {
        adminModal.addEventListener('show.bs.modal', function () {
            // set date to today (in case user opened on another day)
            var dateInput = document.getElementById('adminCreateDate');
            if (dateInput) {
                var today = new Date().toISOString().slice(0,10);
                dateInput.value = today;
            }
            // ensure default rating 5 is checked
            var star5 = document.getElementById('adminStar5');
            if (star5) star5.checked = true;
        });
    }
});
</script>
@endsection
