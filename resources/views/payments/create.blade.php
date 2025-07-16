@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Payment for {{ $applicant->full_name }}</h2>

    <form method="POST" action="{{ route('applicants.payments.store', $applicant->id) }}">
        @csrf

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" id="amount" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="paid_on" class="form-label">Paid On</label>
            <input type="date" name="paid_on" id="paid_on" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{ route('applicants.show', $applicant->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
