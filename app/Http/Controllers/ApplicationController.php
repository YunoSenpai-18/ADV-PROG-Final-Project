<?php

namespace App\Http\Controllers;

use App\Helpers\AuditHelper;
use App\Models\Application;
use App\Models\Applicant;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::with(['applicant', 'job'])->latest()->get();
        return view('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $applicants = Applicant::with('payments')->get();
        $jobs = JobOpening::all();

        $paymentStatuses = $applicants->mapWithKeys(function ($applicant) {
            return [$applicant->id => $applicant->payments->count() > 0 ? 'Paid' : 'Unpaid'];
        });

        return view('applications.create', compact('applicants', 'jobs', 'paymentStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'applicant_id' => 'required|exists:applicants,id',
            'job_id' => 'required|exists:job_openings,id',
            'status' => 'required|in:Line up,On Process,For Interview,For Medical,Deployed',
            'payment_status' => 'required|in:Paid,Unpaid',
        ]);

        $data['user_id'] = Auth::id();

        $application = Application::create($data);

        $applicant = Applicant::find($data['applicant_id']);
        $job = JobOpening::find($data['job_id']);

        AuditHelper::log('Created', 'Applications', 'Created application for applicant: ' . $applicant->full_name . ' to job: ' . $job->job_title);
        return redirect()->route('applications.index')->with('success', 'Application created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        $applicants = Applicant::with('payments')->get();
        $jobs = JobOpening::all();

        $paymentStatuses = $applicants->mapWithKeys(function ($applicant) {
            return [$applicant->id => $applicant->payments->count() > 0 ? 'Paid' : 'Unpaid'];
        });

        return view('applications.edit', compact('application', 'applicants', 'jobs', 'paymentStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $data = $request->validate([
            'applicant_id' => 'required|exists:applicants,id',
            'job_id' => 'required|exists:job_openings,id',
            'status' => 'required|in:Line up,On Process,For Interview,For Medical,Deployed',
            'payment_status' => 'required|in:Paid,Unpaid',
        ]);

        $application->update($data);

        $applicant = Applicant::find($data['applicant_id']);
        $job = JobOpening::find($data['job_id']);

        AuditHelper::log('Updated', 'Applications', 'Updated application for applicant: ' . $applicant->full_name . ' to job: ' . $job->job_title);
        return redirect()->route('applications.index')->with('success', 'Application updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        $applicantName = $application->applicant->full_name ?? 'Unknown';
        $jobTitle = $application->job->job_title ?? 'Unknown';

        $application->delete();

        AuditHelper::log('Deleted', 'Applications', 'Deleted application for applicant: ' . $applicantName . ' to job: ' . $jobTitle);
        return redirect()->route('applications.index')->with('success', 'Application deleted.');
    }
}
