<div class="review-card-wrapper">
    <div class="review-card p-4">
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

        <div class="star-rating-display mb-3">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $review->rating)
                    <i class="bi bi-star-fill"></i>
                @else
                    <i class="bi bi-star" style="color: #d4d4d4;"></i>
                @endif
            @endfor
        </div>

        <p class="mb-0" style="font-family: 'PT Serif', serif; color: var(--text-dark); line-height: 1.7;">
            {{ $review->content }}
        </p>
    </div>
</div>