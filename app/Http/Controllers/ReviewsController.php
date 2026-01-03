<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReviewsController extends Controller
{
    // Public: View reviews (guest + admin)
    public function index()
    {
        // total visible count
        $totalVisible = Review::where('is_active', true)->count();

        // initial page: load first 10 only
        $reviews = Review::where('is_active', true)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Cek apakah user submission enabled (dari cache)
        $userCanSubmit = Cache::get('reviews_user_submission_enabled', false);

        // Jika user adalah admin (dan rolenya sesuai), tampilkan semua reviews (termasuk yang inactive)
        $allReviews = null;
        $search = null;
        
        if (Auth::check() && Gate::allows('manage-content')) {
            // GUARD: search query hanya untuk admin. Guest yang coba search redirect ke reviews biasa
            $search = request('search');
             // paginate admin list + support search
             $query = Review::orderBy('review_id', 'asc');
             
             if ($search) {
                 $query->where(function($q) use ($search) {
                     $q->where('name', 'like', '%' . $search . '%')
                       ->orWhere('content', 'like', '%' . $search . '%');
                 });
             }
             
             $allReviews = $query->paginate(20)->withQueryString();
        } else {
            // GUARD: guest user mencoba akses search query, redirect tanpa search
            if (request('search')) {
                return redirect()->route('reviews');
            }
         }

         return view('public.reviews', compact('reviews', 'userCanSubmit', 'allReviews', 'totalVisible', 'search'));
    }

    // Public: Submit review (guest user - NO AUTH REQUIRED)
    public function store(Request $request)
    {
        // Cek apakah user submission enabled
        if (!Cache::get('reviews_user_submission_enabled', false)) {
            return redirect()->route('reviews')
                ->with('error', 'Review submission is currently disabled.');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1200',
        ]);

        // Set date to today, LANGSUNG ACTIVE (visible)
        $data['date'] = now();
        $data['is_active'] = true;

        Review::create($data);

        return redirect()->route('reviews')
            ->with('success', 'Thank you for your review!');
    }

    // AJAX: load more reviews (public)
    public function more(Request $request)
    {
        $offset = (int) $request->query('offset', 0);
        $limit = 10;

        $query = Review::where('is_active', true)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        $total = $query->count();

        $reviews = $query->skip($offset)->take($limit)->get();

        // Render each review with partial and return html
        $html = '';
        foreach ($reviews as $review) {
            $html .= view('public.partials.review_card', compact('review'))->render();
        }

        $nextOffset = $offset + $reviews->count();
        $hasMore = $nextOffset < $total;

        return response()->json([
            'html' => $html,
            'nextOffset' => $nextOffset,
            'hasMore' => $hasMore,
        ]);
    }

    // Admin: Toggle user submission
    public function toggleSubmission()
    {
        $this->authorize('manage-content');

        $current = Cache::get('reviews_user_submission_enabled', false);
        $new = !$current;

        Cache::forever('reviews_user_submission_enabled', $new);

        return redirect()->route('reviews')
            ->with('success', 'User review submission ' . ($new ? 'enabled' : 'disabled') . '.');
    }

    // Admin: Update review (activate/deactivate or edit)
    public function update(Request $request, Review $review)
    {
        $this->authorize('manage-content');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1200',
            'date' => 'required|date|before_or_equal:today',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        $review->update($data);

        return redirect()->route('reviews')
            ->with('success', 'Review updated successfully.');
    }

    // Admin: Delete review
    public function destroy(Review $review)
    {
        $this->authorize('manage-content');

        $review->delete();

        return redirect()->route('reviews')
            ->with('success', 'Review deleted successfully.');
    }

    // Admin: create review (manual entry) - protected by gate
    public function adminStore(Request $request)
    {
        $this->authorize('manage-content');

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1200',
            'date' => 'nullable|date|before_or_equal:today',
            'is_active' => 'nullable|boolean',
        ]);

        $data['date'] = $data['date'] ?? now()->toDateString();
         // admin-created reviews default aktif
         $data['is_active'] = $request->has('is_active') ? true : true;

        Review::create($data);

        return redirect()->route('reviews')->with('success', 'Review berhasil dibuat.');
    }
}