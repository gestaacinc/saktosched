<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScheduleProposal;
use App\Models\AssessmentSchedule;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;  
use Illuminate\Support\Str;
use App\Mail\ProposalApproved;       
use App\Mail\ProposalRejected;      

class ScheduleProposalController extends Controller
{
    public function index()
    {
        $proposals = ScheduleProposal::with(['user', 'qualification'])
            ->where('status', 'pending_review')
            ->latest()
            ->paginate(15);
        return view('admin.proposals.index', compact('proposals'));
    }

    public function approve(ScheduleProposal $proposal)
    {
        try {
            DB::beginTransaction();

            $user = User::firstOrCreate(
                ['email' => $proposal->proposer_email],
                [
                    'name' => $proposal->proposer_name,
                    'password' => Hash::make(Str::random(12)),
                ]
            );

            $schedule = AssessmentSchedule::create([
                'qualification_id' => $proposal->qualification_id,
                'schedule_date' => $proposal->proposed_date,
                'status' => 'pending',
            ]);

            Booking::create([
                'user_id' => $user->id,
                'assessment_schedule_id' => $schedule->id,
                'slots_reserved' => 1,
                'reservation_fee_paid' => 35.00,
                'payment_status' => 'reservation_paid',
            ]);

            $proposal->update(['status' => 'approved']);

            DB::commit();

            // Send the approval email
            Mail::to($proposal->proposer_email)->send(new ProposalApproved($proposal));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to approve proposal. Error: ' . $e->getMessage());
        }

        return redirect()->route('admin.proposals.index')->with('success', 'Proposal approved and schedule created! An email has been sent to the user.');
    }

    public function reject(Request $request, ScheduleProposal $proposal)
    {
        $request->validate(['rejection_reason' => 'required|string|max:500']);

        $proposal->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        // Send the rejection email
        Mail::to($proposal->proposer_email)->send(new ProposalRejected($proposal));

        return redirect()->route('admin.proposals.index')->with('success', 'Proposal has been rejected. An email has been sent to the user.');
    }
}