@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Reference for {{ $applicant->full_name }}</h2>

    <form method="POST" action="{{ route('applicants.references.store', $applicant->id) }}">
        @csrf

        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" required></div>
        <div class="mb-3"><label>Position</label><input type="text" name="position" class="form-control" required></div>
        <div class="mb-3"><label>Company</label><input type="text" name="company" class="form-control" required></div>
        <div class="mb-3"><label>Phone</label><input type="text" name="number" class="form-control" required></div>
        <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>

        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{ route('applicants.show', $applicant->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
