@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Payment for {{ $applicant->full_name }}</h2>

    <form method="POST" action="{{ route('applicants.payments.update', [$applicant->id, $payment->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" id="amount"
                   value="{{ old('amount', $payment->amount) }}"
                   step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="paid_on" class="form-label">Paid On</label>
            <input type="date" name="paid_on" id="paid_on"
                   value="{{ old('paid_on', $payment->paid_on) }}"
                   class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('applicants.show', $applicant->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
