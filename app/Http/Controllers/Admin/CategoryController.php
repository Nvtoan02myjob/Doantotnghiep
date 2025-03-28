<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::query()->latest()->paginate();
        return view('admin.categories.index', compact('categories'));
    }
    public function create(){
        return view('admin.categories.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' =>'required|unique:categories|max:255',
        ]);
        $name = $request->name;
        // $employee_id = 1;
        Category::create([
            'name' => $name,
            'employee_id' => 1
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Thêm mới thành công');
    }
    public function edit(string $id){
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }
    public function update(Request $request, string $id){
        $category = Category::find($id);

        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật thành công');
    }
    public function destroy(string $id){
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Xóa thành công');
    }

}
