{{-- <pre>{{ json_encode(session()->all(), JSON_PRETTY_PRINT) }}</pre> --}}
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

                    {{-- แบบ sweet alert --}}
                    {{-- <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="ml-2 text-red-600 hover:underline" onclick="confirmDelete(this.form)">
                            Delete
                        </button>
                    </form> --}}
                    {{-- / แบบ sweet alert --}}

                    {{-- แบบ tailadmin --}}
                    <!-- Trigger Button -->
                    <button onclick="openDeleteModal({{ $user->id }}, '{{ $user->name }}')" class="ml-2 text-red-600 hover:underline">
                        Delete
                    </button>
                    {{-- / แบบ tailadmin --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

{{-- แบบ tailadmin --}}
<!-- Delete Confirm Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 items-center justify-center hidden bg-black/50 backdrop-blur-sm">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-gray-800">ยืนยันการลบผู้ใช้งาน</h2>
        <p class="mt-2 text-gray-600">คุณต้องการลบ <span id="deleteUserName" class="font-bold text-red-600"></span> หรือไม่?</p>

        <form method="POST" id="deleteForm" class="flex justify-end gap-3 mt-6">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                ยกเลิก
            </button>
            <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                ลบเลย
            </button>
        </form>
    </div>
</div>

<script>
    function openDeleteModal(userId, userName) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const nameSpan = document.getElementById('deleteUserName');

        nameSpan.textContent = userName;
        form.action = `/users/${userId}`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }

</script>

{{-- / แบบ tailadmin --}}


{{-- แบบ sweet alert --}}
<script>
    function confirmDelete(form) {
        Swal.fire({
            title: 'ยืนยันการลบ?'
            , text: 'คุณแน่ใจหรือไม่ว่าต้องการลบผู้ใช้นี้?'
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#d33'
            , cancelButtonColor: '#3085d6'
            , confirmButtonText: 'ตกลง'
            , cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

</script>

{{-- / แบบ sweet alert --}}

