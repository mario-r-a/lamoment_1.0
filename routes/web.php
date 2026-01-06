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
use App\Http\Controllers\InventoryItemsController;
use App\Http\Controllers\InventoryUnitsController;
use App\Http\Controllers\FundRequestsController;
use Illuminate\Support\Facades\Route;

// --- PUBLIC ROUTES (Guest + Auth) ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// PUBLIC reviews routes (visible to guests)
Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews');
Route::post('/reviews', [ReviewsController::class, 'store'])->name('reviews.store');
Route::get('/reviews/more', [ReviewsController::class, 'more'])->name('reviews.more');

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

    // Inventory Items (CEO, CFO, COO - gate: manage-operations)
    Route::resource('admin/inventory-items', InventoryItemsController::class)
        ->except(['show'])
        ->names([
            'index'   => 'admin.inventory-items.index',
            'create'  => 'admin.inventory-items.create',
            'store'   => 'admin.inventory-items.store',
            'edit'    => 'admin.inventory-items.edit',
            'update'  => 'admin.inventory-items.update',
            'destroy' => 'admin.inventory-items.destroy',
        ]);

    // Inventory Units (CEO, CFO, COO - gate: manage-operations)
    Route::resource('admin/inventory-units', InventoryUnitsController::class)
        ->except(['show'])
        ->names([
            'index'   => 'admin.inventory-units.index',
            'create'  => 'admin.inventory-units.create',
            'store'   => 'admin.inventory-units.store',
            'edit'    => 'admin.inventory-units.edit',
            'update'  => 'admin.inventory-units.update',
            'destroy' => 'admin.inventory-units.destroy',
        ]);

    // Fund Requests (CEO & CFO - gate: manage-finance)
    Route::resource('admin/fund-requests', FundRequestsController::class)
        ->except(['show'])
        ->names([
            'index'   => 'admin.fund-requests.index',
            'create'  => 'admin.fund-requests.create',
            'store'   => 'admin.fund-requests.store',
            'edit'    => 'admin.fund-requests.edit',
            'update'  => 'admin.fund-requests.update',
            'destroy' => 'admin.fund-requests.destroy',
        ]);
    
    // Admin-only review actions
    Route::middleware(['auth'])->group(function () {
        Route::middleware(['can:manage-content'])->group(function () {
            Route::post('/admin/reviews/toggle-submission', [ReviewsController::class, 'toggleSubmission'])
                ->name('admin.reviews.toggle-submission');
            Route::put('/admin/reviews/{review}', [ReviewsController::class, 'update'])
                ->name('admin.reviews.update');
            Route::delete('/admin/reviews/{review}', [ReviewsController::class, 'destroy'])
                ->name('admin.reviews.destroy');

            // Admin create review (manual)
            Route::post('/admin/reviews', [ReviewsController::class, 'adminStore'])
                ->name('admin.reviews.store');
        });
    });

});

require __DIR__.'/auth.php';

// Temporary debug route - REMOVE IN PRODUCTION
Route::get('/debug-css', function () {
    $stylePath = public_path('css/style.css');
    $styleUrl = asset('css/style.css');
    
    $cssFiles = [
        'style.css' => public_path('css/style.css'),
        'base/variables.css' => public_path('css/base/variables.css'),
        'base/fonts.css' => public_path('css/base/fonts.css'),
        'components/navbar.css' => public_path('css/components/navbar.css'),
    ];
    
    $results = [];
    foreach ($cssFiles as $name => $path) {
        $results[$name] = [
            'exists' => file_exists($path),
            'size' => file_exists($path) ? filesize($path) : 0,
            'readable' => file_exists($path) && is_readable($path),
            'url' => asset('css/' . $name),
        ];
    }
    
    return response()->json([
        'status' => 'OK',
        'asset_url_function' => $styleUrl,
        'public_path' => public_path(),
        'css_files' => $results,
        'app_url' => config('app.url'),
        'view_test' => view('layouts.mainlayout')->render() ? 'Rendered successfully' : 'Render failed',
    ]);
});
