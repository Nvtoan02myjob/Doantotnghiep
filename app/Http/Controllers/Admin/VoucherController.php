<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VoucherController extends Controller
{
    // Hiển thị danh sách voucher với phân trang
    public function index()
    {
        $vouchers = Voucher::paginate(10); // Paginate the vouchers, 10 per page
        return view('admin.voucher.index', compact('vouchers'));
    }

    // Hiển thị form thêm mới
    public function create()
    {
        return view('admin.voucher.create');
    }

    // Lưu voucher mới vào database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'condition' => 'required|string',
            'time_end' => 'required|date',
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

    // Hiển thị form sửa voucher
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        return view('admin.voucher.edit', compact('voucher'));
    }

    // Cập nhật voucher
    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'condition' => 'required|string',
            'time_end' => 'required|date',
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

    // Xóa voucher (Soft Delete)
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);

        // Xóa ảnh
        Storage::disk('public')->delete($voucher->image);

        // Soft delete the voucher
        $voucher->delete();

        return redirect()->route('admin.voucher.index')->with('success', 'Xóa voucher thành công!');
    }

    // Khôi phục voucher đã xóa mềm
    public function restore($id)
    {
        $voucher = Voucher::withTrashed()->findOrFail($id);
        $voucher->restore();

        return redirect()->route('admin.voucher.index')->with('success', 'Khôi phục voucher thành công!');
    }

    // Xóa vĩnh viễn voucher đã xóa mềm
    public function forceDelete($id)
    {
        $voucher = Voucher::withTrashed()->findOrFail($id);

        // Xóa ảnh
        Storage::disk('public')->delete($voucher->image);

        // Force delete the voucher
        $voucher->forceDelete();

        return redirect()->route('admin.voucher.index')->with('success', 'Xóa vĩnh viễn voucher thành công!');
    }
}


?>