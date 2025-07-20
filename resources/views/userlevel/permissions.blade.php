@extends('layouts.app')

@section('content')
<div class="container px-4 mx-auto">
    <div class="max-w-6xl p-6 mx-auto bg-white shadow-lg rounded-2xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">ตั้งค่าสิทธิ์: {{ $role->user_level_name }}</h2>
            <div class="space-x-2">
                <button type="button" onclick="toggleAll(true)" class="px-3 py-1 text-sm text-white bg-green-500 rounded hover:bg-green-600">Select All</button>
                <button type="button" onclick="toggleAll(false)" class="px-3 py-1 text-sm text-white bg-red-500 rounded hover:bg-red-600">Uncheck All</button>
            </div>
        </div>

        <form action="{{ route('userlevel.permissions.update', $role->userlevel_id) }}" method="POST">
            @csrf

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-gray-200">
                    <thead class="text-gray-700 bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left border">เมนู</th>
                            @foreach ($methods as $method)
                            <th class="px-4 py-3 text-center border">
                                <div class="flex flex-col items-center space-y-1">
                                    <span class="capitalize">{{ $method }}</span>
                                    <input type="checkbox" onclick="toggleColumn('{{ $method }}', this.checked)" class="w-5 h-5 text-indigo-600 rounded form-checkbox permission-checkbox">

                                </div>
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($models as $label => $model)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2 font-medium border">{{ $label }}</td>
                            @foreach ($methods as $method)
                            <td class="px-4 py-2 text-center border">
                                <input type="checkbox" name="permissions[{{ $model }}][{{ $method }}]" data-method="{{ $method }}" class="w-5 h-5 text-indigo-600 rounded form-checkbox permission-checkbox" {{ $permissions->contains(fn($p) => $p->access_model === $model && $p->access_method === $method) ? 'checked' : '' }}>
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end mt-6 space-x-3">
                <a href="{{ route('userlevel.index') }}" class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded hover:bg-gray-300">ย้อนกลับ</a>
                <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">บันทึกสิทธิ์</button>
            </div>
        </form>
    </div>
</div>

<script>
    // ✅ กด Select All / Uncheck All
    function toggleAll(checked) {
        document.querySelectorAll('.permission-checkbox').forEach(cb => cb.checked = checked);
        updateAllColumnHeaders();
    }

    // ✅ กดหัว column
    function toggleColumn(method, checked) {
        document.querySelectorAll(`.permission-checkbox[data-method="${method}"]`).forEach(cb => cb.checked = checked);
        updateColumnHeader(method);
    }

    // ✅ เมื่อ user คลิก checkbox ใด ๆ → trigger ตรวจสอบหัว column
    document.querySelectorAll('.permission-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
            const method = this.dataset.method;
            updateColumnHeader(method);
        });
    });

    // ✅ ตรวจสอบ column เฉพาะ method ว่าทุกอันถูกเลือกไหม
    function updateColumnHeader(method) {
        const checkboxes = document.querySelectorAll(`.permission-checkbox[data-method="${method}"]`);
        const headerCheckbox = document.querySelector(`input[type=checkbox][onclick*="toggleColumn('${method}'"]`);
        if (!headerCheckbox) return;

        const allChecked = Array.from(checkboxes).every(cb => cb.checked);
        headerCheckbox.checked = allChecked;
    }

    // ✅ ตรวจสอบทุก column
    function updateAllColumnHeaders() {
        const methods = [...new Set(Array.from(document.querySelectorAll('.permission-checkbox')).map(cb => cb.dataset.method))];
        methods.forEach(method => updateColumnHeader(method));
    }

    // ✅ โหลดหน้านี้ครั้งแรก → sync หัว column ให้ตรง
    document.addEventListener('DOMContentLoaded', () => {
        updateAllColumnHeaders();
    });
</script>
@endsection

