<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type_new;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeNewController extends Controller
{
    /**
     * Hiển thị danh sách các loại tin (bao gồm cả các loại tin đã xóa mềm).
     */
    public function index()
    {
        $type_news = Type_new::withTrashed()->latest()->paginate();
        return view('admin.type_news.index', compact('type_news'));
    }

    /**
     * Hiển thị form tạo mới loại tin.
     */
    public function create()
    {
        return view('admin.type_news.create');
    }

    /**
     * Lưu loại tin mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Validate dữ liệu với thông báo tiếng Việt
            $request->validate([
                'name' => 'required|unique:type_news|max:55',
            ], [
                'name.required' => 'Tên loại tin là bắt buộc.',
                'name.unique' => 'Tên loại tin đã tồn tại.',
                'name.max' => 'Tên loại tin không được vượt quá 55 ký tự.',
            ]);

            // Lấy tên loại tin và user_id từ người dùng hiện tại
            $name = $request->name;
            $user_id = Auth::user()->id;

            // Tạo loại tin mới
            Type_new::create([
                'name' => $name,
                'user_id' => $user_id,
            ]);

            return redirect()->route('admin.type_news.index')->with('success', 'Thêm mới thành công');
        }

        // Nếu người dùng chưa đăng nhập, trả về trang đăng nhập
        return redirect()->route('login');
    }

    /**
     * Hiển thị form chỉnh sửa loại tin.
     */
    public function edit(string $id)
    {
        $type_new = Type_new::find($id);
        return view('admin.type_news.edit', compact('type_new'));
    }

    /**
     * Cập nhật thông tin loại tin.
     */
    public function update(Request $request, string $id)
    {
        $type_new = Type_new::findOrFail($id);

        // Validate dữ liệu với thông báo tiếng Việt
        $request->validate([
            'name' => 'required|unique:type_news,name,' . $type_new->id . '|max:55',
        ], [
            'name.required' => 'Tên loại tin là bắt buộc.',
            'name.unique' => 'Tên loại tin đã tồn tại.',
            'name.max' => 'Tên loại tin không được vượt quá 55 ký tự.',
        ]);

        // Cập nhật thông tin loại tin
        $type_new->update($request->all());

        return redirect()->route('admin.type_news.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Xóa mềm loại tin.
     */
    public function destroy(string $id)
    {
        $type_new = Type_new::findOrFail($id);
        $type_new->delete(); // Soft delete

        return redirect()->route('admin.type_news.index')
            ->with('success', 'Xóa thành công');
    }

    /**
     * Khôi phục loại tin đã xóa mềm.
     */
    public function restore(string $id)
    {
        $type_new = Type_new::withTrashed()->findOrFail($id);
        $type_new->restore(); // Khôi phục loại tin

        return redirect()->route('admin.type_news.index')->with('success', 'Khôi phục thành công');
    }

    /**
     * Xóa vĩnh viễn loại tin đã bị xóa mềm.
     */
    public function forceDelete(string $id)
    {
        $type_new = Type_new::withTrashed()->findOrFail($id);
        $type_new->forceDelete(); // Xóa vĩnh viễn loại tin

        return redirect()->route('admin.type_news.index')->with('success', 'Đã xóa vĩnh viễn thành công');
    }
}
