<?php

//======================================================================
// SPRINT 8: CORRECTED ADMIN ROUTES
//======================================================================
//
// GOAL: To fix the login redirect loop by correctly structuring the
// admin authentication routes and the protected admin dashboard routes.
//
// INSTRUCTION: Open your `routes/web.php` file and replace your
// entire admin route group with the code below.
//
//======================================================================

use App\Http\Controllers\Admin\AuthenticatedSessionController as AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\QualificationController as AdminQualificationController;
use App\Http\Controllers\Admin\InstitutionalInquiryController;
use App\Http\Controllers\Admin\ScheduleProposalController;
// --- Keep all your other 'use' statements ---
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InstitutionalInquiryController as PublicInstitutionalInquiryController;
use App\Http\Controllers\ProposeScheduleController;
use Illuminate\Support\Facades\Route;


// --- Keep all your public routes ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/qualifications/{qualification}', [QualificationController::class, 'show'])->name('qualifications.show');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/inquiry', [PublicInstitutionalInquiryController::class, 'create'])->name('inquiry.create');
Route::post('/inquiry', [PublicInstitutionalInquiryController::class, 'store'])->name('inquiry.store');
Route::post('/propose-schedule', [ProposeScheduleController::class, 'store'])->name('schedules.propose');
Route::get('/proposal-submitted/{tracking_number}', [ProposeScheduleController::class, 'submitted'])->name('schedules.proposal.submitted');


// --- START REPLACEMENT for Admin Routes ---

// This main group adds the '/admin' prefix and 'admin.' name prefix to all routes inside it.
Route::prefix('admin')->name('admin.')->group(function () {

    // Routes for GUESTS (not logged in)
    // These routes are for the login page itself.
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AdminAuthenticatedSessionController::class, 'store']);
    });

    // Routes for AUTHENTICATED ADMINS
    // These routes are protected and require the user to be a logged-in admin.
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('logout');
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('qualifications', AdminQualificationController::class);
        
        Route::resource('inquiries', InstitutionalInquiryController::class)->only(['index', 'show', 'update']);

        Route::get('/proposals', [ScheduleProposalController::class, 'index'])->name('proposals.index');
        Route::post('/proposals/{proposal}/approve', [ScheduleProposalController::class, 'approve'])->name('proposals.approve');
        Route::post('/proposals/{proposal}/reject', [ScheduleProposalController::class, 'reject'])->name('proposals.reject');
    });
    
});

// --- END REPLACEMENT ---
