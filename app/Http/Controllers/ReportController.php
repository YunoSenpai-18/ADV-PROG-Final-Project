<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\JobOpening;
use App\Models\AuditLog;
use App\Models\User;

class ReportController extends Controller
{
    public function applicantReport(Request $request)
    {
        $query = Application::with(['user', 'applicant', 'job']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->latest()->get();
        $users = User::all();

        return view('reports.applicants', compact('applications', 'users'));
    }

    public function jobReport(Request $request)
    {
        $query = JobOpening::with('user');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jobs = $query->latest()->get();
        $users = User::all();

        return view('reports.jobs', compact('jobs', 'users'));
    }

    public function auditTrail(Request $request)
    {
        $query = AuditLog::with('user');

        // Filters
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59',
            ]);
        }

        $logs = $query->latest()->get();
        $users = \App\Models\User::all();
        $modules = AuditLog::select('module')->distinct()->pluck('module');

        return view('reports.audit', compact('logs', 'users', 'modules'));
    }
}