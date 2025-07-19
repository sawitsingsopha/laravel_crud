@extends('layouts.app')
@section('content')
<div class="max-w-xl p-6 mx-auto">
    <h2 class="mb-4 text-xl font-bold">User Details</h2>
    <div class="space-y-4">
        <div>
            <strong>Name:</strong> {{ $user->name }}
        </div>
        <div>
            <strong>Email:</strong> {{ $user->email }}
        </div>
        <div>
            <strong>Role:</strong> {{ $user->user_level_name ?? '-' }}
        </div>
    </div>
    <div class="mt-6">
        <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline">&larr; Back to List</a>
    </div>
</div>
@endsection

