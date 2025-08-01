<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstitutionalInquiry;
use Illuminate\Http\Request;

class InstitutionalInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all inquiries, with their related qualification, ordered by the newest first.
        $inquiries = InstitutionalInquiry::with('qualification')->latest()->paginate(15);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    // Add this method
    public function show(InstitutionalInquiry $inquiry)
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    // Add this method
    public function update(Request $request, InstitutionalInquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|string|in:pending,verified,proposal_sent,confirmed,rejected',
        ]);

        $inquiry->update(['status' => $request->status]);

        // Here you would typically also send an email to the representative

        return redirect()->route('admin.inquiries.index')->with('success', 'Inquiry status updated successfully.');
    }
}