<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    public function show(Qualification $qualification)
    {
        // THE FIX: Use withSum() instead of withCount()
        $schedules = $qualification->assessmentSchedules()
            ->where('status', 'pending')
            ->withSum('bookings', 'slots_reserved') // This correctly sums the slots
            ->orderBy('schedule_date', 'asc')
            ->get();
        
        $allQualifications = Qualification::where('is_active', true)->orderBy('title')->get();

        return view('qualifications.show', compact('qualification', 'schedules', 'allQualifications'));
    }
}
