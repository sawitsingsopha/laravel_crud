// ✅ Example Routes: routes/web.php

use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)
        ->middleware('check.permission:users,list');
});

// ✅ Sidebar Blade: resources/views/layouts/sidebar.blade.php

<ul>
    @if (canList('users'))
        <li>
            <a href="{{ route('users.index') }}" class="block px-4 py-2 hover:bg-gray-100">
                <i class="icon-user"></i> จัดการผู้ใช้งาน
            </a>
        </li>
    @endif
</ul>

// ✅ UserController: app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'userlevel_id' => $request->userlevel_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'userlevel_id' => $request->userlevel_id,
            'updated_at' => now(),
        ]);
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect()->route('users.index');
    }
}

// ✅ Blade Template: resources/views/users/index.blade.php

@extends('layouts.app')
@section('content')
<div class="p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Users</h2>
        <a href="{{ route('users.create') }}" class="px-4 py-2 text-white bg-blue-600 rounded">+ New User</a>
    </div>
    <table class="w-full border table-auto">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('users.show', $user->id) }}" class="text-gray-600 hover:underline">View</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="ml-2 text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="ml-2 text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


// ✅ Blade Template: resources/views/users/create.blade.php

@extends('layouts.app')
@section('content')
<div class="max-w-xl p-6 mx-auto">
    <h2 class="mb-4 text-xl font-bold">Create New User</h2>
    <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Name</label>
            <input type="text" name="name" class="w-full px-3 py-2 border rounded">
        </div>
        <div>
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" class="w-full px-3 py-2 border rounded">
        </div>
        <div>
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password" class="w-full px-3 py-2 border rounded">
        </div>
        <div>
            <label class="block text-sm font-medium">User Role</label>
            <select name="userlevel_id" class="w-full px-3 py-2 border rounded">
                @foreach ($roles as $role)
                    <option value="{{ $role->userlevel_id }}">{{ $role->user_level_name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Create</button>
        </div>
    </form>
</div>
@endsection


// ✅ Blade Template: resources/views/users/edit.blade.php

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
                @foreach ($roles as $role)
                    <option value="{{ $role->userlevel_id }}" @if($user->userlevel_id == $role->userlevel_id) selected @endif>
                        {{ $role->user_level_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded">Update</button>
        </div>
    </form>
</div>
@endsection


// ✅ Blade Template: resources/views/users/show.blade.php

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
