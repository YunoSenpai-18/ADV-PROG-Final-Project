@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Education for {{ $applicant->full_name }}</h2>

    <form method="POST" action="{{ route('applicants.educations.store', $applicant->id) }}">
        @csrf

        <div class="mb-3">
            <label for="school" class="form-label">School</label>
            <input type="text" name="school" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="year_level" class="form-label">Year Level</label>
            <select name="year_level" class="form-control" required>
                <option value="">Select</option>
                <option>Elementary</option>
                <option>High School</option>
                <option>Senior High</option>
                <option>College</option>
                <option>Vocational</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="school_year" class="form-label">School Year</label>
            <input type="text" name="school_year" class="form-control" placeholder="e.g. 2019-2023" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('applicants.show', $applicant->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
