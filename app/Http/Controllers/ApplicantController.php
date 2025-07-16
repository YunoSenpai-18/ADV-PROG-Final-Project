<?php

namespace App\Http\Controllers;

use App\Helpers\AuditHelper;
use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applicants = Applicant::latest()->get();
        return view('applicants.index', compact('applicants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('applicants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'sex' => 'required|in:Male,Female',
            'medical_clearance' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('medical_clearance')) {
            $data['medical_clearance_path'] = $request->file('medical_clearance')->store('clearances', 'public');
        }

        $applicant = Applicant::create($data);

        AuditHelper::log('Created', 'Applicants', 'Created applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Applicant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Applicant $applicant)
    {
        return view('applicants.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant)
    {
        return view('applicants.edit', compact('applicant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'birthdate' => 'required|date',
            'address' => 'required|string',
            'sex' => 'required|in:Male,Female',
            'medical_clearance' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('medical_clearance')) {
            $data['medical_clearance_path'] = $request->file('medical_clearance')->store('clearances', 'public');
        }

        $applicant->update($data);

        AuditHelper::log('Updated', 'Applicants', 'Updated applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.index')->with('success', 'Applicant updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        $applicant->delete();
        AuditHelper::log('Deleted', 'Applicants', 'Deleted applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.index')->with('success', 'Applicant deleted.');
    }

    public function showMedical(Applicant $applicant)
    {
        return view('applicants.medical', compact('applicant'));
    }
}
