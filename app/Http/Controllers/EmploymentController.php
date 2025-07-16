<?php

namespace App\Http\Controllers;

use App\Helpers\AuditHelper;
use App\Models\Applicant;
use App\Models\Employment;
use Illuminate\Http\Request;

class EmploymentController extends Controller
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
        return view('employments.create', compact('applicant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Applicant $applicant)
    {
        $data = $request->validate([
            'company' => 'required|string',
            'position' => 'required|string',
            'year' => 'required|string',
        ]);

        $applicant->employments()->create($data);

        AuditHelper::log('Created', 'Employment', 'Added employment for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Employment added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employment $employment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant, Employment $employment)
    {
        return view('employments.edit', compact('applicant', 'employment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant, Employment $employment)
    {
        $data = $request->validate([
            'company' => 'required|string',
            'position' => 'required|string',
            'year' => 'required|string',
        ]);

        $employment->update($data);

        AuditHelper::log('Updated', 'Employment', 'Updated employment for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Employment updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant, Employment $employment)
    {
        $employment->delete();

        AuditHelper::log('Deleted', 'Employment', 'Deleted employment for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Employment deleted.');
    }
}
