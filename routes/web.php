<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TuitionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [TuitionController::class, 'index']); // Homepage with tuition listings

// Authentication Routes
Auth::routes();

// Home Dashboard Route (After Login)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Routes for Tutors (Protected)
Route::middleware(['auth'])->group(function () {
    Route::resource('tuitions', TuitionController::class)->except(['index', 'show']);
});


// Viewing Tuition Listings (Public)
Route::get('/tuitions', [TuitionController::class, 'index'])->name('tuitions.index');
Route::get('/tuitions/{tuition}', [TuitionController::class, 'show'])->name('tuitions.show');

