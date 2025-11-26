<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\StoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('public.products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('public.products.show');

Route::get('/story', [StoryController::class, 'index'])->name('story.index');
Route::get('/story/{slug}', [StoryController::class, 'show'])->name('story.show');
Route::get('/story/tag/{tag}', [StoryController::class, 'tag'])->name('story.tag');

// Filter cerita berdasarkan kategori
Route::get('/category/{category}', [StoryController::class, 'category'])->name('category.show');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
