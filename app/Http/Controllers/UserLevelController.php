<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLevel;
use App\Models\UserlevelPermission;

class UserLevelController extends Controller
{
    public function index()
    {
        $roles = UserLevel::all();
        return view('userlevel.index', compact('roles'));
    }

    public function create()
    {
        return view('userlevel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_level_name' => 'required|string|max:255',
        ]);

        UserLevel::create([
            'user_level_name' => $request->user_level_name,
        ]);

        return redirect()->route('userlevel.index')->with('success', 'เพิ่ม Role สำเร็จ!');
    }

    public function edit($id)
    {
        $role = UserLevel::findOrFail($id);
        return view('userlevel.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_level_name' => 'required|string|max:255',
        ]);

        $role = UserLevel::findOrFail($id);
        $role->update([
            'user_level_name' => $request->user_level_name,
        ]);

        return redirect()->route('userlevel.index')->with('success', 'อัปเดต Role สำเร็จ!');
    }

    public function destroy($id)
    {
        $role = UserLevel::findOrFail($id);
        $role->permissions()->delete(); // ลบ permissions ที่เกี่ยวข้อง
        $role->delete();

        return redirect()->route('userlevel.index')->with('success', 'ลบ Role สำเร็จ!');
    }

    public function editPermissions($id)
    {
        $role = UserLevel::findOrFail($id);
        $permissions = $role->permissions()->get();

        $models = ['users', 'userlevel', 'products'];
        $methods = ['list', 'add', 'edit', 'delete'];

        return view('userlevel.permissions', compact('role', 'permissions', 'models', 'methods'));
    }

    public function updatePermissions(Request $request, $id)
    {
        $role = UserLevel::findOrFail($id);
        $role->permissions()->delete();

        foreach ($request->input('permissions', []) as $model => $methods) {
            foreach ($methods as $method => $value) {
                $role->permissions()->create([
                    'access_model' => $model,
                    'access_method' => $method,
                ]);
            }
        }

        return redirect()->route('userlevel.index')->with('success', 'บันทึกสิทธิ์เรียบร้อย!');
    }
}
