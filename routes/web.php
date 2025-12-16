<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\FaqCategoriesController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// FAQ page
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Tambahkan route publik bernama 'faqs' agar route('faqs') valid di view/footer
Route::get('/faqs', [FaqsController::class, 'publicIndex'])->name('faqs.public');

// Package page (public)
Route::get('/packages', [PackagesController::class, 'publicIndex'])->name('packages');

// Review page
Route::get('/review', [ReviewsController::class, 'index'])->name('reviews');

Route::middleware('auth')->group(function () {
    // Clients: Only CEO & CMO can create/update/delete (gate: manage-crm)
    Route::resource('clients', ClientsController::class)->except(['show']);
    
    // Partners: Only CEO & CMO can create/update/delete (gate: manage-crm)
    Route::resource('partners', PartnersController::class)->except(['show']);
    
    // Packages: All admin roles (CEO, CFO, CMO, COO) can create/update/delete (gate: manage-operations)
    Route::resource('packages', PackagesController::class)->except(['show', 'publicIndex']);
    
    // Events: All admin roles (CEO, CFO, CMO, COO) can create/update/delete (gate: manage-operations)
    Route::resource('events', EventsController::class)->except(['show']);
    
    // FAQs & FAQ Categories: All admin roles (CEO, CFO, CMO, COO) can access (gate: manage-content)
    Route::resource('faq-categories', FaqCategoriesController::class)->except(['show']);
    Route::resource('faqs', FaqsController::class)->except(['show', 'publicIndex']);
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard route (for admin users)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
