<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\table;

class TablesController extends Controller
{
    // Hiển thị danh sách bàn
    public function index()
    {
        $tables = Table::withTrashed()->latest('id')->get();
        return view('admin.tables.index', compact('tables'));
    }

    // Hiển thị form tạo mới bàn
    public function create()
    {
        return view('admin.tables.create');
    }

    // Lưu bàn mới vào CSDL
    public function store(Request $request)
    {
        // Validate các trường
        $request->validate([
            'qr_code' => 'required|unique:tables|max:50',
            'status' => 'required|boolean',
            'quantity_person' => 'required|integer|min:1',
            'qr_img' => 'required|image',
        ], [
            'qr_code.required' => 'Mã QR code không được bỏ trống',
            'qr_code.unique' => 'Mã QR code bị trùng lặp ',
            'qr_code.max'=> 'Mã QR code không được quá 50 ký tự',

            'status.required' => 'Trạng thái không được bỏ trống',
            
            'quantity_person.required'=> 'Số lượng người khôgn được bỏ trống',
            'quantity_person.integer'=>'Số lương người phải là số nguyên',
            'quantity_person.min'=> 'Số lượng ngươi phải hơn 1 người',
             
            'qr_img.required'=>'Ảnh QR không được bỏ trống',
            'qr_img.image'=> 'Tệp tải lên phải là hình ảnh',

        ]
    );

        // Lấy tất cả dữ liệu từ request, nhưng loại bỏ 'user_id' để tự gán sau
        $data = $request->only(['qr_code', 'status', 'quantity_person']);

        // Thêm user_id của người đang đăng nhập
        $data['user_id'] = Auth::id();

        // Xử lý ảnh nếu có
        if ($request->hasFile('qr_img')) {
            $file = $request->file('qr_img');
            $path = $file->store('qr_images', 'public');  // Lưu ảnh vào thư mục public
            $data['qr_img'] = $path;  // Lưu đường dẫn ảnh vào database
        }

        // Lưu bàn mới vào database
        Table::create($data);

        // Quay lại trang danh sách bàn với thông báo thành công
        return redirect()->route('admin.tables.index')->with('success', 'Thêm bàn mới thành công');
    }

    // Hiển thị form chỉnh sửa bàn
    public function edit($id)
    {
        $table = Table::findOrFail($id);  // Tìm bàn theo ID, nếu không có thì trả về lỗi 404
        return view('admin.tables.edit', compact('table'));  // Trả về view chỉnh sửa bàn
    }

    // Cập nhật thông tin bàn
    public function update(Request $request, $id)
    {
        // Tìm bàn theo ID
        $table = Table::findOrFail($id);

        // Kiểm tra validation
        $request->validate([
            'qr_code' => 'required|max:15|unique:tables,qr_code,' . $id,
            'status' => 'required|boolean',
            'quantity_person' => 'required|integer|min:1',
            'qr_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'qr_code.required' => 'Mã QR code không được bỏ trống',
            'qr_code.unique' => 'Mã QR code bị trùng lặp ',
            'qr_code.max'=> 'Mã QR code không được quá 50 ký tự',

            'status.required' => 'Trạng thái không được bỏ trống',
            
            'quantity_person.required'=> 'Số lượng người khôgn được bỏ trống',
            'quantity_person.integer'=>'Số lương người phải là số nguyên',
            'quantity_person.min'=> 'Số lượng ngươi phải hơn 1 người',
             
            'qr_img.required'=>'Ảnh QR không được bỏ trống',
            'qr_img.image'=> 'Tệp tải lên phải là hình ảnh',

        ]
    );

        // Lấy dữ liệu từ form, loại bỏ 'user_id' vì không cần cập nhật
        $data = $request->only(['qr_code', 'status', 'quantity_person']);

        // Nếu có file ảnh mới, xử lý ảnh
        if ($request->hasFile('qr_img')) {
            // Xóa ảnh cũ nếu có
            if ($table->qr_img) {
                Storage::delete('public/' . $table->qr_img);
            }

            // Lưu ảnh mới
            $file = $request->file('qr_img');
            $path = $file->store('qr_images', 'public');
            $data['qr_img'] = $path; // Cập nhật đường dẫn ảnh mới
        }

        // Cập nhật dữ liệu vào database
        $table->update($data);

        // Chuyển hướng về trang danh sách bàn
        return redirect()->route('admin.tables.index')->with('success', 'Cập nhật bàn thành công');
    }

    // Xóa bàn
    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();  // Xóa bàn khỏi database

        // Quay lại trang danh sách bàn với thông báo thành công
        return redirect()->route('admin.tables.index')->with('success', 'Xóa bàn thành công');
    }
    // Khôi phục món ăn đã xóa mềm
    public function restore($id)
    {
        $table = Table::withTrashed()->findOrFail($id);
        $table->restore();

        return redirect()->route('admin.tables.index')->with('success', 'Khôi phục bàn thành công.');
    }

    // Xóa vĩnh viễn món ăn + xóa file ảnh
    public function forceDelete($id)
    {
        $table = Table::withTrashed()->findOrFail($id);

        // Xóa file ảnh nếu có
        if ($table->qr_img) {
            Storage::disk('public')->delete($table->qr_img);
        }

        $table->forceDelete();

        return redirect()->route('admin.tables.index')->with('success', 'Đã xóa vĩnh viễn bàn và xóa ảnh thành công.');
    }

    // Thay đổi trạng thái bàn
    public function changeStatus($id)
    {
        $table = Table::findOrFail($id);

        // Đảo trạng thái bàn (Còn trống <=> Đã có khách)
        $table->status = !$table->status;
        $table->save();  // Lưu thay đổi trạng thái vào database

        // Quay lại trang danh sách bàn với thông báo thành công
        return redirect()->route('admin.tables.index')->with('success', 'Cập nhật trạng thái thành công!');
    }
}
