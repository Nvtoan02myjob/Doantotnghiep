<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;
class checkTableInPageTable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()){
            
            $order = Order::where('user_id', auth()->user()->id)->where('status', 1)->first();
            if($order){
                return redirect()->route('table')->with('has_table', 'Bạn đã chọn bàn trước đó');

            }
            if(!session()->has('table_id')){
                return $next($request);

            }
            return redirect()->route('table')->with('has_table', 'Bạn đã chọn bàn trước đó');
        }
        return redirect()->route('login');
    }
}
