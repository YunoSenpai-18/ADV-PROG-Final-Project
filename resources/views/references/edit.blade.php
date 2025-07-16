@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Reference for {{ $applicant->full_name }}</h2>

    <form method="POST" action="{{ route('applicants.references.update', [$applicant->id, $reference->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3"><label>Name</label><input type="text" name="name" value="{{ $reference->name }}" class="form-control" required></div>
        <div class="mb-3"><label>Position</label><input type="text" name="position" value="{{ $reference->position }}" class="form-control" required></div>
        <div class="mb-3"><label>Company</label><input type="text" name="company" value="{{ $reference->company }}" class="form-control" required></div>
        <div class="mb-3"><label>Phone</label><input type="text" name="number" value="{{ $reference->number }}" class="form-control" required></div>
        <div class="mb-3"><label>Email</label><input type="email" name="email" value="{{ $reference->email }}" class="form-control" required></div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('applicants.show', $applicant->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
