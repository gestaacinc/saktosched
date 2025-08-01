<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstitutionalInquiry; // <-- THIS IS THE LINE TO ADD
use App\Models\ScheduleProposal;
use App\Models\AssessmentSchedule;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pending_proposals' => ScheduleProposal::where('status', 'pending_review')->count(),
            'pending_inquiries' => InstitutionalInquiry::where('status', 'pending')->count(),
            'pending_schedules' => AssessmentSchedule::where('status', 'pending')->count(),
        ];

        $recentInquiries = InstitutionalInquiry::with('qualification')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentInquiries'));
    }
}