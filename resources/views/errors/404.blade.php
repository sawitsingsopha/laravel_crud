@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center text-center text-gray-600">
    <h1 class="text-6xl font-bold text-primary">404</h1>
    <p class="text-xl mt-2">ไม่พบหน้าที่คุณร้องขอ</p>
    <p class="text-sm mt-1 text-gray-400">หน้าที่คุณพยายามเข้าถึงไม่มีอยู่ในระบบ หรือถูกลบไปแล้ว</p>

    <a href="{{ route('dashboard') }}" class="mt-6 inline-block px-4 py-2 bg-primary text-white rounded hover:bg-indigo-700">
        🔙 กลับหน้า Dashboard
    </a>
</div>
@endsection
