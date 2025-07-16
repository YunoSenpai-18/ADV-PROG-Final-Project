@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Job Openings</h2>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">+ Add Job</a>

    @if($jobs->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Expiry</th>
                <th>Status</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->job_title }}</td>
                <td>{{ $job->job_description }}</td>
                <td>{{ $job->date_needed }}</td>
                <td>{{ $job->date_expiry }}</td>
                <td>{{ $job->status }}</td>
                <td>{{ $job->location }}</td>
                <td>
                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this job?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No job openings found.</p>
    @endif
</div>
@endsection
