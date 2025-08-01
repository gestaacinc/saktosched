<?php

namespace App\Http\Controllers;

use App\Models\AssessmentSchedule;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:assessment_schedules,id',
        ]);

        $schedule = AssessmentSchedule::withCount('bookings')->findOrFail($request->schedule_id);

        if ($schedule->bookings_count >= $schedule->max_slots) {
            return back()->with('error', 'Sorry, this schedule is already full.');
        }

        Booking::create([
            'user_id' => Auth::id(),
            'assessment_schedule_id' => $schedule->id,
            'slots_reserved' => 1,
            'reservation_fee_paid' => 35.00,
            'payment_status' => 'reservation_paid',
        ]);

        return redirect()->route('home')->with('success', 'Your slot has been successfully reserved!');
    }
}