<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\FaqCategory;

class HomeController extends Controller
{
    public function index()
    {
        // Reviews Section: Get 5-star reviews for carousel
        $fiveStarReviews = Review::where('is_active', true)
            ->where('rating', 5)
            ->orderBy('date', 'desc')
            ->take(10)
            ->get();

        // Total active reviews count
        $totalReviews = Review::where('is_active', true)->count();

        // Avatar colors for reviews
        $avatarColors = ['#4285F4', '#EA4335', '#FBBC05', '#34A853', '#FF6D01', '#46BDC6', '#7B1FA2', '#C2185B', '#00ACC1', '#8E24AA'];

        // FAQ Preview Section: Get FAQs ordered by category position, then faq position
        $faqCategories = FaqCategory::with(['faqs' => function($q) {
            $q->where('is_active', true)->orderBy('position');
        }])
        ->where('is_active', true)
        ->orderBy('position')
        ->get();

        // Flatten FAQs untuk preview (max 7)
        $previewFaqs = collect();
        foreach($faqCategories as $category) {
            foreach($category->faqs as $faq) {
                if($previewFaqs->count() < 7) {
                    $previewFaqs->push($faq);
                }
            }
        }

        return view('public.home', compact('fiveStarReviews', 'totalReviews', 'avatarColors', 'previewFaqs'));
    }
}