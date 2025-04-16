<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Order;
class checkTable
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
                return $next($request);

            }
            if(!session()->has('table_id')){
                return redirect()->route('table');

            }
            return $next($request);
        }
        return redirect()->route('login');
    }
}
