@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Applicant Reports</h2>

    <form method="GET" class="row mb-4">
        <div class="col-md-3">
            <label>Start Date</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label>End Date</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                <option value="">-- All --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="">-- All --</option>
                @foreach(['Line up', 'On Process', 'For Interview', 'For Medical', 'Deployed'] as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('reports.applicants') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <hr>

    <h5>Results ({{ $applications->count() }})</h5>

    @forelse($applications as $app)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Applicant:</strong> {{ $app->applicant->full_name }}</p>
                <p><strong>Job:</strong> {{ $app->job->job_title }}</p>
                <p><strong>Status:</strong> {{ $app->status }}</p>
                <p><strong>Created By:</strong> {{ $app->user->name }}</p>
                <p><strong>Date:</strong> {{ $app->created_at->format('F d, Y') }}</p>
            </div>
        </div>
    @empty
        <p>No applications found.</p>
    @endforelse
</div>
@endsection
