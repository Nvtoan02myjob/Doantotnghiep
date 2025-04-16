<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Table;

class VNPayController extends Controller
{
    public function createPayment(Request $request){
        $vnp_TmnCode = env('vnp_TmnCode'); // Mã Website bạn lấy từ VNPAY
        $vnp_HashSecret = env('vnp_HashSecret'); // Chuỗi bí mật bạn lấy từ VNPAY
        $vnp_Url = env('vnp_Url');
        $vnp_Returnurl = route('payment.return'); // Tạo route trả về
    
        $vnp_TxnRef = $request->order_id; // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toan don hang";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $request->price_total * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "";
        $vnp_IpAddr = request()->ip();
        $vnp_ExpireDate = now()->addMinutes(15)->format('YmdHis');
    
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate,
        ];
    
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            $hashdata .= ($i ? '&' : '') . urlencode($key) . "=" . urlencode($value);
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
            $i++;
        }
    
        $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url = $vnp_Url . "?" . $query . 'vnp_SecureHash=' . $vnp_SecureHash;
    
        return redirect($vnp_Url);

    }
    
    public function vnpayReturn(Request $request){
        $vnp_HashSecret = env('vnp_HashSecret');; // Chuỗi bí mật từ VNPAY

        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? null;
        unset($inputData['vnp_SecureHash']);
        unset($inputData['vnp_SecureHashType']);

        ksort($inputData);
        $hashData = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            $hashData .= ($i ? '&' : '') . urlencode($key) . "=" . urlencode($value);
            $i++;
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash && $request->vnp_ResponseCode == '00') {
            Payment::create([
                'order_id' => $request->vnp_TxnRef,
                'status' => 1,
                'payment_method' => 'vnpay',
                'money' => $request->vnp_Amount / 100,
                'code_vnpay' => $request->vnp_TransactionNo,
                'code_bank' => $request->vnp_BankCode,
            ]);

            $order = Order::where('id', $request->vnp_TxnRef)->first();
            $order->update([
                'status'=> 0
            ]);
            $tableId = $order->table_id;
            Table::where('id', $tableId)->update(['status'=> 0]);
            unset($_SESSION['table_id']);


            return redirect('/')->with('payment_status', 'success');
        }else {
            return redirect('/')->with('payment_status', 'fail');
        }
    }



}
