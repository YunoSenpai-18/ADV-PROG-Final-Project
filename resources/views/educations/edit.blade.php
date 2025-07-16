@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Education for {{ $applicant->full_name }}</h2>

    <form method="POST" action="{{ route('applicants.educations.update', [$applicant->id, $education->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="school" class="form-label">School</label>
            <input type="text" name="school" id="school"
                   value="{{ old('school', $education->school) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="year_level" class="form-label">Year Level</label>
            <select name="year_level" id="year_level" class="form-control" required>
                <option value="">Select</option>
                <option value="Elementary" {{ $education->year_level === 'Elementary' ? 'selected' : '' }}>Elementary</option>
                <option value="High School" {{ $education->year_level === 'High School' ? 'selected' : '' }}>High School</option>
                <option value="Senior High" {{ $education->year_level === 'Senior High' ? 'selected' : '' }}>Senior High</option>
                <option value="College" {{ $education->year_level === 'College' ? 'selected' : '' }}>College</option>
                <option value="Vocational" {{ $education->year_level === 'Vocational' ? 'selected' : '' }}>Vocational</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="school_year" class="form-label">School Year</label>
            <input type="text" name="school_year" id="school_year"
                   value="{{ old('school_year', $education->school_year) }}"
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('applicants.show', $applicant->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
