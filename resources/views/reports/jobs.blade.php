@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Job Reports</h2>

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
                <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="Expired" {{ request('status') == 'Expired' ? 'selected' : '' }}>Expired</option>
            </select>
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('reports.jobs') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <hr>

    <h5>Results ({{ $jobs->count() }})</h5>

    @forelse($jobs as $job)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Title:</strong> {{ $job->job_title }}</p>
                <p><strong>Description:</strong> {{ Str::limit($job->job_description, 100) }}</p>
                <p><strong>Location:</strong> {{ $job->location }}</p>
                <p><strong>Status:</strong> <span class="badge bg-secondary">{{ $job->status }}</span></p>
                <p><strong>Created by:</strong> {{ $job->user->name }}</p>
                <p><strong>Date:</strong> {{ $job->created_at->format('F d, Y') }}</p>
            </div>
        </div>
    @empty
        <p>No jobs found.</p>
    @endforelse
</div>
@endsection
