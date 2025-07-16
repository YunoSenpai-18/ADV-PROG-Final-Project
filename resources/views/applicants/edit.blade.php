@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Applicant</h2>

    <form method="POST" action="{{ route('applicants.update', $applicant->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" name="full_name" id="full_name"
                   value="{{ old('full_name', $applicant->full_name) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" name="age" id="age"
                   value="{{ old('age', $applicant->age) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="birthdate" class="form-label">Birthdate</label>
            <input type="date" name="birthdate" id="birthdate"
                   value="{{ old('birthdate', $applicant->birthdate) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address"
                   value="{{ old('address', $applicant->address) }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="sex" class="form-label">Sex</label>
            <select name="sex" id="sex" class="form-control" required>
                <option value="">Select</option>
                <option value="Male" {{ $applicant->sex === 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $applicant->sex === 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="medical_clearance" class="form-label">Medical Clearance</label>
            <input type="file" name="medical_clearance" class="form-control" id="medical_clearance">
            @if ($applicant->medical_clearance_path)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $applicant->medical_clearance_path) }}" width="100" class="img-thumbnail">
                </div>
            @endif
            @error('medical_clearance')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('applicants.show', $applicant->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
