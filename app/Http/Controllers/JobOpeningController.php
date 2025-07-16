<?php

namespace App\Http\Controllers;

use App\Helpers\AuditHelper;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobOpeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = JobOpening::latest()->get();
        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
            'date_needed' => 'required|date',
            'date_expiry' => 'required|date|after_or_equal:date_needed',
            'status' => 'required|in:Active,Inactive,Expired',
            'location' => 'required|string|max:255',
        ]);

        $data['user_id'] = Auth::id();

        $job = JobOpening::create($data);

        AuditHelper::log('Created', 'Job Openings', 'Created job: ' . $job->job_title);
        return redirect()->route('jobs.index')->with('success', 'Job opening created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobOpening $job)
    {
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobOpening $job)
    {
        $data = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'required|string',
            'date_needed' => 'required|date',
            'date_expiry' => 'required|date|after_or_equal:date_needed',
            'status' => 'required|in:Active,Inactive,Expired',
            'location' => 'required|string|max:255',
        ]);

        $job->update($data);

        AuditHelper::log('Updated', 'Job Openings', 'Updated job: ' . $job->job_title);
        return redirect()->route('jobs.index')->with('success', 'Job updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobOpening $job)
    {
        $jobTitle = $job->job_title;

        $job->delete();

        AuditHelper::log('Deleted', 'Job Openings', 'Deleted job: ' . $jobTitle);
        return redirect()->route('jobs.index')->with('success', 'Job deleted.');
    }
}
