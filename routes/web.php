<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ComicController as AdminComicController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryBrowserController;
use App\Http\Controllers\ComicBrowserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RentalBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');

Route::get('/komik', [ComicBrowserController::class, 'index'])->name('catalog');
Route::get('/komik/{comic:slug}', [ComicBrowserController::class, 'show'])->name('catalog.show');
Route::get('/kategori', [CategoryBrowserController::class, 'index'])->name('categories.list');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('/sewa', [RentalBookingController::class, 'index'])->name('rentals.index');
    Route::get('/sewa/buat', [RentalBookingController::class, 'create'])->name('rentals.create');
    Route::post('/sewa', [RentalBookingController::class, 'store'])->name('rentals.store');
});

Route::middleware(['auth', 'role:admin,staff'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('index');
        Route::resource('categories', AdminCategoryController::class)->except('show');
        Route::resource('comics', AdminComicController::class)->except('show');
        Route::resource('rentals', AdminRentalController::class)->only(['index', 'show', 'update', 'destroy']);
    });
