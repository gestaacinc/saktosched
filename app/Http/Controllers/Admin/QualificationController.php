<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    public function index()
    {
        $qualifications = Qualification::latest()->paginate(10);
        return view('admin.qualifications.index', compact('qualifications'));
    }

    public function create()
    {
        return view('admin.qualifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assessment_fee' => 'required|numeric|min:0',
        ]);

        Qualification::create($request->all());

        return redirect()->route('admin.qualifications.index')
                         ->with('success', 'Qualification created successfully.');
    }

    public function edit(Qualification $qualification)
    {
        return view('admin.qualifications.edit', compact('qualification'));
    }

    public function update(Request $request, Qualification $qualification)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assessment_fee' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        $qualification->update($request->all());

        return redirect()->route('admin.qualifications.index')
                         ->with('success', 'Qualification updated successfully.');
    }

    public function destroy(Qualification $qualification)
    {
        $qualification->delete();

        return redirect()->route('admin.qualifications.index')
                         ->with('success', 'Qualification deleted successfully.');
    }
}