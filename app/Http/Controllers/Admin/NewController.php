<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Type_new;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewController extends Controller
{
    public function index()
    {
        $news = News::with(['user', 'type_news'])->latest('id')->paginate(5);
        return view('admin.news.index', compact('news'));
    }

    public function show(string $id)
    {
        $new = News::findOrFail($id);
        return view('admin.news.show', compact('new'));
    }

    public function create()
    {
        $type_news = Type_new::select('id', 'name')->get();
        return view('admin.news.create', compact('type_news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type_news_id' => 'required|exists:type_news,id',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->putFile('news', $request->file('image'));
            $data['image'] = 'storage/' . $path;
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Thêm bài viết thành công');
    }

    public function edit($id)
    {
        $type_news = Type_new::select('id', 'name')->get();
        $new = News::findOrFail($id);
        return view('admin.news.edit', compact('type_news', 'new'));
    }

    public function update(Request $request, string $id)
{
    $new = News::find($id);
    $data = $request->except('image');

    if ($request->hasFile('image')) {
        $path = Storage::disk('public')->putFile('news', $request->file('image'));
        $data['image'] = 'storage/' . $path; // lưu ảnh mới
        // Xoá ảnh cũ nếu có
        $currentImgTHumb = $new->image;
        if ($currentImgTHumb && file_exists(public_path($currentImgTHumb))) {
            unlink(public_path($currentImgTHumb)); // Xóa ảnh cũ nếu có ảnh mới
        }
    }

    $new->update($data);

    return back()->with('success', 'Cập nhật bài viết thành công');
}

    public function destroy(string $id)
    {
        $new = News::findOrFail($id);
        $new->delete();
        return redirect()->route('admin.news.index')->with('success', 'Xóa bài viết thành công');
    }

    public function changeStatus(string $id)
    {
        $new = News::findOrFail($id);
        $new->status = $new->status == 1 ? 0 : 1;
        $new->save();
        return redirect()->route('admin.news.index')->with('success', 'Cập nhật trạng thái bài viết thành công');
    }
}
