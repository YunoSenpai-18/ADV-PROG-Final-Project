@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Job Applications</h2>

    <a href="{{ route('applications.create') }}" class="btn btn-primary mb-4">+ New Application</a>

    @forelse($applications as $application)
        <div class="card mb-3">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <strong>{{ $application->applicant->full_name }}</strong>
                <span>{{ $application->job->job_title }}</span>
            </div>

            <div class="card-body">
                <p><strong>Location:</strong> {{ $application->job->location }}</p>
                <p><strong>Status:</strong>
                    <span class="badge 
                        @if($application->status === 'Deployed') bg-success
                        @elseif($application->status === 'For Interview') bg-warning
                        @elseif($application->status === 'For Medical') bg-info
                        @elseif($application->status === 'On Process') bg-primary
                        @else bg-secondary
                        @endif">
                        {{ $application->status }}
                    </span>
                </p>
                <p><strong>Payment Status:</strong>
                    <span class="badge {{ $application->payment_status === 'Paid' ? 'bg-success' : 'bg-danger' }}">
                        {{ $application->payment_status }}
                    </span>
                </p>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('applications.edit', $application->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this application?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p>No job applications found.</p>
    @endforelse
</div>
@endsection
