@extends('layouts.app')

@section('content')
<div class="container px-4 mx-auto">
    <div class="max-w-4xl p-6 mx-auto bg-white rounded shadow">
        <h2 class="mb-4 text-xl font-bold">ตั้งค่าสิทธิ์สำหรับ: {{ $role->user_level_name }}</h2>

        <form action="{{ route('userlevel.permissions.update', $role->userlevel_id) }}" method="POST">
            @csrf

            <table class="w-full text-sm text-left border table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">เมนู</th>
                        <th class="px-4 py-2 text-center border">List / View</th>
                        <th class="px-4 py-2 text-center border">Add</th>
                        <th class="px-4 py-2 text-center border">Edit</th>
                        <th class="px-4 py-2 text-center border">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 font-medium capitalize border">
                            {{ $model }}
                        </td>
                        @foreach ($methods as $method)
                        <td class="px-4 py-2 text-center border">
                            <input type="checkbox" name="permissions[{{ $model }}][{{ $method }}]" class="w-4 h-4 text-indigo-600 rounded form-checkbox" {{ $permissions->contains('access_model', $model) && $permissions->contains('access_method', $method) ? 'checked' : '' }}>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-end mt-6">
                <a href="{{ route('userlevel.index') }}" class="px-4 py-2 mr-2 bg-gray-200 rounded hover:bg-gray-300">ย้อนกลับ</a>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    บันทึกสิทธิ์
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

