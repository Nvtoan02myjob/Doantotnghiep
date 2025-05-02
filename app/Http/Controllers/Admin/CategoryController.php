<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách các danh mục (bao gồm cả danh mục đã xóa mềm).
     */
    public function index()
    {
        // Lấy tất cả danh mục, bao gồm cả danh mục đã bị xóa mềm
        $categories = Category::withTrashed()->latest()->paginate();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Hiển thị form tạo mới danh mục.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Lưu danh mục mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu với thông báo tiếng Việt
        $request->validate([
            'name' => 'required|unique:categories|max:30',
        ], [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'name.max' => 'Tên danh mục không được vượt quá 30 ký tự.',
        ]);

        // Tạo danh mục mới
        Category::create([
            'name' => $request->name,
            'employee_id' => 1, // Giá trị mặc định của employee_id, có thể thay đổi
            'user_id' => 3,     // Giá trị mặc định của user_id, có thể thay đổi
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Thêm mới thành công');
    }

    /**
     * Hiển thị form chỉnh sửa danh mục.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Cập nhật thông tin danh mục.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        // Validate dữ liệu với thông báo tiếng Việt
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id . '|max:255',
        ], [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
        ]);

        // Cập nhật thông tin danh mục
        $category->update($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Xóa mềm danh mục.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Xóa thành công');
    }

    /**
     * Khôi phục danh mục đã bị xóa mềm.
     */
    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('admin.categories.index')->with('success', 'Khôi phục danh mục thành công');
    }

    /**
     * Xóa vĩnh viễn danh mục.
     */
    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->forceDelete();

        return redirect()->route('admin.categories.index')->with('success', 'Đã xóa vĩnh viễn danh mục');
    }
}
