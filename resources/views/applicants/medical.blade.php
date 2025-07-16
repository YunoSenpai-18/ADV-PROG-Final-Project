@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h3 class="mb-4">Medical Clearance of {{ $applicant->full_name }}</h3>

    @if($applicant->medical_clearance_path)
        <img src="{{ asset('storage/' . $applicant->medical_clearance_path) }}" class="img-fluid" style="max-height: 600px;">
    @else
        <p>No medical clearance uploaded.</p>
    @endif

    <div class="mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">← Back</a>
    </div>
</div>
@endsection
