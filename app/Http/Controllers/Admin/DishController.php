<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::query()->with('user')->latest('id')->paginate(5);
                
        return view('admin.dishes.index', compact( 'dishes'));
    }
    public function show(string $id)
    {
        $dishes = Dish::query()->find($id);

        return view('admin.dishes.show', compact('dishes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {

        $categories = Category::query()->select('id', 'name')->get();


        return view('admin.dishes.create', compact('categories')); // chuyển đến trang thêm
    }
    public function store(Request $request)
{
    $data = $request->except('img');

    // Thêm giá trị user_id của người đang đăng nhập
    $data['user_id'] = Auth::id();

    if ($request->hasFile('img')) {
        $path = Storage::putFile('dishes', $request->file('img'));
        $data['img'] = 'storage/' . $path; // lưu ảnh vào thư mục dishes của storage
    }

    Dish::create($data);

    return redirect()->route('admin.dishes.index')
        ->with('success', 'Thêm món ăn thành công');
}

public function edit($id)
{
    $dishes = Dish::find($id);  // Lấy thông tin món ăn theo ID
    $categories = Category::query()->select('id', 'name')->get();  // Lấy danh sách thể loại

    return view('admin.dishes.edit', compact('dishes', 'categories'));  // Truyền cả 2 biến vào view
}


    public function update(Request $request, string $id)
    {
        $dishes = Dish::find($id);

        $data = $request->except('img');

        if ($request->hasFile('img')) {
            $path = Storage::putFile('dishes', $request->file('img'));
            $data['img'] = 'storage/' . $path; // lưu ảnh vào thư mục news của storage

        }
        $currentImgTHumb = $dishes->img;


        $dishes->update($data);
        if ($request->hasFile('img') && $currentImgTHumb && file_exists(public_path($currentImgTHumb))) {
            unlink(public_path($currentImgTHumb));
        }

        return back();
    }
    public function toggleStatus($id)
{
    $dish = Dish::findOrFail($id);
    $dish->status = !$dish->status;  // Đảo trạng thái
    $dish->save();

    return redirect()->route('admin.dishes.index')->with('success', 'Trạng thái món ăn đã được cập nhật.');
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $data = Dish::findOrFail($id);

    // Xóa mềm
    $data->delete();

    return redirect()->route('admin.dishes.index')
        ->with('success', 'Xóa món ăn thành công');
}

}




