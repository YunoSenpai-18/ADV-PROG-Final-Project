<?php

namespace App\Http\Controllers;

use App\Helpers\AuditHelper;
use App\Models\Applicant;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Applicant $applicant)
    {
        return view('educations.create', compact('applicant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Applicant $applicant)
    {
        $data = $request->validate([
            'school' => 'required|string',
            'year_level' => 'required|in:Elementary,High School,Senior High,College,Vocational',
            'school_year' => 'required|string',
        ]);

        $applicant->educations()->create($data);

        AuditHelper::log('Created', 'Education', 'Added education for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Education added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant, Education $education)
    {
        return view('educations.edit', compact('applicant', 'education'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant, Education $education)
    {
        $data = $request->validate([
            'school' => 'required|string',
            'year_level' => 'required|in:Elementary,High School,Senior High,College,Vocational',
            'school_year' => 'required|string',
        ]);

        $education->update($data);

        AuditHelper::log('Updated', 'Education', 'Updated education for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Education updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant, Education $education)
    {
        $education->delete();

        AuditHelper::log('Deleted', 'Education', 'Deleted education for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Education deleted.');
    }
}
