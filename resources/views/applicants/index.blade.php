@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Applicants</h1>
    <a href="{{ route('applicants.create') }}" class="btn btn-primary mb-3">Add Applicant</a>

    <div class="row">
        @forelse($applicants as $applicant)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">{{ $applicant->full_name }}</div>
                <div class="card-body">
                    <p><strong>Sex:</strong> {{ $applicant->sex }}</p>
                    <p><strong>Age:</strong> {{ $applicant->age }}</p>
                    <p><strong>Birthdate:</strong> {{ $applicant->birthdate }}</p>
                    <a href="{{ route('applicants.show', $applicant->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('applicants.edit', $applicant->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('applicants.destroy', $applicant->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this applicant?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <p>No applicants found.</p>
        @endforelse
    </div>
</div>
@endsection