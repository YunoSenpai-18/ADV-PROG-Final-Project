@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Job Opening</h2>

    <form method="POST" action="{{ route('jobs.update', $job->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Job Title</label>
            <input type="text" name="job_title" value="{{ old('job_title', $job->job_title) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Job Description</label>
            <textarea name="job_description" class="form-control" rows="4" required>{{ old('job_description', $job->job_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Date Needed</label>
            <input type="date" name="date_needed" value="{{ old('date_needed', $job->date_needed) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date Expiry</label>
            <input type="date" name="date_expiry" value="{{ old('date_expiry', $job->date_expiry) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Active" {{ $job->status === 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive" {{ $job->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="Expired" {{ $job->status === 'Expired' ? 'selected' : '' }}>Expired</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" value="{{ old('location', $job->location) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
