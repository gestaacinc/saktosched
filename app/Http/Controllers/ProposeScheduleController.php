<?php

namespace App\Http\Controllers;

use App\Models\ScheduleProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProposeScheduleController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'qualification_id' => 'required|exists:qualifications,id',
            'schedule_date' => 'required|date|after:today',
            'proposer_name' => 'required|string|max:255',
            'proposer_email' => 'required|email|max:255',
            'proposer_phone' => 'required|string|max:20',
        ]);

        $proposal = ScheduleProposal::create([
            'user_id' => auth()->id(), // Will be null if guest
            'qualification_id' => $validatedData['qualification_id'],
            'proposed_date' => $validatedData['schedule_date'],
            'tracking_number' => 'PROP-' . strtoupper(Str::random(8)),
            'proposer_name' => $validatedData['proposer_name'],
            'proposer_email' => $validatedData['proposer_email'],
            'proposer_phone' => $validatedData['proposer_phone'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your proposal has been submitted!',
            'tracking_number' => $proposal->tracking_number,
        ]);
    }
    
    // The 'submitted' method is no longer needed for the AJAX flow, but we can keep it for now.
}
 
 