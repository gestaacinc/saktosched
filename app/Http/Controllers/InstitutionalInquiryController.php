<?php

namespace App\Http\Controllers;

use App\Models\InstitutionalInquiry;
use App\Models\Qualification;
use Illuminate\Http\Request;

class InstitutionalInquiryController extends Controller
{
    public function create()
    {
        $qualifications = Qualification::where('is_active', true)->get();
        return view('inquiry.create', compact('qualifications'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'representative_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'qualification_id' => 'required|exists:qualifications,id',
            'num_applicants' => 'required|integer|min:1',
        ]);

        InstitutionalInquiry::create($request->all());

        return redirect()->route('home')->with('success', 'Your inquiry has been submitted! Our team will contact you shortly.');
    }
}
