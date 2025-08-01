<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qualification;

class QualificationController extends Controller
{
    //
    public function show(Qualification $qualification)
    {
        // Eager load schedules with the count of reserved slots
        $schedules = $qualification->assessmentSchedules()
            ->withCount('bookings')
            ->where('status', 'pending')
            ->get();

        return view('qualifications.show', [
            'qualification' => $qualification,
            'schedules' => $schedules,
        ]);
    }
}
