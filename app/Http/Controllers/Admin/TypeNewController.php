<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type_new;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeNewController extends Controller
{
    public function index()
    {
        $type_news = Type_new::query()->latest()->paginate();
        return view('admin.type_news.index', compact('type_news'));
    }
    public function create()
    {
        return view('admin.type_news.create');
    }
    public function store(Request $request)
    {
        if (Auth::check()) { {
                $request->validate([
                    'name' => 'required|unique:type_news|max:255',
                ]);
                $name = $request->name;
                $user_id = Auth::user()->id;
                // $user_id = Auth::user()->id;
                Type_new::create([
                    'name' => $name,
                    'user_id' => $user_id,
                ]);
                return redirect()->route('admin.type_news.index')->with('success', 'Thêm mới thành công');
            }
        }
    }
    public function edit(string $id)
    {
        $type_new = Type_new::find($id);
        return view('admin.type_news.edit', compact('type_new'));
    }
    public function update(Request $request, string $id)
    {
        $Type_new = Type_new::find($id);

        $Type_new->update($request->all());
        return redirect()->route('admin.type_news.index')->with('success', 'Cập nhật thành công');
    }
    public function destroy(string $id)
    {
        $type_new = Type_new::findOrFail($id);
        $type_new->delete(); // Soft delete
    
        return redirect()->route('admin.type_news.index')
            ->with('success', 'Xóa thành công');
    }
    
}
