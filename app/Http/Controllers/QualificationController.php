<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    public function show(Qualification $qualification)
    {
        $schedules = $qualification->assessmentSchedules()
            ->where('status', 'pending')
            ->withCount('bookings')
            ->orderBy('schedule_date', 'asc')
            ->get();
        
        $allQualifications = Qualification::where('is_active', true)->orderBy('title')->get();

        return view('qualifications.show', compact('qualification', 'schedules', 'allQualifications'));
    }
}