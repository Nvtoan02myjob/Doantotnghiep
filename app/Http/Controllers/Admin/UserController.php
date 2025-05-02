<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->latest('id')->get(); // lấy cả user đã bị xoá mềm
        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete(); // xoá mềm
        return redirect()->back()->with('success', 'Đã xoá người dùng (soft delete).');
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        }

        $user->restore();
        return redirect()->back()->with('success', 'Khôi phục người dùng thành công.');
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        }

        $user->forceDelete();
        return redirect()->back()->with('success', 'Đã xoá vĩnh viễn người dùng.');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => [
                'required',
                'email',
                'regex:/^[\w\.-]+@([\w-]+\.)+(vn|com)$/', // Email kết thúc bằng .vn
                // 'unique:users,email'
            ],
            'password' => 'required|min:8',
            'phone' => 'required|min:10'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.create')->with('success', 'Tạo người dùng thành công!');
    }


    public function edit($id)
{
    $user = User::withTrashed()->findOrFail($id);
    return view('admin.users.edit', compact('user'));
}


public function update(Request $request, $id)
{
    $user = User::withTrashed()->findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'required|string|max:20',
        'password' => 'nullable|min:8|confirmed', // xác nhận mật khẩu nếu có nhập
        'role_id' => 'required|in:1,2,3', // Kiểm tra phân quyền hợp lệ
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'role_id' => $request->role_id, // Cập nhật phân quyền
    ];

    // Nếu có nhập password thì mới cập nhật
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công.');
}



}
