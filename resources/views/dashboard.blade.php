@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard</h2>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Applicants</h5>
                    <p class="card-text display-6">{{ $applicantsCount }}</p>
                    <a href="{{ route('applicants.index') }}" class="btn btn-light btn-sm">View Applicants</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Job Openings</h5>
                    <p class="card-text display-6">{{ $jobsCount }}</p>
                    <a href="{{ route('jobs.index') }}" class="btn btn-light btn-sm">View Jobs</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
