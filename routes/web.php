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
use App\Http\Controllers\TollController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC ROUTES (Guest + Auth) ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews');

// Public: Packages & FAQs (accessible by anyone)
Route::get('/packages', [PackagesController::class, 'publicIndex'])->name('packages');
Route::get('/faqs', [FaqsController::class, 'publicIndex'])->name('faqs.public');

// --- ADMIN ROUTES (Auth + Permission) ---
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Clients (CEO & CMO only - gate: manage-crm)
    Route::resource('admin/clients', ClientsController::class)
        ->except(['show'])
        ->names([
            'index'   => 'admin.clients.index',
            'create'  => 'admin.clients.create',
            'store'   => 'admin.clients.store',
            'edit'    => 'admin.clients.edit',
            'update'  => 'admin.clients.update',
            'destroy' => 'admin.clients.destroy',
        ]);
    
    // Partners (CEO & CMO only - gate: manage-crm)
    Route::resource('admin/partners', PartnersController::class)
        ->except(['show'])
        ->names([
            'index'   => 'admin.partners.index',
            'create'  => 'admin.partners.create',
            'store'   => 'admin.partners.store',
            'edit'    => 'admin.partners.edit',
            'update'  => 'admin.partners.update',
            'destroy' => 'admin.partners.destroy',
        ]);
    
    // Packages (CEO, CFO, COO - gate: manage-operations)
    Route::resource('admin/packages', PackagesController::class)
        ->except(['show'])
        ->names([
            'index'   => 'admin.packages.index',
            'create'  => 'admin.packages.create',
            'store'   => 'admin.packages.store',
            'edit'    => 'admin.packages.edit',
            'update'  => 'admin.packages.update',
            'destroy' => 'admin.packages.destroy',
        ]);
    
    // Events (CEO, CFO, COO - gate: manage-operations)
    Route::resource('admin/events', EventsController::class)
        ->except(['show'])
        ->names([
            'index'   => 'admin.events.index',
            'create'  => 'admin.events.create',
            'store'   => 'admin.events.store',
            'edit'    => 'admin.events.edit',
            'update'  => 'admin.events.update',
            'destroy' => 'admin.events.destroy',
        ]);
    
    // FAQs (All admin roles - gate: manage-content)
    Route::resource('admin/faqs', FaqsController::class)
        ->except(['show'])
        ->names([
            'index'   => 'admin.faqs.index',
            'create'  => 'admin.faqs.create',
            'store'   => 'admin.faqs.store',
            'edit'    => 'admin.faqs.edit',
            'update'  => 'admin.faqs.update',
            'destroy' => 'admin.faqs.destroy',
        ]);
    
    // FAQ Categories (All admin roles - gate: manage-content)
    Route::resource('admin/faq-categories', FaqCategoriesController::class)
        ->except(['show'])
        ->names([
            'index'   => 'admin.faq-categories.index',
            'create'  => 'admin.faq-categories.create',
            'store'   => 'admin.faq-categories.store',
            'edit'    => 'admin.faq-categories.edit',
            'update'  => 'admin.faq-categories.update',
            'destroy' => 'admin.faq-categories.destroy',
        ]);

    // Toll Calculator (Admin only)
    Route::get('/admin/toll', [TollController::class, 'index'])->name('admin.toll.index');
    Route::post('/admin/toll/calculate', [TollController::class, 'calculate'])->name('admin.toll.calculate');

});

require __DIR__.'/auth.php';
