<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Dish;
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
}
