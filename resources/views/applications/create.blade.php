@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Job Application</h2>

    <form method="POST" action="{{ route('applications.store') }}">
        @csrf

        <div class="mb-3">
            <label for="applicant_id" class="form-label">Applicant</label>
            <select name="applicant_id" id="applicant_id" class="form-control" required>
                <option value="">Select Applicant</option>
                @foreach($applicants as $applicant)
                    <option value="{{ $applicant->id }}">{{ $applicant->full_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="job_id" class="form-label">Job</label>
            <select name="job_id" id="job_id" class="form-control" required>
                <option value="">Select Job</option>
                @foreach($jobs as $job)
                    <option value="{{ $job->id }}">{{ $job->job_title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="payment_status" class="form-label">Payment Status</label>
            <select name="payment_status" id="payment_status" class="form-control" required>
                <option value="">Select Payment Status</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Application Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Line up">Line up</option>
                <option value="On Process">On Process</option>
                <option value="For Interview">For Interview</option>
                <option value="For Medical">For Medical</option>
                <option value="Deployed">Deployed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <a href="{{ route('applications.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<script>
    const paymentStatusOptions = @json($paymentStatuses);

    const applicantSelect = document.getElementById('applicant_id');
    const paymentStatusSelect = document.getElementById('payment_status');

    applicantSelect.addEventListener('change', function () {
        const applicantId = this.value;
        const status = paymentStatusOptions[applicantId];

        // Reset dropdown
        paymentStatusSelect.innerHTML = '<option value="">Select Payment Status</option>';

        if (status === 'Paid') {
            paymentStatusSelect.innerHTML += '<option value="Paid">Paid</option>';
        } else if (status === 'Unpaid') {
            paymentStatusSelect.innerHTML += '<option value="Unpaid">Unpaid</option>';
        }
    });
</script>
@endsection
