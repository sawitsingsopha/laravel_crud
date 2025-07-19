<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        // session()->flash('success', 'บันทึกเรียบร้อยแล้ว!');
        // session()->flash('error', 'เกิดข้อผิดพลาดบางอย่าง!');
        // session()->flash('warning', 'ข้อมูลนี้อาจไม่สมบูรณ์!');
        // session()->flash('info', 'หน้านี้สำหรับผู้ดูแลระบบ');
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $roles = DB::table('user_level')->get();

        return view('users.show', compact('user', 'roles'));
    }

    public function create()
    {
        $roles = DB::table('user_level')->get();
        return view('users.create', compact('roles'));
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
        // session()->flash('success', 'เพิ่มผู้ใช้งานสำเร็จ!');
        return redirect()->route('users.index')->with('success', 'เพิ่มผู้ใช้งานสำเร็จ!');
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $roles = DB::table('user_level')->get();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'userlevel_id' => $request->userlevel_id,
            'updated_at' => now(),
        ]);
        // session()->flash('success', 'อัปเดตข้อมูลผู้ใช้งานสำเร็จ!');
        return redirect()->route('users.index')->with('success', 'อัปเดตข้อมูลผู้ใช้งานสำเร็จ!');
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        session()->flash('success', 'ลบผู้ใช้งานเรียบร้อยแล้ว!');
        return redirect()->route('users.index')->with('success', 'ลบผู้ใช้งานเรียบร้อยแล้ว!');;
    }
}