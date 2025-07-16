@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Employment for {{ $applicant->full_name }}</h2>

    <form method="POST" action="{{ route('applicants.employments.update', [$applicant->id, $employment->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <input type="text" name="company" id="company"
                   value="{{ old('company', $employment->company) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" name="position" id="position"
                   value="{{ old('position', $employment->position) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <input type="text" name="year" id="year"
                   value="{{ old('year', $employment->year) }}"
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('applicants.show', $applicant->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
