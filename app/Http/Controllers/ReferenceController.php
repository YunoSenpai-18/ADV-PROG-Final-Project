<?php

namespace App\Http\Controllers;

use App\Helpers\AuditHelper;
use App\Models\Applicant;
use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
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
        return view('references.create', compact('applicant'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Applicant $applicant)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'company' => 'required|string',
            'number' => 'required|string',
            'email' => 'required|email',
        ]);

        $applicant->references()->create($data);

        AuditHelper::log('Created', 'Reference', 'Added reference for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Reference added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reference $reference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant, Reference $reference)
    {
        return view('references.edit', compact('applicant', 'reference'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Applicant $applicant, Reference $reference)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'position' => 'required|string',
            'company' => 'required|string',
            'number' => 'required|string',
            'email' => 'required|email',
        ]);

        $reference->update($data);

        AuditHelper::log('Updated', 'Reference', 'Updated reference for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Reference updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant, Reference $reference)
    {
        $reference->delete();

        AuditHelper::log('Deleted', 'Reference', 'Deleted reference for applicant: ' . $applicant->full_name);
        return redirect()->route('applicants.show', $applicant)->with('success', 'Reference deleted.');
    }
}
