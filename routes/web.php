<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // ✅ Updated Dashboard Route to use DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Inventory Management Routes
    Route::prefix('items')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('items.index');
        Route::get('/create', [ItemController::class, 'create'])->name('items.create');
        Route::post('/', [ItemController::class, 'store'])->name('items.store');
        Route::get('/{item}', [ItemController::class, 'show'])->name('items.show');
        Route::get('/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::patch('/{item}', [ItemController::class, 'update'])->name('items.update');
        Route::delete('/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

        // Trash management routes
        Route::get('/trash/list', [ItemController::class, 'trash'])->name('items.trash');
        Route::post('/trash/{id}/restore', [ItemController::class, 'restore'])->name('items.restore');
        Route::delete('/trash/{id}/force-delete', [ItemController::class, 'forceDelete'])->name('items.force-delete');
    });
});

// Laravel Breeze Auth Routes
require __DIR__.'/auth.php';
