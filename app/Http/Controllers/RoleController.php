<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);

        Role::create($request->only('role_name'));
        return redirect()->route('roles.index')->with('success', 'Thêm phân quyền thành công!');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->only('role_name'));

        return redirect()->route('roles.index')->with('success', 'Cập nhật phân quyền thành công!');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('roles.index')->with('success', 'Xoá phân quyền thành công!');
    }
}
