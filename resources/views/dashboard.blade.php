@extends('layouts.app')

@section('content')
<div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">📊 Dashboard</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">สรุปข้อมูลระบบของคุณ</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-slate-800 p-5 rounded-lg shadow border border-gray-100 dark:border-slate-700">
            <h2 class="text-sm text-gray-500 dark:text-gray-400">👤 ผู้ใช้งานทั้งหมด</h2>
            <p class="text-3xl font-bold text-indigo-600 mt-2">{{ \App\Models\User::count() }}</p>
        </div>

        <div class="bg-white dark:bg-slate-800 p-5 rounded-lg shadow border border-gray-100 dark:border-slate-700">
            <h2 class="text-sm text-gray-500 dark:text-gray-400">📥 รายการล่าสุด</h2>
            <p class="text-3xl font-bold text-green-500 mt-2">132</p>
        </div>

        <div class="bg-white dark:bg-slate-800 p-5 rounded-lg shadow border border-gray-100 dark:border-slate-700">
            <h2 class="text-sm text-gray-500 dark:text-gray-400">💬 ข้อความใหม่</h2>
            <p class="text-3xl font-bold text-pink-500 mt-2">9</p>
        </div>

        <div class="bg-white dark:bg-slate-800 p-5 rounded-lg shadow border border-gray-100 dark:border-slate-700">
            <h2 class="text-sm text-gray-500 dark:text-gray-400">🚀 สถานะระบบ</h2>
            <p class="text-3xl font-bold text-yellow-500 mt-2">Online</p>
        </div>
    </div>

    <div class="mt-10 bg-white dark:bg-slate-800 p-6 rounded-lg shadow border border-gray-100 dark:border-slate-700">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">📈 กราฟข้อมูล (ตัวอย่าง)</h2>
        <div class="h-64 flex items-center justify-center text-gray-400">
            [ Placeholder สำหรับ Chart หรือ Table ]
        </div>
    </div>
</div>
@endsection
