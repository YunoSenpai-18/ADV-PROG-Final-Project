<?php

use Illuminate\Support\Facades\Route;
use App\Models\Applicant;
use App\Models\JobOpening;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\EmploymentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\JobOpeningController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes (login, register, etc.)
Auth::routes();

// Redirect /home to dashboard
Route::get('/home', function () {
    return redirect()->route('applicants.index');
});

// Main authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $applicantsCount = Applicant::count();
        $jobsCount = JobOpening::count();
        return view('dashboard', compact('applicantsCount', 'jobsCount'));
    })->name('dashboard');

    Route::resource('users', UserController::class)->middleware('auth');
    Route::resource('applicants', ApplicantController::class);
    Route::get('/applicants/{applicant}/medical', [App\Http\Controllers\ApplicantController::class, 'showMedical'])->name('applicants.medical');
    Route::resource('applicants.educations', EducationController::class);
    Route::resource('applicants.employments', EmploymentController::class)->except(['index', 'show']);
    Route::resource('applicants.payments', PaymentController::class)->except(['index', 'show']);
    Route::resource('applicants.references', ReferenceController::class)->except(['index', 'show']);
    Route::resource('jobs', JobOpeningController::class);
    Route::resource('applications', ApplicationController::class);
});

Route::middleware('auth')->prefix('reports')->group(function () {
    Route::get('/applicants', [ReportController::class, 'applicantReport'])->name('reports.applicants');
    Route::get('/jobs', [ReportController::class, 'jobReport'])->name('reports.jobs');
    Route::get('/audit-trail', [ReportController::class, 'auditTrail'])->name('reports.audit');
});
