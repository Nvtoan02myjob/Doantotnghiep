<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cart;
use App\models\Order;
use App\models\Order_detail;
use App\models\Dish;
use App\models\Table;
class cartController extends Controller
{
    public function addCart($id, Request $request){
        $quantity = $request->quantity_dish;
        $user_id = auth()->user()->id;
        Cart::create([
            'user_id' => $user_id,
            'dish_id' => $id,
            'quantity'=> $quantity,
        ]);
        return redirect('/')->with('success_add_cart', 'Đã thêm vào giỏ hàng.');
    }

    public function add_order_orderDetail(Request $request){
        try {
            $user = auth()->user()->id;   
            $data_order = Order::where('user_id', $user)->where('status', 1)->get();
            if($data_order->isEmpty()){
                $total = $request->total_price_hidden;
                $cart_list_id = $request->checkbox_data;
                $cart_info = Cart::whereIn('id', $cart_list_id)->get();
                $dish_id = $cart_info->pluck('dish_id')->toArray();
                $dishes = Dish::whereIn('id', $dish_id)->get()->keyBy('id');
                
                do {
                    $orderCode = mt_rand(10000, 99999);
                    $exists = Order::where('pin_code', $orderCode)->exists();
                } while ($exists);
                
                $order = Order::create([
                    'user_id'=> $user,
                    'table_id' => session('table_id'),
                    'status' => 1,
                    'pin_code'=> $orderCode,
                    'price_total' => $total
                    
                ]);

                $table = Table::where('id', session('table_id'))->first();
                if($table){
                    $table->update([
                        'status'=> 1
                    ]);
                }

                $orderId = $order->id;
    
                foreach($cart_info as $cart_item){
                    $dish = $dishes[$cart_item->dish_id] ?? null ;
                    if ($dish) {
                        $cart[] = Order_detail::create([
                            'order_id'  => $orderId,
                            'dish_id'   => $cart_item['dish_id'],
                            'quantity'  => $cart_item['quantity'],
                            'unit_price'=> $dish->price
                        ]);
                        
                        
                    }
                    $cart_item->delete();

                }
                return redirect()->route('home');

                
            }
            else{
                // echo($data_order);
                $old_price = $data_order->first()->price_total;
                $total = $request->total_price_hidden;
                $new_price = $old_price + $total;
                // echo $new_price;
                
                $order = $data_order->first()->update([
                    'price_total' => $new_price,
                ]);
                $cart_list_id = $request->checkbox_data;
                $cart_info = Cart::whereIn('id', $cart_list_id)->get();
                $dish_id = $cart_info->pluck('dish_id')->toArray();
                $dishes = Dish::whereIn('id', $dish_id)->get()->keyBy('id');
                foreach($cart_info as $cart_item){
                    $dish = $dishes[$cart_item->dish_id] ?? null ;
                    if ($dish) {
                        $cart[] = Order_detail::create([
                            'order_id'  => $data_order->first()->id,
                            'dish_id'   => $cart_item['dish_id'],
                            'quantity'  => $cart_item['quantity'],
                            'unit_price'=> $dish->price
                        ]);
                        
                        
                    }
                    $cart_item->delete();
                }

                return redirect()->route('home');
            }
           
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Đã có lỗi xảy ra!'], 500);
        }
        

    }
    public function delete_dish_in_cart($id, Request $request){
        echo $id;
        $cart = Cart::find($id);
        if($cart){
            $cart->delete();
        }
        return redirect()->route('home');
    }
    public function otp_verify(){
        return view('otp_table');
    }
    public function otp_verify_data(Request $request){
        $data = $request->otp_data;
        $result = implode($data);
        $idTable = session('id_table');
        
        $result_main = Order::where('pin_code', $result)->where('table_id', session('id_table'))->where('status', 1)->first();
        if($result_main){
            return redirect()->route('login');
        }else{
            return response()->json(['message' => 'Mã OTP không hợp lệ'], 400);
        }

    }

}
