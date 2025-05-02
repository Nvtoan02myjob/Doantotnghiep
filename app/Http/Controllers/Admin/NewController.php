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
        $news = News::with(['user', 'type_news'])->latest('id')->withTrashed()->paginate(5);
        return view('admin.news.index', compact('news'));
    }

    public function show(string $id)
    {
        $new = News::findOrFail($id);
        return view('admin.news.show', compact('new'));
    }

    public function create()
    {
        $user = auth()->user();
        $type_news = Type_new::select('id', 'name')->get();
        return view('admin.news.create', compact('user','type_news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required|max:500',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type_news_id' => 'required|exists:type_news,id',
        ], [
            'title.required' => 'Tiêu đề không được bỏ trống.',
            'title.max' => 'Tiêu đề không được quá 255 ký tự.',
            'summary.required' => 'Tóm tắt không được bỏ trống',
            'summary.max'=>'Tóm tắt không quá 500 ký tự',
            'content.required' => 'Nội dung không được bỏ trống.',
            'image.required' => 'Ảnh không được bỏ trống.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif, svg.',
            'image.max' => 'Kích thước ảnh không vượt quá 2MB.',
            'type_news_id.required' => 'Vui lòng chọn thể loại.',
            'type_news_id.exists' => 'Thể loại không hợp lệ.',
        ]);

        $data = $request->except('image');
        $data['user_id'] = auth()->id(); // nếu có đăng nhập admin

        if ($request->hasFile('image')) {
            $path = Storage::putFile('news', $request->file('image'));
            $data['image'] = 'storage/' . $path;
        }

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'Thêm bài viết thành công.');
    }

    public function edit($id)
    {
        $type_news = Type_new::select('id', 'name')->get();
        $new = News::findOrFail($id);
        return view('admin.news.edit', compact('type_news', 'new'));
    }

    public function update(Request $request, string $id)
    {
        $new = News::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required|max:500',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type_news_id' => 'required|exists:type_news,id',
        ], [
            'title.required' => 'Tiêu đề không được bỏ trống.',
            'title.max' => 'Tiêu đề không được quá 255 ký tự.',
            'summary.required' => 'Tóm tắt không được bỏ trống',
            'summary.max'=>'Tóm tắt không quá 500 ký tự',
            'content.required' => 'Nội dung không được bỏ trống.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif, svg.',
            'image.max' => 'Kích thước ảnh không vượt quá 2MB.',
            'type_news_id.required' => 'Vui lòng chọn thể loại.',
            'type_news_id.exists' => 'Thể loại không hợp lệ.',
        ]);

        $data = $request->except('image');
        $data['user_id'] = auth()->id(); 

        if ($request->hasFile('image')) {
            $path = Storage::putFile('news', $request->file('image'));
            $data['image'] = 'storage/' . $path;

            // Xoá ảnh cũ nếu tồn tại
            if ($new->image && file_exists(public_path($new->image))) {
                unlink(public_path($new->image));
            }
        }

        $new->update($data);

        return back()->with('success', 'Cập nhật bài viết thành công.');
    }

    public function destroy($id)
    {
        $new = News::findOrFail($id);
        $new->delete();

        return redirect()->route('admin.news.index')->with('success', 'Đã xóa bài viết (chưa xóa vĩnh viễn).');
    }

    public function restore($id)
    {
        $new = News::withTrashed()->findOrFail($id);
        $new->restore();

        return redirect()->route('admin.news.index')->with('success', 'Khôi phục bài viết thành công.');
    }

    public function forceDelete($id)
    {
        $new = News::withTrashed()->findOrFail($id);

        // Xóa file ảnh nếu có
        if ($new->image && file_exists(public_path($new->image))) {
            unlink(public_path($new->image));
        }

        $new->forceDelete();

        return redirect()->route('admin.news.index')->with('success', 'Xóa vĩnh viễn bài viết thành công.');
    }

    public function changeStatus(string $id)
    {
        $new = News::findOrFail($id);
        $new->status = $new->status ? 0 : 1;
        $new->save();

        return redirect()->route('admin.news.index')->with('success', 'Cập nhật trạng thái bài viết thành công.');
    }
}
