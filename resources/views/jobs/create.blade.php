@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Job Opening</h2>

    <form method="POST" action="{{ route('jobs.store') }}">
        @csrf

        <div class="mb-3">
            <label>Job Title</label>
            <input type="text" name="job_title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Job Description</label>
            <textarea name="job_description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Date Needed</label>
            <input type="date" name="date_needed" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date Expiry</label>
            <input type="date" name="date_expiry" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Expired">Expired</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
