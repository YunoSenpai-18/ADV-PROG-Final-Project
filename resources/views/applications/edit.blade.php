@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Job Application</h2>

    <form method="POST" action="{{ route('applications.update', $application->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="applicant_id" class="form-label">Applicant</label>
            <select name="applicant_id" id="applicant_id" class="form-control" required>
                <option value="">Select Applicant</option>
                @foreach($applicants as $applicant)
                    <option value="{{ $applicant->id }}" 
                        {{ old('applicant_id', $application->applicant_id) == $applicant->id ? 'selected' : '' }}>
                        {{ $applicant->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="job_id" class="form-label">Job</label>
            <select name="job_id" id="job_id" class="form-control" required>
                <option value="">Select Job</option>
                @foreach($jobs as $job)
                    <option value="{{ $job->id }}"
                        {{ old('job_id', $application->job_id) == $job->id ? 'selected' : '' }}>
                        {{ $job->job_title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="payment_status" class="form-label">Payment Status</label>
            <select name="payment_status" id="payment_status" class="form-control" required>
                <option value="">Select Payment Status</option>
                {{-- dynamically filled with JS --}}
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Application Status</label>
            <select name="status" id="status" class="form-control" required>
                @foreach(['Line up', 'On Process', 'For Interview', 'For Medical', 'Deployed'] as $status)
                    <option value="{{ $status }}" 
                        {{ old('status', $application->status) == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('applications.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    const paymentStatusMap = @json($paymentStatuses);
    const applicantSelect = document.getElementById('applicant_id');
    const paymentStatusSelect = document.getElementById('payment_status');
    const currentPaymentStatus = @json(old('payment_status', $application->payment_status));

    function populatePaymentStatus(applicantId) {
        paymentStatusSelect.innerHTML = '<option value="">Select Payment Status</option>';
        const status = paymentStatusMap[applicantId];

        if (status === 'Paid') {
            const option = new Option('Paid', 'Paid');
            if (currentPaymentStatus === 'Paid') option.selected = true;
            paymentStatusSelect.add(option);
        } else if (status === 'Unpaid') {
            const option = new Option('Unpaid', 'Unpaid');
            if (currentPaymentStatus === 'Unpaid') option.selected = true;
            paymentStatusSelect.add(option);
        }
    }

    applicantSelect.addEventListener('change', function () {
        populatePaymentStatus(this.value);
    });

    // Trigger on load
    window.addEventListener('load', function () {
        const selected = applicantSelect.value;
        if (selected) {
            populatePaymentStatus(selected);
        }
    });
</script>
@endsection
