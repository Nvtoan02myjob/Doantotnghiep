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
    $query = Order::with('user');

    // Lọc theo trạng thái
    if ($request->has('status') && $request->status) {
        $query->where('status', $request->status);
    }

    // Lọc theo mã PIN
    if ($request->has('keyword') && $request->keyword) {
        $query->where('pin_code', 'like', '%' . $request->keyword . '%');
    }

    $orders = $query->latest('id')->paginate(5);
    return view('admin.orders.index', compact('orders'));
}

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
