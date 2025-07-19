@extends('layouts.app')
@section('content')
<div class="max-w-xl p-6 mx-auto">
    <h2 class="mb-4 text-xl font-bold">Edit User</h2>
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full px-3 py-2 border rounded">
        </div>
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full px-3 py-2 border rounded">
        </div>
        <div>
            <label class="block text-sm font-medium">User Role</label>
            <select name="userlevel_id" class="w-full px-3 py-2 border rounded">
                @isset($roles)
                    @foreach ($roles as $role)
                    <option value="{{ $role->userlevel_id }}" @if($user->userlevel_id == $role->userlevel_id) selected @endif>
                        {{ $role->user_level_name }}
                    </option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Update</button>
        </div>
    </form>
</div>
@endsection
