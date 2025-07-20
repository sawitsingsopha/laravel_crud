@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold">จัดการสิทธิ์ผู้ใช้ (User Level)</h2>
        <a href="{{ route('userlevel.create') }}" class="btn btn-primary">+ เพิ่ม Role</a>
    </div>

    @if($roles->isEmpty())
    <p class="text-gray-500">ยังไม่มีข้อมูล</p>
    @else
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">ชื่อ Role</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $role->user_level_name }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('userlevel.edit', $role->userlevel_id) }}" class="text-blue-600">แก้ไข</a>
                        <a href="{{ route('userlevel.permissions', $role->userlevel_id) }}" class="text-purple-600">สิทธิ์</a>
                        <form action="{{ route('userlevel.destroy', $role->userlevel_id) }}" method="POST" class="inline-block" onsubmit="return confirm('แน่ใจว่าต้องการลบ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600">ลบ</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection

