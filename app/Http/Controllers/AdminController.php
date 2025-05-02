<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Dish;
use App\Models\Payment;
use App\Models\Table;
use App\Models\Category;

use Log;
use Carbon\Carbon;
use DB;

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
        $currentYear = Carbon::now()->year;

        $chartData = Payment::selectRaw('MONTH(created_at) as month, SUM(money) as total')
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        foreach ($chartData as $row) {
            $labels[] = 'Tháng ' . $row->month;
            $data[] = $row->total;
        }

        return view('admin.statistical', [
            'labels' => $labels,
            'data' => $data,
        ]);
    }


    public function calculate(Request $request)
    {
        // Phần xử lý dữ liệu biểu đồ theo tháng của năm hiện tại
        // $currentYear = Carbon::now()->year;

        // $chartData = Payment::selectRaw('MONTH(created_at) as month, SUM(money) as total')
        //     ->whereYear('created_at', $currentYear)
        //     ->groupBy(DB::raw('MONTH(created_at)'))
        //     ->orderBy('month')
        //     ->get();

        // $labels = [];
        // $data = [];

        // foreach ($chartData as $row) {
        //     $labels[] = 'Tháng ' . $row->month;
        //     $data[] = $row->total;
        // }

        // print_r($labels);
        // print_r($data);

        // Xử lý theo ngày được chọn
        if ($request->date) {
            $payment = Payment::whereDate('created_at', $request->date)->get();
            if ($payment->isNotEmpty()) {
                $total = $payment->sum('money');
                $chartData = Payment::selectRaw('HOUR(created_at) as hour, SUM(money) as total')
                ->whereDate('created_at', $request->date)
                ->groupBy(DB::raw('HOUR(created_at)'))
                ->orderBy('hour')
                ->get();
        
                foreach ($chartData as $row) {
                    $labels[] = $row->hour . 'h';
                    $data[] = $row->total;
                }
                return view('admin.statistical', [
                    'success' => 'ngày ' . Carbon::parse($request->date)->format('d/m/Y'),
                    'payment' => $payment,
                    'total' => $total,
                    'labels' => $labels,
                    'data' => $data,
                ]);
            } else {
                return view('admin.statistical', [
                    'error' => 'Không tìm thấy dữ liệu',
                    'labels' => $labels,
                    'data' => $data,
                    'payment' => [],
                    'total' => 0
                ]);
                
            }
        }

        // Xử lý theo tháng
        if ($request->month) {
            $month = Carbon::parse($request->month)->month;
            $year = Carbon::parse($request->month)->year;

            $payment = Payment::whereYear('created_at', $year)->whereMonth('created_at', $month)->get();
            if ($payment->isNotEmpty()) {
                $total = $payment->sum('money');
               

                $chartData = Payment::selectRaw('DAY(created_at) as day, SUM(money) as total')
                    ->whereMonth('created_at', $month)
                    ->groupBy(DB::raw('DAY(created_at)'))
                    ->orderBy('day')
                    ->get();

                $labels = [];
                $data = [];

                foreach ($chartData as $row) {
                    $labels[] = 'Ngày ' . $row->day;
                    $data[] = $row->total;
                }

                return view('admin.statistical', [
                    'success' => 'tháng ' . $month,
                    'payment' => $payment,
                    'total' => $total,
                    'labels' => $labels,
                    'data' => $data,
                ]);
            } else {
                return view('admin.statistical', [
                    'error' => 'Không tìm thấy dữ liệu',
                    'labels' => $labels,
                    'data' => $data,
                    'payment' => [],
                    'total' => 0
                ]);
                
            }
        }

        // Xử lý theo năm
        if ($request->year) {
            $payment = Payment::whereYear('created_at', $request->year)->get();
            if ($payment->isNotEmpty()) {
                $total = $payment->sum('money');

                $chartData = Payment::selectRaw('MONTH(created_at) as month, SUM(money) as total')
                    ->whereYear('created_at', $request->year)
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->orderBy('month')
                    ->get();

                $labels = [];
                $data = [];

                foreach ($chartData as $row) {
                    $labels[] = 'Tháng ' . $row->month;
                    $data[] = $row->total;
                }


                return view('admin.statistical', [
                    'success' => 'năm ' . $request->year,
                    'payment' => $payment,
                    'total' => $total,
                    'labels' => $labels,
                    'data' => $data,
                ]);
            } else {
                return view('admin.statistical', [
                    'error' => 'Không tìm thấy dữ liệu',
                    'labels' => $labels,
                    'data' => $data,
                    'payment' => [],
                    'total' => 0
                ]);
                
            }
        }

        // return view('admin.statistical', [
        //     'labels' => $labels,
        //     'data' => $data,
        // ]);
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
