@extends('layouts.app') @section('content')
<div class="container">
    <h2 class="mb-4">Applicant Resume</h2>

    <a href="{{ route('applicants.index') }}" class="btn btn-secondary mb-3">← Back to Applicants</a>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Personal Information
        </div>
        <div class="card-body">
            <p><strong>Full Name:</strong> {{ $applicant->full_name }}</p>
            <p><strong>Age:</strong> {{ $applicant->age }}</p>
            <p><strong>Birthdate:</strong> {{ \Carbon\Carbon::parse($applicant->birthdate)->format('F d, Y') }}</p>
            <p><strong>Address:</strong> {{ $applicant->address }}</p>
            <p><strong>Sex:</strong> {{ $applicant->sex }}</p>

            @if($applicant->medical_clearance_path)
            <p><strong>Medical Clearance:</strong></p>
            <a href="{{ route('applicants.medical', $applicant->id) }}">
                <img src="{{ asset('storage/' . $applicant->medical_clearance_path) }}" width="150" class="img-thumbnail" />
            </a>
            @endif

            <div class="mt-3">
                <a href="{{ route('applicants.edit', $applicant->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('applicants.destroy', $applicant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this applicant?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">Education</div>
        <div class="card-body">
            <a href="{{ route('applicants.educations.create', $applicant->id) }}" class="btn btn-sm btn-primary mb-3">+ Add Education</a>

            @if($applicant->educations->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>School</th>
                        <th>Year Level</th>
                        <th>School Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicant->educations as $education)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $education->school }}</td>
                        <td>{{ $education->year_level }}</td>
                        <td>{{ $education->school_year }}</td>
                        <td>
                            <a href="{{ route('applicants.educations.edit', [$applicant->id, $education->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('applicants.educations.destroy', [$applicant->id, $education->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete education?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No education records yet.</p>
            @endif
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">Employment History</div>
        <div class="card-body">
            <a href="{{ route('applicants.employments.create', $applicant->id) }}" class="btn btn-sm btn-primary mb-3">+ Add Employment</a>

            @if($applicant->employments->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Company</th>
                        <th>Position</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicant->employments as $employment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employment->company }}</td>
                        <td>{{ $employment->position }}</td>
                        <td>{{ $employment->year }}</td>
                        <td>
                            <a href="{{ route('applicants.employments.edit', [$applicant->id, $employment->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('applicants.employments.destroy', [$applicant->id, $employment->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this employment?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No employment records yet.</p>
            @endif
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">Payments</div>
        <div class="card-body">
            <a href="{{ route('applicants.payments.create', $applicant->id) }}" class="btn btn-sm btn-primary mb-3">+ Add Payment</a>

            @if($applicant->payments->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Paid On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicant->payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>₱{{ number_format($payment->amount, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->paid_on)->format('F d, Y') }}</td>
                        <td>
                            <a href="{{ route('applicants.payments.edit', [$applicant->id, $payment->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('applicants.payments.destroy', [$applicant->id, $payment->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this payment?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No payment records yet.</p>
            @endif
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">References</div>
        <div class="card-body">
            <a href="{{ route('applicants.references.create', $applicant->id) }}" class="btn btn-sm btn-primary mb-3">+ Add Reference</a>

            @if($applicant->references->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Company</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicant->references as $reference)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $reference->name }}</td>
                        <td>{{ $reference->position }}</td>
                        <td>{{ $reference->company }}</td>
                        <td>{{ $reference->number }}</td>
                        <td>{{ $reference->email }}</td>
                        <td>
                            <a href="{{ route('applicants.references.edit', [$applicant->id, $reference->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('applicants.references.destroy', [$applicant->id, $reference->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this reference?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No reference records yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection