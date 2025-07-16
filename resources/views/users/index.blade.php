@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">User Management</h2>

    @forelse($users as $user)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title mb-1">{{ $user->name }}</h5>
                <p class="mb-0"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="mb-0"><strong>Registered At:</strong> {{ $user->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>
    @empty
        <p>No users found.</p>
    @endforelse
</div>
@endsection
