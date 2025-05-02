<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Table;

use function Laravel\Prompts\table;

class PaymentController extends Controller
{
    // Hiển thị danh sách thanh toán
    public function index()
    {
        $payments = Payment::with('order')->latest('id')->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }

    // Thêm thanh toán mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'money' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'node' => 'nullable|string',
            'order_id' => 'required|exists:orders,id',
           
        ]);

        try {
            // Tạo thanh toán mới
            Payment::create($validatedData);

            // Cập nhật trạng thái đơn hàng sang 'đã thanh toán' (status = 1)
            $order = Order::findOrFail($validatedData['order_id']);
            $order->status = 0;
            Table::where('id', $order-> table_id)->update(['status'=> 0]);
            session()->forget('table_id');
            $order->save();

            return redirect()->route('admin.orders.index')->with('success', 'Thanh toán thành công và đơn hàng đã được cập nhật.');
        } catch (\Exception $e) {
            return redirect()->route('admin.payments.index')->with('error', 'Có lỗi xảy ra khi thêm thanh toán.');
        }
    }

    // Hiển thị form thêm thanh toán
    public function create($order_id)
    {
        $order = Order::with('user')->find($order_id);

        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy hóa đơn với ID này');
        }

        if (!$order->table_id) {
            return redirect()->back()->with('error', 'Hóa đơn này chưa gán bàn');
        }

        return view('admin.payments.create', compact('order'));
    }

    // Xóa thanh toán (soft delete)
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Thanh toán đã được xóa.');
    }
}