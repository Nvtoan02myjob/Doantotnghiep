<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::withTrashed()->latest('id')->paginate(10); 
        return view('admin.voucher.index', compact('vouchers'));
    }

    public function create()
    {
        return view('admin.voucher.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'condition' => 'required|string',
            'time_end' => 'required|date',
        ], [
            'name.required' => 'Tên voucher là bắt buộc.',
            'name.max' => 'Tên voucher không vượt quá 255 ký tự.',
            'image.required' => 'Vui lòng chọn hình ảnh.',
            'image.image' => 'Tệp phải là hình ảnh.',
            'image.mimes' => 'Ảnh phải có định dạng: jpg, jpeg, png.',
            'condition.required' => 'Điều kiện sử dụng là bắt buộc.',
            'time_end.required' => 'Thời gian kết thúc là bắt buộc.',
            'time_end.date' => 'Thời gian kết thúc phải đúng định dạng ngày.',
        ]);

        $imagePath = $request->file('image')->store('voucher', 'public');

        Voucher::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'image' => $imagePath,
            'condition' => $request->condition,
            'time_end' => $request->time_end,
        ]);

        return redirect()->route('admin.voucher.index')->with('success', 'Thêm voucher thành công!');
    }

    public function edit($id)
    {
        $voucher = Voucher::withTrashed()->findOrFail($id);
        return view('admin.voucher.edit', compact('voucher'));
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::withTrashed()->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'condition' => 'required|string',
            'time_end' => 'required|date',
        ], [
            'name.required' => 'Tên voucher là bắt buộc.',
            'name.max' => 'Tên voucher không vượt quá 255 ký tự.',
            'condition.required' => 'Điều kiện sử dụng là bắt buộc.',
            'time_end.required' => 'Thời gian kết thúc là bắt buộc.',
            'time_end.date' => 'Thời gian kết thúc phải đúng định dạng ngày.',
        ]);

        $data = [
            'name' => $request->name,
            'condition' => $request->condition,
            'time_end' => $request->time_end,
        ];

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            Storage::disk('public')->delete($voucher->image);
            // Lưu ảnh mới
            $data['image'] = $request->file('image')->store('voucher', 'public');
        }

        $voucher->update($data);

        return redirect()->route('admin.voucher.index')->with('success', 'Cập nhật voucher thành công!');
    }

    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);

        // Xóa ảnh
        Storage::disk('public')->delete($voucher->image);

        // Soft delete
        $voucher->delete();

        return redirect()->route('admin.voucher.index')->with('success', 'Xóa voucher thành công!');
    }

    public function restore($id)
    {
        $voucher = Voucher::withTrashed()->findOrFail($id);
        $voucher->restore();

        return redirect()->route('admin.voucher.index')->with('success', 'Khôi phục voucher thành công!');
    }

    public function forceDelete($id)
    {
        $voucher = Voucher::withTrashed()->findOrFail($id);

        // Xóa ảnh
        Storage::disk('public')->delete($voucher->image);

        // Xóa vĩnh viễn
        $voucher->forceDelete();

        return redirect()->route('admin.voucher.index')->with('success', 'Xóa vĩnh viễn voucher thành công!');
    }
}
