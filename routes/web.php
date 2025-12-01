<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\AdminStoryController as AdminStoryController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Models\Story;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('public.products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('public.products.show');
Route::get('/product/create', [ProductController::class, 'create'])->name('public.products.create');

Route::get('/story', [StoryController::class, 'index'])->name('story.index');
Route::get('/story/{slug}', [StoryController::class, 'show'])->name('story.show');
Route::get('/story/tag/{tag}', [StoryController::class, 'tag'])->name('story.tag');

// Filter cerita berdasarkan kategori
Route::get('/category/{category}', [StoryController::class, 'category'])->name('category.show');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ============================
// ADMIN ROUTES (Guard: admin)
// ============================

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Product Management
        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
        Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

        // Activity Logs
        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity.logs.index');

        // Admin Profile
        Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/stories', [AdminStoryController::class, 'index'])->name('stories.index');
        Route::get('/stories/create', [AdminStoryController::class, 'create'])->name('stories.create');
        Route::post('/stories', [AdminStoryController::class, 'store'])->name('stories.store');
        Route::get('/stories/{story}/edit', [AdminStoryController::class, 'edit'])->name('stories.edit');
        Route::get('/stories/{story}/show', [AdminStoryController::class, 'show'])->name('stories.show');
        Route::put('/stories/{story}', [AdminStoryController::class, 'update'])->name('stories.update');
        Route::delete('/stories/{story}', [AdminStoryController::class, 'destroy'])->name('stories.destroy');
    });


// ============================
// USER ROUTES (Guard: web)
// ============================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
