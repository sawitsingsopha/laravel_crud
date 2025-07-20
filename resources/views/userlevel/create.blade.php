@extends('layouts.app')

@section('content')
<div class="max-w-xl p-6 mx-auto bg-white rounded shadow">
    <h2 class="mb-4 text-xl font-bold">เพิ่ม Role ใหม่</h2>
    <form action="{{ route('userlevel.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-medium">ชื่อ Role</label>
            <input type="text" name="user_level_name" class="w-full form-input" required>
        </div>
        <div class="flex justify-end">
            <button class="btn btn-primary" type="submit">บันทึก</button>
        </div>
    </form>
</div>
@endsection

