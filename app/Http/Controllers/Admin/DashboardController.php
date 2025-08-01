<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pending_inquiries' => \App\Models\InstitutionalInquiry::where('status', 'pending')->count(),
            'total_qualifications' => \App\Models\Qualification::count(),
            'pending_schedules' => \App\Models\AssessmentSchedule::where('status', 'pending')->count(),
            'confirmed_schedules' => \App\Models\AssessmentSchedule::where('status', 'confirmed')->count(),
        ];

        $recentInquiries = \App\Models\InstitutionalInquiry::with('qualification')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentInquiries'));
    }
}