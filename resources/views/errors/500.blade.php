@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center text-center text-gray-600">
    <h1 class="text-6xl font-bold text-red-500">500</h1>
    <p class="text-xl mt-2">เกิดข้อผิดพลาดภายในระบบ</p>
    <p class="text-sm mt-1 text-gray-400">กรุณาลองใหม่ หรือติดต่อผู้ดูแลระบบ</p>

    <a href="{{ route('dashboard') }}" class="mt-6 inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
        🔁 ลองใหม่
    </a>
</div>
@endsection
