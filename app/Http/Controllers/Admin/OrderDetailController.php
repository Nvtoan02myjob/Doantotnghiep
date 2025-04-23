<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    // Cập nhật số lượng món
    public function edit(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $detail = Order_detail::findOrFail($id);
        $detail->quantity = $request->quantity;
        $detail->save();

        return back()->with('success', 'Chỉnh sửa số lượng thành công');
    }
    

    // Xoá món khỏi đơn hàng
    public function destroy($id)
    {
        $detail = Order_detail::findOrFail($id);
        $detail->delete();

        return back()->with('success', 'Xoá món thành công');
    }
}
