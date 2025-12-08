<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ContactController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Package page
Route::get('/packages', [PackagesController::class, 'index'])->name('packages');

// Review page
Route::get('/review', [ReviewsController::class, 'index'])->name('reviews');

// FAQ page
Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs');

// Contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

require __DIR__.'/auth.php';
