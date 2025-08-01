<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QualificationController as AdminQualificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InstitutionalInquiryController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Show a single qualification and its schedules
Route::get('/qualifications/{qualification}', [QualificationController::class, 'show'])->name('qualifications.show');

// Handle the booking form submission
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');

// Dashboard route from Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('qualifications', AdminQualificationController::class);

     // This is the new line to add
    // Replace the old inquiry route with this resource route
    Route::resource('inquiries', InstitutionalInquiryController::class)->only(['index', 'show', 'update']);
    // Add route for viewing inquiries in admin panel later
});

// Institutional Inquiry Routes
Route::get('/inquiry', [InstitutionalInquiryController::class, 'create'])->name('inquiry.create');
Route::post('/inquiry', [InstitutionalInquiryController::class, 'store'])->name('inquiry.store');


require __DIR__.'/auth.php';



