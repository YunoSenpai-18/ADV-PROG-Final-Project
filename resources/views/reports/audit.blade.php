@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Audit Trail</h2>

    <!-- Filter Form -->
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label>User</label>
            <select name="user_id" class="form-select">
                <option value="">All</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Module</label>
            <select name="module" class="form-select">
                <option value="">All</option>
                @foreach($modules as $module)
                    <option value="{{ $module }}" {{ request('module') == $module ? 'selected' : '' }}>
                        {{ $module }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Start Date</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>

        <div class="col-md-3">
            <label>End Date</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>

        <div class="col-12 mt-2">
            <button class="btn btn-primary" type="submit">Filter</button>
            <a href="{{ route('reports.audit') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <!-- Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Action</th>
                <th>Module</th>
                <th>Description</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $log->user->name ?? 'System' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->module }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No records found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
