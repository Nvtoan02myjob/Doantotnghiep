<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Danh sách đơn hàng
    public function index(Request $request)
    {
        // Truy vấn ban đầu bao gồm cả đơn hàng đã xóa mềm
        $query = Order::withTrashed()->with('user');
    
        // Lọc theo trạng thái
        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }
    
        // Lọc theo mã PIN
        if ($request->has('keyword') && $request->keyword) {
            $query->where('pin_code', 'like', '%' . $request->keyword . '%');
        }
    
        // Sắp xếp & phân trang
        $orders = $query->latest('id')->paginate(5);
    
        return view('admin.orders.index', compact('orders'));
    }
    

    // Thêm món vào đơn hàng
    public function store(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->orderDetails()->create([
            'dish_id' => $request->dish_id,
            'quantity' => $request->quantity,
            'unit_price' => Dish::findOrFail($request->dish_id)->price, // Giả sử bạn có cột price trong bảng dish
        ]);

        return back()->with('success', 'Món đã được thêm vào đơn hàng');
    }

    // Xem chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::with(['user', 'orderDetails.dish'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Xóa đơn hàng thành công');
    }

    // Khôi phục đơn hàng đã xóa mềm
    public function restore($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $order->restore();

        return redirect()->route('admin.orders.index')->with('success', 'Khôi phục đơn hàng thành công');
    }

    // Xóa vĩnh viễn đơn hàng
    public function forceDelete($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        $order->forceDelete();

        return redirect()->route('admin.orders.index')->with('success', 'Đã xóa vĩnh viễn đơn hàng thành công');
    }

    // Đổi trạng thái đơn hàng
    public function changeStatus($id)
    {
        $order = Order::findOrFail($id);

        // Kiểm tra trạng thái hiện tại của đơn hàng và thay đổi giữa '1' (Đã thanh toán) và '0' (Chưa thanh toán)
        $order->status = $order->status == 1 ? 0 : 1; // 1 cho đã thanh toán, 0 cho chưa thanh toán
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái thành công');
    }
}
