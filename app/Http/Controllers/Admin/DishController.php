<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{

    // Hiển thị danh sách món ăn (cả đã xóa và chưa xóa)
    public function index()
    {
        $dishes = Dish::withTrashed()->with('category')->latest('id')->get();
        return view('admin.dishes.index', compact('dishes'));
    }

    // Hiển thị form tạo món ăn
    public function create()
    {
        // Lấy tất cả các danh mục
        $categories = Category::all();

        // Truyền biến $categories vào view
        return view('admin.dishes.create', compact('categories'));
    }



    // Lưu món ăn mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'img' => 'required|image',
        ], [
            'name.required' => 'Tên món ăn không được để trống.',
            'name.string' => 'Tên món ăn phải là chuỗi ký tự.',
            'name.max' => 'Tên món ăn không được vượt quá 255 ký tự.',

            'price.required' => 'Giá món ăn không được để trống.',
            'price.numeric' => 'Giá món ăn phải là số.',
            'price.min' => 'Giá món ăn không được nhỏ hơn 0.',

            'description.string' => 'Mô tả món ăn phải là chuỗi ký tự.',
            'description.required' => 'Mô tả món ăn không được để trống.',

            'img.required' => 'Hình ảnh món ăn không được để trống.',
            'img.image' => 'Tệp tải lên phải là hình ảnh.',
            'img.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif hoặc svg.',
            'img.max' => 'Hình ảnh không được vượt quá 2MB.',
        ]);

        $dish = new Dish();
        $dish->cate_id = $request->cate_id;
        $dish->name = $request->name;
        $dish->price = $request->price;
        $dish->description = $request->description;
        $dish->user_id = auth()->id();

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Lưu ảnh vào thư mục storage/app/public/dishes
            $image->storeAs('dishes', $imageName, 'public');

            // Lưu đường dẫn đầy đủ vào cơ sở dữ liệu
            $dish->img = 'storage/dishes/' . $imageName;
        }

        $dish->save();


        return redirect()->route('admin.dishes.index')->with('success', 'Thêm món ăn thành công.');
    }

    // Hiển thị form chỉnh sửa món ăn
    public function edit($id)
{
    // Lấy món ăn bao gồm các món đã bị xóa
    $dish = Dish::withTrashed()->findOrFail($id);

    // Lấy tất cả các danh mục
    $categories = Category::all();

    // Truyền dữ liệu món ăn và danh mục vào view
    return view('admin.dishes.edit', compact('dish', 'categories'));
}

    // Cập nhật món ăn
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'Tên món ăn không được để trống.',
            'name.string' => 'Tên món ăn phải là chuỗi ký tự.',
            'name.max' => 'Tên món ăn không được vượt quá 255 ký tự.',

            'price.required' => 'Giá món ăn không được để trống.',
            'price.numeric' => 'Giá món ăn phải là số.',
            'price.min' => 'Giá món ăn không được nhỏ hơn 0.',

            'description.string' => 'Mô tả món ăn phải là chuỗi ký tự.',
            'description.required' => 'Mô tả món ăn không được để trống.',

            'img.image' => 'Tệp tải lên phải là hình ảnh.',
            'img.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif hoặc svg.',
            'img.max' => 'Hình ảnh không được vượt quá 2MB.',
        ]);


        $dish = Dish::withTrashed()->findOrFail($id);
        $dish->name = $request->name;
        $dish->price = $request->price;
        $dish->description = $request->description;

        if ($request->hasFile('img')) {
            // Xóa ảnh cũ nếu có
            if ($dish->img) {
                // dd($dish->img);
                Storage::disk('public')->delete($dish->img);
            }

            $imgPath = $request->file('img')->store('dishes', 'public');
            $dish->img = 'storage/' . $imgPath;
        }

        $dish->save();

        return redirect()->route('admin.dishes.index')->with('success', 'Cập nhật món ăn thành công.');
    }

    // Xóa mềm món ăn
    public function destroy($id)
    {
        $dish = Dish::findOrFail($id);
        $dish->delete();

        return redirect()->route('admin.dishes.index')->with('success', 'Đã xóa món ăn (chưa xóa vĩnh viễn).');
    }

    // Khôi phục món ăn đã xóa mềm
    public function restore($id)
    {
        $dish = Dish::withTrashed()->findOrFail($id);
        $dish->restore();

        return redirect()->route('admin.dishes.index')->with('success', 'Khôi phục món ăn thành công.');
    }

    // Xóa vĩnh viễn món ăn + xóa file ảnh
    public function forceDelete($id)
    {
        $dish = Dish::withTrashed()->findOrFail($id);

        // Xóa file ảnh nếu có
        if ($dish->img) {
            Storage::disk('public')->delete($dish->img);
        }

        $dish->forceDelete();

        return redirect()->route('admin.dishes.index')->with('success', 'Đã xóa vĩnh viễn món ăn và xóa ảnh thành công.');
    }
        // Ẩn/hiện món ăn
    public function toggleStatus($id)
    {
        $dish = Dish::withTrashed()->findOrFail($id);
        $dish->status = !$dish->status;
        $dish->save();

        return redirect()->route('admin.dishes.index')->with('success', 'Thay đổi trạng thái món ăn thành công.');
    }

}
