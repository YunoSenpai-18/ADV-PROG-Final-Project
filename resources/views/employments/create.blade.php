@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Employment for {{ $applicant->full_name }}</h2>

    <form method="POST" action="{{ route('applicants.employments.store', $applicant->id) }}">
        @csrf

        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <input type="text" name="company" id="company" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" name="position" id="position" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="text" name="year" id="year" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{ route('applicants.show', $applicant->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
