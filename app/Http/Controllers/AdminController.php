<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Dish;
use App\Models\payment;
use App\Models\Table;
use Log;
class AdminController extends Controller
{
    public function payment(){
        
        $orders = Order::where('status', 1)->get();
        $userInOrder = $orders->pluck('user_id');
        $users = User::whereIn('id', $userInOrder)->get();
        $order_detail = Order_detail::whereIn('order_id', $orders->pluck('id'))->get();
        return view('payments',[
            'orders' => $orders,
            'users' => $users,
            'order_detail' => $order_detail
        ]);
        // dd($userInOrder);
    }
    public function payment_transfer(Request $request){
        
        $QR = $request->QR;
        $price = $request->price;
        $content= $request->content;
        $data_order_item = $request->data_order_item;
        $data_list_detail = json_decode($request->data_list_detail, true);

        $dish_ids = array_column($data_list_detail, 'dish_id');
        $dishs = Dish::whereIn('id', $dish_ids)->get();
        return view('payment_transfer',[
            'QR' => $QR,
            'price' => $price,
            'content' => $content,
            'data_order_item' => $data_order_item,
            'data_list_detail' => $data_list_detail,
            'dishs'=> $dishs
        ]);
    
    }
    public function statistical(Request $request){
        return view('admin.statistical');
    }
    public function calculate(Request $request){
        if($request->date){
            $payment = Payment::whereDate('created_at', $request->date)->get();
            if($payment->isNotEmpty()){
                $total = 0;
                foreach($payment as $payment_item){
                    $total += $payment_item->money;
                }
                return view('admin.statistical',[
                    'success' => 'ngày' . ' ' . \Carbon\Carbon::parse($request->date)->format('d/m/Y'),
                    'payment' => $payment,
                    'total' => $total

                ]);

            }else{
                return redirect()->back()->with('error', 'Không tìm thấy dữ liệu');

            }
        }
        else if($request->month){
            $month = \Carbon\Carbon::parse($request->month)->month;
            $year = \Carbon\Carbon::parse($request->month)->year;
        
           
            $payment = Payment::whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
            if($payment->isNotEmpty()){
                $total = 0;
                foreach($payment as $payment_item){
                    $total += $payment_item->money;
                }
                return view('admin.statistical',[
                    'success' => 'tháng' . ' ' .$month,
                    'payment' => $payment,
                    'total' => $total

                ]);

            }else{
                return redirect()->back()->with('error', 'Không tìm thấy dữ liệu');

            }
        }
        else if($request->year){
            $payment = Payment::whereYear('created_at', $request->year)->get();
            if($payment->isNotEmpty()){
                $total = 0;
                foreach($payment as $payment_item){
                    $total += $payment_item->money;
                }
                return view('admin.statistical',[
                    'success' => 'năm' . ' ' . $request->year,
                    'payment' => $payment,
                    'total' => $total

                ]);

            }else{
                return redirect()->back()->with('error', 'Không tìm thấy dữ liệu');

            }
        }
        
    }
    public function table_dish(Request $request){
        try {
            $tables = Table::all();
            $order_pendings = Order::where('status', 1)->get();
            if($order_pendings->isNotEmpty()){
                $orderPending_listId = $order_pendings->pluck('id');
                $detail_for_orderPendings =  Order_detail::whereIn('order_id', $orderPending_listId)->get();
                $detail_listId = $detail_for_orderPendings->pluck('dish_id');
                $dish_for_details = Dish::whereIn('id', $detail_listId)->get();
                    
            }else{
                $detail_for_orderPendings = collect();
                $dish_for_details = collect();
            }
          
            if($tables){
                return view('admin.table_dish',compact('tables','order_pendings','detail_for_orderPendings', 'dish_for_details'));
            }else{
                return redirect()->route('admin.table_dish')->with('không có bàn nào.');
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
    }
}
